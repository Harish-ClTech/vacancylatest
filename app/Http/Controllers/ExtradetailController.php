<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Extradetail, Common};
use Exception;
use Illuminate\Database\QueryException;
use Validator;

class ExtradetailController extends Controller
{
    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'Other Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // other show other details form
    public function otherdetailForm (Request $request)
    {
        try {
            $post = $request->all();
            $previousData = [];
            if (!empty(@$post['userid'])) {
                $previousData = DB::table('extradetails')->where('userid', $post['userid'])->first();
                $verifyInfoDetails = Common::checkJobApplyDetails($post);
            }
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('storeExtraDetailsData'),
                'verifydoctdetails'=> $verifyInfoDetails
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.otherdetails.otherdetailssetup', $data);
    }


    // store extra details 
    public function storeExtraDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $rules = [
                'cast' => 'required|string',
                'religion' => 'required|string',
                'maritalstatus' => 'required|string',
                'employmentstatus' => 'required|string',
                'motherlanguage'=>'required|string',
            ];

            $messages = [
                'cast.required' => 'तपाईले जात भर्नुभएको छैन |',
                'religion.required' => 'तपाईले धर्म भर्नुभएको छैन |',
                'maritalstatus.required' => 'तपाईले वैवाहिक स्थिति भर्नुभएको छैन |',
                'employmentstatus.required' => 'तपाईले रोजगारी अवस्था भर्नुभएको छैन |',
                'motherlanguage.required' => 'तपाईले मात्री भाषा भर्नुभएको छैन |',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            $filteredData = sanitizeData($post);
            $filteredData['userid'] = auth()->user()->id;
            $result = Extradetail::storeExtraDetails($filteredData);
            if (!$result['success']) {
                throw new Exception ($this->queryExceptionMessage, 1);
            }

            $response = [
                "redirectUrl" => "contactdetailForm",
                "success" => true,
                "message" => $this->message
            ];
        } catch (QueryException $e) {
            $response = [
                "redirectUrl" => "otherdetailForm",
                "success" => false,
                "message" =>  $this->queryExceptionMessage
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