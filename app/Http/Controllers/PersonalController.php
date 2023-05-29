<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Personal, Common};
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;
use Validator;
use App\Libraries\NepaliCalender;

class PersonalController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;

    
    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'Personal Details Saved Successfully.';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // get personal 
    public function personalForm (Request $request)
    {
        try {
            $post = $request->all();
            $districts = Common::getDistricts();
            $previousData = [];
            $verifyInfoDetails = [];
    
            if (!empty(@$post['userid'])) {
                $previousData = Personal::previousAllData($post);
                $verifyInfoDetails = Common::checkJobApplyDetails($post);
            }
            $data = [ 
                'previousData' => $previousData,
                'districts' => $districts,
                'verifydoctdetails' => $verifyInfoDetails,
                'saveurl' => route('storePersonalDetails')
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.pages.personal.viewpersonalsetup', $data);
    }


    // store personal details
    public function storePersonalDetails (Request $request) 
    {
        try {
            $post = $request->all();
            $rules = [
                'nfirstname' => 'required|string',
                'nlastname' => 'required|string',
                'efirstname'=>'required|string',
                'elastname'=>'required|string',
                'dateofbirthbs' => 'required|string',
                'dateofbirthad' => 'required|string',
                'gender' => 'required|string',
                'fatherfirstname' => 'required|string',
                'fatherlastname'=>'required|string',
                'motherfirstname'=>'required|string',
                'motherlastname' => 'required|string',
                'grandfatherfirstname' => 'required|string',
                'grandfatherlastname'=>'required|string',
                'citizenshipnumber'=>'required|string',
                'citizenshipissuedistrictid'=>'required|numeric',
                'citizenshipissuedate'=>'required|string'
            ];

            $messages = [
                'nfirstname.required' => 'तपाईले पहिलो नाम (नेपालीमा) भर्नुभएको छैन |',
                'nlastname.required' => 'तपाईले थर (नेपालीमा) भर्नुभएको छैन |',
                'efirstname.required' => 'तपाईले पहिलो नाम (अंग्रेजीमा) भर्नुभएको छैन |',
                'elastname.required' => 'तपाईले थर (अंग्रेजीमा) भर्नुभएको छैन |',
                'dateofbirthbs.required' => 'तपाईले जन्म मिति (नेपालीमा) भर्नुभएको छैन |',
                'dateofbirthad.required' => 'तपाईले जन्म मिति (अंग्रेजीमा) भर्नुभएको छैन |',
                'gender.required' => 'तपाईले लिङ्ग भर्नुभएको छैन |',
                'fatherfirstname.required' => 'तपाईले बुवाको पहिलो नाम भर्नुभएको छैन |',
                'fatherlastname.required' => 'तपाईले बुवाको थर भर्नुभएको छैन |',
                'motherfirstname.required' => 'तपाईले आमाको पहिलो नाम भर्नुभएको छैन |',
                'motherlastname.required' => 'तपाईले आमाको थर भर्नुभएको छैन |',
                'grandfatherfirstname.required' => 'तपाईले हजुरबुबाको पहिलो नाम भर्नुभएको छैन |',
                'grandfatherlastname.required' => 'तपाईले हजुरबुबाको थर भर्नुभएको छैन |',
                'citizenshipnumber.required' => 'तपाईले नागरिकता नम्बर भर्नुभएको छैन |',
                'citizenshipissuedistrictid.required' => 'तपाईले नागरिकता मुद्दा जिल्ला भर्नुभएको छैन |',
                'citizenshipissuedistrictid.numeric' => 'तपाईले नागरिकता मुद्दा जिल्ला भर्नुभएको छैन |',
                'citizenshipissuedate.required' => 'तपाईले नागरिकता जारी मिति भर्नुभएको छैन |'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception ($validator->errors()->first(), 1);
            }

            $filteredData = sanitizeData($post);
            $filteredData['userid'] = auth()->user()->id;
            $response = Personal::storePersonalDetails($filteredData);
            if ($response['success']) { 
                $response = [
                    "redirectUrl" => "otherdetailForm",
                    "success" => true,
                    "message" => $this->message,
                    "personalid" => $response['id']
                ];
            }
        } catch (QueryException $e) {
            $response = [
                "redirectUrl" => "personal",
                "success" => false,
                "message" => $this->queryExceptionMessage
            ];
        } catch (Exception $e) {
            $response = [
                "redirectUrl" => "personal",
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        echo json_encode(array($response));
        exit;
    }


    // get ENG date
    function getEnglishDate (Request $request) 
    {
        include(app_path() . '/Libraries/NepaliCalender.php');
        try {
            $dateArray = explode('-', $request->date);
            $year = $dateArray['0'];
            $month = $dateArray['1'];
            $day = $dateArray['2'];
            $edate = NepaliCalender::getInstance()->nep_to_eng($year,$month,$day);
            if (!$edate) {
                throw new Exception('Something went wrong!', 1);
            }
            if($edate['month'] < 10) {
                $edate['month'] = '0'.$edate['month'];
            }
            if($edate['date'] < 10) {
                $edate['date'] = '0'.$edate['date'];
            }
            $date = $edate['year'].'-'.$edate['month'].'-'.$edate['date'];
        } catch (QueryException $e) {
            $this->type = 'error';
            $date = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $date = $e->getMessage();
        }
        echo json_encode(['type' => $this->type, 'datead' => $date]);
        exit;
    }
}