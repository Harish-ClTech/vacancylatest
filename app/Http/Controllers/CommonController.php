<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Common;
use Exception;

class CommonController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'स्थिति सफलतापूर्वक परिवर्तन भयो ।';
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
        $this->response = false;
    }


    // get districts
    public function getDistrict (Request $request)
    {   
        try {
            $post = $request->all();
            $result = DB::table('districts')->where('provinceid', $post['provinceid'])->get();
            
            $html = '<option value="" selected>जिल्ला छान्नुहोस्</option>';
            foreach ($result as $key => $value) {
              $html .= "<option value='" . $value->id . "'>" . $value->districtname . "</option>";
            }

        } catch (QueryException $e) {
            $html = '<option value="" selected>जिल्ला छान्नुहोस्</option>';
        } catch (QueryException $e) {
            $html = '<option value="" selected>जिल्ला छान्नुहोस्</option>';
        }
        return $html;
    }


    // get VDC/Municipality 
    public function getVdcorMunicipality (Request $request)
    {
        try {
            $post = $request->all();
            $result = DB::table('vdcormunicipalities')->where('districtid', $post['districtid'])->get();
            $html = '<option value="" selected>पालिकाको नाम छान्नुहोस्</option>';
            foreach ($result as $key => $value) {
                $html .= "<option value='" . $value->id . "'>" . $value->vdcormunicipalitiename . "</option>";
            }

        } catch (QueryException $e) {
            $html='<option value="" selected>पालिकाको नाम छान्नुहोस्</option>';
        } catch (Exception $e) {
            $html='<option value="" selected>पालिकाको नाम छान्नुहोस्</option>';
        }
        return $html;
    }


    // get access log details
    public function getAccesslogs (Request $request)
    {
        try {
            if(session()->get('roleid') != 1) {
                return redirect()->route('login');  
            }
    
            $post = $request->all();
            $data = Common::getAccesslogs($post);
            // dd($data);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
    
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["sendby"] = $row->sendby;
                $array[$i]["message"] = $row->message;
                $array[$i]["logstatus"] = $row->logstatus;
                $array[$i]["modulename"] = $row->modulename;
                $array[$i]["createdatetime"] = $row->createddatetime;
                if ($row->logqueue == 'Pending') {
                    $icon = '<i class="fa fa-check"></i>';
                    $color = 'black';
                } else {
                    $icon = '';
                    $color = 'green';
                }

                $taskStatus = '<select class="form-select taskStatus" id="taskStatus" data-logid="'.$row->id.'">';
                $taskStatus .= '<option value="Pending" '. ($row->logqueue == "Pending" ? "selected" : "") .'>Pending</option>';
                $taskStatus .= '<option value="Completed" '. ($row->logqueue == "Completed" ? "selected" : "") .'>Completed</option>';
                $taskStatus .= '</select>';
                
                $array[$i]["taskstatus"] = $taskStatus;

                // $array[$i]["taskstatus"] = '<span style="color:'.$color.'">'.$row->logqueue.'</span><a href="javascript:;" class="completeStatus"  data-logid="' . $row->id . '" >'.$icon.'</a>';
                $i++;
            }
            if (!$filtereddata) {
                $filtereddata = 0;
            }
            if (!$totalrecs) {
                $totalrecs = 0;
            }
        } catch (QueryException $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        } catch (Exception $e) {
            $array = [];
            $totalrecs = 0;
            $filtereddata = 0;
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }


    // change log queue
    public function changelogqueue (Request $request)
    {
        try {
            $post = $request->all();
            DB::beginTransaction();
            $isUpdated = DB::table("accesslogs")->where('id', $post['logid'])->update(['logqueue' => $post['currentStatus']]);
            if (!$isUpdated) {
                throw new Exception('स्थिति परिवर्तन गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।', 1);
            }

            $getAccessLogs = DB::table("accesslogs")->select('userid','modulename')->where('id', $post['logid'])->first();
            
            if(!empty($getAccessLogs)){
                $getUserId = $getAccessLogs->userid;
                
                $requestType = '';
                $requestValue = 0;

                /* To Update Personal Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Personal'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'personal_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'personal_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Personal Information of the User (Applicants)*/

                /* To Update Others Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Others'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'other_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'other_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Others Information of the User (Applicants)*/

                /* To Update Contact Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Contact'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'contact_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'contact_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Contact Information of the User (Applicants)*/

                /* To Update Education Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Education'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'education_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'education_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Education Information of the User (Applicants)*/

                /* To Update Training Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Training'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'training_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'training_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Training Information of the User (Applicants)*/

                /* To Update Experiences Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Experiences'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'experience_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'experience_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Experiences Information of the User (Applicants)*/

                /* To Update Documents Information of the User (Applicants)*/
                if($getAccessLogs->modulename == 'Document'){
                    if($post['currentStatus'] == 'Completed'){
                        $requestType = 'document_enabled';
                        $requestValue = 1;
                    }else{
                        $requestType = 'document_enabled';
                        $requestValue = 0;
                    }
                }
                /* To Update Documents Information of the User (Applicants)*/

                $whereUserArray = ['id' => $getUserId];

                $updateUserArray = [$requestType => $requestValue];

                $userRequestUpdate = DB::table('users')->where($whereUserArray)->update($updateUserArray);
                if (!$userRequestUpdate) {
                    throw new Exception('स्थिति परिवर्तन गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।|', 1);
                }

            }

            $this->response = true;
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // show accesslog main page
    public function accesslogs ()
    {
        if (session()->get('roleid') != 1) {
            return redirect()->route('login'); 
        }

        return view('admin.applicant.accesslogs');
    }


    // fetch levels from vacancy table
    public function getLevels (Request $request)
    {
        try {
            $post = $request->all();
            $result = Common::getLevels($post);
            return $result;  

        } catch (Exception $e) {
            throw $e;
        }
    }


    // fetch designations of particular level 
    public function getDesignations (Request $request)
    {
        try {
            $this->message = 'Data fetched Successfully.';
            $rules = [
                'fiscalyearid' => 'required|integer',
                'levelid' => 'required|integer'
            ];
            $messages = [
                'fiscalyearid.required' => 'Please select fiscalyear',
                'levelid.required' => 'Please select level'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }
            $post = $request->all();
            $designations = Common::getDesignations($post);
            $this->response = ['hasChild'=>true, 'designations'=>$designations];
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = 'तपाईको डाटामा समस्या भेटिएको छ । कृपया पुन: प्रयास गर्नुहोला ।';

        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }

    // fetch Applicant ProfileIds
    public function getProfileIds ()
    {
        try {
            $result = Common::getProfileIds();
            $data['personalid'] = !empty($result->personalid) ? true:false;
            $data['otherdetailid'] = !empty($result->otherdetailid) ? true:false;
            $data['contactid'] = !empty($result->contactid) ? true:false;
            $data['educationid'] = !empty($result->educationid) ? true:false;
            $data['experienceid'] = !empty($result->experienceid) ? true:false;
            $data['trainingid'] = !empty($result->trainingid) ? true:false;
            $data['documentid'] = !empty($result->documentid) ? true:false;
            return $data;  
        } catch (Exception $e) {
            throw $e;
        }
    }
}