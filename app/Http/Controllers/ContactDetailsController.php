<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Contactdetail, Common};
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Validator;

class ContactDetailsController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct () 
    {
        $this->type = 'success';
        $this->message = 'Contact Details Saved Successfully.';
        $this->queryExceptionMessage = 'Something went wrong.Please, try again.';
        $this->response = false;
    }


    // show contact details form
    public function contactdetailForm (Request $request)
    {
        try {
            $post = $request->all();
            $provinces = DB::table('provinces')->where('status','Y')->get();
            $districts = DB::table('districts')->where('status','Y')->get();
            $vdcormunicipalities = DB::table('vdcormunicipalities')->where('status','Y')->get();

            $previousData = [];
            $verifyInfoDetails = [];
            if (!empty($post['userid'])) {
                $previousData = DB::table('contactdetails')
                                ->where('userid', $post['userid'])
                                ->first();

                $verifyInfoDetails = Common::checkJobApplyDetails($post);
            }
            $data = [
                'provinces' => $provinces,
                'districts' => $districts,
                'vdcormunicipalities' => $vdcormunicipalities,
                'previousData' => @$previousData,
                'verifydoctdetails' => $verifyInfoDetails
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.contactdetails.contactdetails', $data);
    }


    // store contact details
    public function storeContactDetails (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'provinceid' => 'required|numeric',
                'districtid' => 'required|numeric',
                'municipalityid' => 'required|numeric',
                'ward' => 'required|numeric',
                'tole' => 'required',
                
            ];

            $messages = [
                'provinceid.required' => 'तपाईले प्रदेश भर्नुभएको छैन |',
                'provinceid.numeric' => 'तपाईले प्रदेश भर्नुभएको छैन |',
                'districtid.required' => 'तपाईले जिल्ला भर्नुभएको छैन |',
                'districtid.numeric' => 'तपाईले जिल्ला भर्नुभएको छैन |',
                'municipalityid.required' => 'तपाईले पालिकाको नाम  भर्नुभएको छैन |',
                'municipalityid.numeric' => 'तपाईले पालिकाको नाम  भर्नुभएको छैन |',
                'ward.required' => 'तपाईले वार्ड भर्नुभएको छैन |',
                'ward.numeric' => 'तपाईले वार्ड भर्नुभएको छैन |',
                'tole.required' => 'तपाईले टोल भर्नुभएको छैन |',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            $filteredData = sanitizeData ($post);
            $filteredData['userid'] = auth()->user()->id;
            $result = Contactdetail::storeContactDetails($filteredData);
            if(!$result['success']) {
                throw new Exception ($this->queryExceptionMessage, 1);
            }

            $response = [
                "redirectUrl" => "education",
                "success" => true,
                "message" => $this->message
            ];
        } catch (QueryException $e) {
            $response = [
                "redirectUrl" => "otherdetailForm",
                "success" => false,
                "message" => $this->queryExceptionMessage
            ];
        } catch (Exception $e) {
            $response = [
                "redirectUrl" => "otherdetailForm",
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        echo json_encode(array($response));
    }
}