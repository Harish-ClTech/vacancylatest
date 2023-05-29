<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage, URL};
use App\Exports\{ApplicantDetailsExport, InsufficientPaymentReportExport, VacancyDetailExport};
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use App\Models\{Applicant, Common};
use Carbon\Carbon;
use Exception;
use Validator;
use PDF;

class ApplicantController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;


    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'प्रयोगकर्ता विवरणहरू सफलतापूर्वक भण्डारण गरियो ।';
        $this->response = false;
        $this->queryExceptionMessage = 'केही गडबड भयो । कृपया फेरि प्रयास गर्नुहोस् ।';
    }


    // show main page
    public function applicantDetails ()
    {
        if (session()->get('roleid') !=1 ) {
            return redirect()->route('login'); 
        } else {
            return view('admin.applicant.viewapplicant');
        }
    }
	

    // applicants list in datatable
    public function getApplicantListData (Request $request)
    {
        try {
            if(session()->get('roleid') != 1) {
                return redirect()->route('login'); 
            }

            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Applicant::getApplicantListData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);

            $arrayData = [];
            $uesrlabel = [];
            if (!empty(auth()->user()->userlevel)) {
                $uesrlabel  = explode(',', auth()->user()->userlevel);
            }
            if (!empty($uesrlabel)) {
                foreach($uesrlabel as $row) {
                    $arrayData[$row] = $row;
                }
            }

            foreach ($data as $row) {
                if ($row->appliedstatus == 'Incomplete') {
                    $color = 'color:blue';
                } else if ($row->appliedstatus == 'Verified') {
                    $color = 'color:green';
                } else if ($row->appliedstatus == 'Pending') {
                    $color = 'color:black';
                } else if ($row->appliedstatus == 'Rejected') {
                    $color = 'color:red';
                }
    
                $array[$i]["sn"] = $i + 1;
                $array[$i]["registrationnumber"] = $row->registrationnumber;
                $array[$i]["applieddatead"] = $row->applieddatead;
                $array[$i]["receipnumber"] = $row->receipnumber;
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["labelname"] = $row->labelname;
                $array[$i]["applyamount"] = $row->applyamount;
                $array[$i]["paymentsource"] = $row->paymentsource;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["designation"] = $row->designation;
                $array[$i]["labelname"] = $row->labelname;
                $array[$i]["appliedstatus"] = "<span style='".$color."'>".$row->appliedstatus."</span>";
                $array[$i]["gender"] = $row->gender;
            
                $isaccess = 'N';
                if(!empty($arrayData)){
                    if(array_key_exists($row->labelname, $arrayData))
                        $isaccess = 'Y';
                }
    
                $action = "";
                // edit
                 $action .= ' <a href="javascript:;" title="प्रयोगकर्ता हेर्नुहोस्" data-isaccess="'.$isaccess.'"  data-label="'.$row->labelname.'" data-aplicantstatus="'.$row->appliedstatus.'"  class="previewUser" data-jobid="'.$row->jobapplyid.'" data-userid="' . $row->userid . '" data-designationid="'.$row->designationid.'" ><i class="fa fa-eye fa-lg text-warning"></i></a>';
    
                // delete
                $array[$i]["action"] = $action;
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
            $filtereddata = 0;
            $totalrecs = 0;
        } catch (Exception $e) {
            $array = [];
            $filtereddata = 0;
            $totalrecs = 0;
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }	


    // get previous data
    public function getPreviewData (Request $request)
    {
        try {
            $post = $request->all();
            $userid = $post['userid'];

            DB::beginTransaction();
            $applied = Common::getAppliedJobsDetails($post);

            $user = DB::table('users')->where('id', $userid)->first();
            
            // get specific details
            $profile = Applicant::getProfileDetail($userid);
            $contactDetails = Applicant::getContactDetail($userid);
            $educationDetails = Applicant::getEducationDetail($userid);
            $trainingDetails = Applicant::getTrainingDetail($userid);
            $experienceDetails = Applicant::getExperienceDetail($userid);
            $photo = Applicant::getPhotoDetail($userid);
            $documentImage = Applicant::getDocumentDetail($userid);
            $extraDetails = Applicant::getExtraDetail($userid);
            $vacancies = Applicant::getVacancies($post);

            // calculate age
            $personal = DB::table('personals')->select('dateofbirthad')->where(['userid'=>$userid])->first();

            $dobad = $personal->dateofbirthad;
            $todaydatead = Carbon::now()->format('Y-m-d');
            $datediff = Carbon::parse($dobad)->diff($todaydatead)->format('%y बर्ष %m महिना %d दिन');
            $emailphone  = DB::table('profiles')->where(['userid'=>$userid])->get()->first();
            $data = [
                'profile' => $profile,
                'extraDetails' => $extraDetails,
                'contactDetails' => $contactDetails[0] ?? '',
                'educationDetails' => $educationDetails,
                'trainingDetails' => $trainingDetails,
                'experienceDetails' => $experienceDetails,
                'userphoto' => $photo,
                'documentImage' => $documentImage,
                'userid' => $userid,
                'user' => $user,
                'applied' => $applied,
                'agead' => $datediff,
                'vacancies' => $vacancies,
                'emailphone' => $emailphone
            ];
            DB::commit();

        } catch (QueryException $e) {
            DB::rollback();
            $data = [];
        } catch (Exception $e) {
            DB::rollback();
            $data = [];
        }
        return view('admin.applicant.preview', $data);
    }


    // store applicant details
    public function storeUsersDetails (Request $request)
    {
        try {
            
            $this->message = "प्रयोगकर्ता स्थिति सफलतापूर्वक परिवर्तन ।";

            $rules = [
                "userid" => "required|numeric",
                "status" => "required|string",
                "remarks" => "sometimes|string",
                "designationid" => "required|numeric",
                "jobapplyid" => "required|numeric"
            ];
            $messages = [
                "userid.required" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "userid.numeric" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "status.required" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "status.string" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "remarks.string" => "कृपया वर्णमा मात्र टिप्पणी प्रविष्ट गर्नुहोस् ।",
                "designationid.required" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "designationid.numeric" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "jobapplyid.required" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।",
                "jobapplyid.numeric" => "टिप्पणी सुरक्षित गर्न सकिएन। कृपया पुन: प्रयास गर्नुहोस् ।"
            ];
            $validation = Validator::make($request->all(), $rules, $messages);
            if ($validation->fails()) {
                throw new Exception ($validation->errors()->first(), 1);
            }
            DB::beginTransaction();
            $post = $request->all();
            unset($post['jobstatusid']);
            $filtereddata = sanitizeData($post);
            $result = Applicant::storeUsersDetails($filtereddata);
            if (!$result) {
                throw new Exception ("केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।", 1);
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


    // change access 
    function accessChanger (Request $request, $name, $value)
    {
        try {
            // dd($request, $name, $value);
            if (session()->get('roleid') == 1) {
                $this->message = "विवरण परिवर्तनका लागि तपाईको अनुरोध सफल छ ।";
                $role = 0;
                if ($value == "1") {
                    $role = 1;
                }
                $updatearray = [$name => $role];
                DB::beginTransaction();
                $isUpdated = DB::table('users')->where('id', $request->personalid)->update($updatearray);
                if (!$isUpdated) {
                    throw new Exception ("विवरण परिवर्तनका लागि तपाईको अनुरोध सफल हुन सकेन ।", 1);
                }
                $user = DB::table('users')->where('id', $request->personalid)->first();
                if (!$user) {
                    throw new Exception ("विवरण परिवर्तनका लागि तपाईको अनुरोध सफल हुन सकेन ।", 1);
                }
                if ($value == 1) {
                    Common::grantModifyAccess($user->email, $request->field);
                }
                $post = $request->all();
                $statusCheck = $this->requestAccess($request, $post);
                if (!$statusCheck) {
                    throw new Exception ("विवरण परिवर्तनका लागि तपाईको अनुरोध सफल हुन सकेन ।", 1);
                }
                $this->message = 'Edit Access Modified with '.$name.' changed to '. $role;
                $this->response = true;
                DB::commit();
            }

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


    // show registered candidate main page
    public function registeredCandidates ()
    {
        if(session()->get('roleid') != 1) {
            return redirect()->route('login');
        }

        return view('admin.applicant.viewcandidates');
    }


    // registered candidate details in datatable
    function getRegisteredCandidateDetails (Request $request)
    {
        try {
            if (session()->get('roleid') != 1) {
                return redirect()->route('login');
            }

            $post = $request->all();
            $data = Applicant::getCandidatesDetails($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["gender"] = $row->gender;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["email"] = $row->email;
                $array[$i]["registereddate"] = $row->createdatetime;

                $vacancies = Common::getVacancies();
                $vacancy = [];
                if (!empty($vacancies)) {
                    foreach ($vacancies as $key => $value) {
                        $vacancy[$value->title . '-' . $value->servicegroupname]['agelimit'] = $value->agelimit;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['qualification'] = $value->qualification;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['designation'] = $value->designation;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['academicid'] = $value->academicid;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['servicesgroup'] = $value->servicesgroup;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['vacancycode'][] = $value->vacancynumber;
                        $vacancy[$value->title . '-' . $value->servicegroupname]['jobcat'][$value->name][] = $value;
                    }
                }
                $data['vacancy'] = !empty($vacancy) ? $vacancy : array();

                $select = "";
                $select .= '<select id="jobapply" class="modifiedJob w-100">';
                foreach (@$data['vacancy'] as $key => $vacantpost) {
                    $select .= '<option value="' . @$row->userid . '"data-serviceid="' . $vacantpost['servicesgroup'] . '"data-designationid="' . $vacantpost['designation'] . '"data-academicid="' . $vacantpost['academicid'] . '">' . $key . '</option>';
                };
                $select .= '</select>';
                
                $array[$i]["vacancy"] = $select;
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


    // access request
    function requestAccess (Request $request, $post = null)
    {
        try {
            if (empty($post)) {
                $post = $request->all();
                $userid = auth()->user()->id;
            } else {
                $post = $post;
                $userid = $post['personalid'];
            }
            $modulename = $post['field'];
            if(session()->get('roleid') == 1) {
                $sendby = 'Admin';
                $messageChange = " तपाईंलाई ".$post['field']." परिवर्तन गर्ने अनुमति दिएको छ ।";
                $action = 'Allow';
                $modulename = $post['field'];
                $message = "Successfully access changed.";
            } else {
                $sendby = 'User';
                if ($post['action'] == 'request') {
                    $action = 'Request';
                    $messageChange = "म ".$post['field']." विवरण परिवर्तन गर्न चाहन्छु ।";
                    $message = "तपाईंले ".$post['field']." विवरण परिवर्तन गर्न अनुरोध गर्नुभएको छ ।";
                } else if ($post['action'] == 'verify') {
                    $messageChange = "मैले ".$post['field']." विवरण परिमार्जन पूरा गरेको छु ।";
                    $action = 'Completed';
                    $message = "तपाईंले ".$post['field']." विवरण परिमार्जन पूरा गर्नुभएको छ ।";
                }
            }

            $postInsert['userid'] = $userid;
            $postInsert['sendby'] = $sendby;
            $postInsert['message'] = $messageChange;
            $postInsert['modulename'] = $modulename;
            $postInsert['logstatus'] = $action;
            $postInsert['postedby'] = $userid;

            if(session()->get('roleid') == 1) {
                $postInsert['logqueue'] = 'Completed';
            }
            // $isUpdated = DB::table('accesslogs')->where(['userid'=>$postInsert['userid'], 'modulename'=>$postInsert['modulename'], 'logstatus'=>''])
            $accesslog = DB::table('accesslogs')->where(['userid'=>$postInsert['userid'], 'modulename'=>$postInsert['modulename']])->orderBy('id', 'DESC')->first();
            if (empty($accesslog)) {
                $isInserted = DB::table('accesslogs')->insert($postInsert);
                if (!$isInserted) {
                    throw new Exception('केहि गलत भयो। फेरि प्रयास गर्नुहोस ।', 1);
                }
            } else {
                if ($accesslog->logstatus == $postInsert['logstatus']) {
                    throw new Exception('तपाईंले पहिले नै अनुरोध वा प्रमाणित गरिसक्नुभएको छ ।', 1);
                } else {
                    $isInserted = DB::table('accesslogs')->insert($postInsert);
                    if (!$isInserted) {
                        throw new Exception('केहि गलत भयो। फेरि प्रयास गर्नुहोस ।', 1);
                    }
                }
            }

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // change apply job title
    public function changeApplyJobTitle (Request $request)
    {
        try {
            $post = $request->all();
            $this->message = "तपाईंको जागिर पोस्टको शीर्षक सफलतापूर्वक परिवर्तन भयो ।";

            $result = Applicant::changeApplyJobTitle($post);
            if (!$result) {
                throw new Exception ("पहुँच लग परिवर्तन गर्न सकिएन। फेरि प्रयास गर्नुहोस ।", 1);
            }
            $this->response = true;
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // modigy application details
    public function modifyApplication (Request $request)
    {
        try {
            $post = $request->all();
            $vacancy = [];
            $vacancy['data'] = Applicant::getModifyApplication($post);
            
            $datamaxmin = Applicant::getMinMax($post);
            $vacancy['low'] = $datamaxmin->minval;
            $vacancy['high'] = $datamaxmin->maxval;
    
            $result = DB::table('profiles')->select('firstname', 'lastname')->where('userid', $post['userid'])->first();
            $data = [
                'productId' => $post['userid'] . '-' . $result->firstname . ' ' . $result->lastname . ' EPF-Vacancy .',
                'vacancy' => $vacancy,
                'userid' => $post['userid'],
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.applicant.applicationModifier', $data);
    }


    // checkVacancyIf
    function checkVacancyif (Request $request, $id)
    {
        try {
            $post = $request->all();
            $reqestedCriteria = DB::table('vacancies')
                                ->where('id', $id)->first()->jobcategory;

            $criterialname = DB::table('jobcategories')->where('id', $reqestedCriteria)->first()->name;

            $response = [
                'success' => true,
                'message' => 'You are not eligible for ' . $criterialname
            ];
            
            if ($criterialname == 'महिला') {
                $genders=DB::table('personals')->where('userid', $post['userid'])->where('status','Y')->first();
                if(empty($genders)){
                     $response['success'] = false;
                }else{
                    if (($genders->gender) != "Female") {
                        $response['success'] = false;
                    }
                }
            }
            $documents = DB::table('documents')
                        ->where('userid', $post['userid'])
                        ->first();

            if ($criterialname == 'आदिवासीजनजाती') {
                if (empty(($documents->inclusiongroupcertificateadibashi)) && empty($documents->inclusiongroupcertificatejanajati)) {
                    $response['success'] = false;
                }
            }
            if ($criterialname == 'मधेशी') {
                if (empty($documents->inclusiongroupcertificatemadesi)) {
                    $response['success'] = false;
                }
            }
            if ($criterialname == 'पिछिडिएकाक्षेत्र') {
                if (empty($documents->inclusiongroupcertificatepixadiyeko)) {
                    $response['success'] = false;
                }
            }
            if ($criterialname == 'दलित') {
                if (empty($documents->inclusiongroupcertificatedalit)) {
                    $response['success'] = false;
                }
            }
            if ($criterialname == 'अपाङ्ग') {
                if (empty($documents->disabilitydocument)) {
                    $response['success'] = false;
                }
            }
            if ($response['success']) {
                $response['message'] = 'You are eligible for ' . $criterialname;
            }

        } catch (QueryException $e) {
            $response = [];
        } catch (Exception $e) {
            $response = [];
        } 
        return $response;
    }


    // store modified form
    public function storeModifiedForm (Request $request)
    {
        $post = $request->all();
        $khaltiTable = '';
        $esewaTable = '';
        if (strtolower($post['paymentMethod']) == 'khalti') {
            $khaltiTable = DB::table('transcations')->where('transactionid', $post['transactionID'])
                ->where('userid', $post['response']['userid'])->first();
        } else {
            $esewaTable = DB::table('transactions')->where('transactioncode', $post['transactionID'])
                ->where('userid', $post['response']['userid'])->first();
        }
        $response = [
            'success' => false,
            'message' => 'Not a valid matching transaction ID provided'
        ];

        if (!$khaltiTable && !$esewaTable) {
            return $response;
        }

        $post['idx'] = $post['transactionID'];
        $post['paymentsource'] = $post['paymentMethod'];
        $post['response']['totalsum'] = (!empty($post['isdoubleamount']) && ($post['isdoubleamount']=='Y')) ? $post['response']['totalsum']*2 : $post['response']['totalsum'];
        $post['userid'] = $post['response']['userid'];
        $post['vacancyid'] = $post['vacancyid'];

        $response = Applicant::storeModifiedJobDetails($post);

        return $response;
    }


    // verify action 
    public function verifyAction (Request $request)
    {
        try {
            $post = $request->all();

            $dataArrayIncomplete = [ 
                "Fill up the Gender",
                "Fill up the date of birth",
                "Fill citizenship issued date",
                "Upload your academic transcript Certificate",
                "Upload your contact & address details",
                "Upload your character certificate",
                "Upload your equivalent document",
                "Upload your experience letter",
                "Upload your photo",
                "Upload your citizenship front side",
                "Upload your citizenship back side",
                "Upload your signature",
                "Upload your inclusion document"
            ];

            $dataArrayRejected = [ 
                "Exceed the prescribed age limit.",
                "Lack of prescribed minimum educational qualification",
                "Lack of prescribed work experience",
                "Lack of prescribed inclusion document"
            ];

            if (!empty($post['verifyaction']) && ($post['verifyaction'] == 'Incomplete')) {
                $data = $dataArrayIncomplete;

            } else if (!empty($post['verifyaction']) && ($post['verifyaction'] == 'Rejected')) {
                $data = $dataArrayRejected;  
            } else {
                $data = [];
            }
            
            $options = '';
            if(!empty($data)) {
                foreach ($data as $row) {
                    $options .="<option value='".$row."'>".$row."</option>";
                }
            }
            $this->message = $options;
            $this->response = true;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // get cancelled application form
    function getCancelApplicationForm (Request $request)
    {
        $data = [];
        $data['userid'] = $request->userid;
        $data['applydetailid'] = $request->applydetailid;
        $data['designation'] = $request->designation;
        $data['jobcategoryname'] = $request->jobcategoryname;
        return view('admin.applicant.applicationcancelmodal', $data);
    }


    // store remarks of cancelled application
    public function storeRemarksToCancelApplication (Request $request)
    {
        try {
            $this->message = "आवेदन सफलतापूर्वक अस्वीकार गरियो ।";
            $rules = [
                'jobapplydetailid' => 'required|numeric',
                'userid' => 'required|numeric',
                'designation' => 'required|string',
                'jobcategoryname' => 'required|string',
                'vacancycanceledremarks' => 'required|string'
            ];
            $messages = [
                'jobapplydetailid.required' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'jobapplydetailid.numeric' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'userid.required' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'userid.numeric' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'designation.required' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'designation.string' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'jobcategoryname.required' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'jobcategoryname.string' => 'माफ गर्नुहोस्, प्रयोगकर्ता स्थिति परिवर्तन गरिएको छैन।',
                'vacancycanceledremarks.required' => 'कृपया टिप्पणी प्रदान गर्नुहोस् ।',
                'vacancycanceledremarks.string' => 'कृपया क्यारेक्टरहरूमा मात्र टिप्पणी प्रदान गर्नुहोस् ।'
            ];
            $validation = Validator::make($request->all(), $rules, $messages);
            if ($validation->fails()) {
                throw new Exception ($validation->errors()->first(), 1);
            }
            $post = $request->all();
            $filtereddata = sanitizeData($post);
            $result = Applicant::storeRemarksToCancelApplication($filtereddata);
            if (!$result) {
                throw new Exception ('केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।', 1);
            }

            $this->response = true;

        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) { 
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }

    
    // export applicant
    public function exportApplicant ($data)
    {     
        $response = Excel::store(new ApplicantDetailsExport($data),'exceldata/application.xlsx');
        return Excel::download(new ApplicantDetailsExport($data), 'application.xlsx');
    }


    // export vacancy report
    public function exportVacancyReport ($data)
    {     
        // $response = Excel::store(new VacancyDetailExport($data),'exceldata/vacancyReport.xlsx');
        return Excel::download(new VacancyDetailExport($data), 'vacancyReport.xlsx');
    }


    // export insufficient-payment-report
    public function exportInsufficientPaymentReport ($data)
    {     
        $response = Excel::store(new InsufficientPaymentReportExport($data), 'exceldata/InsufficientPaymentReport.xlsx');
        return Excel::download(new InsufficientPaymentReportExport($data), 'InsufficientPaymentReport.xlsx');
    }


    // show vacancy report
    public function vacancyReport ()
    {
        return view('admin.applicant.viewvacancyreport');
    }

    
    // get vacancy report 
    public function getVacancyReport (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Applicant::getVacancyReport($post);

            // excel export
            if (isset($post['type'])=='excel' && isset($post['isexport']) == 'Y') {
                unset($data["totalfilteredrecs"]);
                unset($data["totalrecs"]);
                return  $this->exportVacancyReport($data);
            }
    
            // pdf download
            if (isset($post['type'])=='pdf' && isset($post['ispdf']) == 'Y') {
                unset($data["totalfilteredrecs"]);
                unset($data["totalrecs"]);
                $data['datas'] = $data;
                $pdf = PDF::loadView('exports.vacancyreport', $data);
                $pdf->setOption('margin-top',10);
                $pdf->setOption('margin-left',5);
                $pdf->setOption('margin-right',0);
                $pdf->setPaper('A4', 'landscape');
                $filename = "vacancyreport".".pdf";
                return $pdf->stream($filename, array('Attachment' => 0));
            }
         
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
    
            foreach ($data as $row) {
                if ($row->appliedstatus == 'Incomplete') {
                    $color = 'color:blue';
                } else if ($row->appliedstatus == 'Verified') {
                    $color = 'color:green';
                } else if ($row->appliedstatus == 'Pending') {
                    $color = 'color:black';
                } else if ($row->appliedstatus == 'Rejected') {
                    $color = 'color:red';
                } else {
                    $color = 'color:red';
                }
                $array[$i]["sn"] = $i + 1;
                $array[$i]["registrationnumber"] = $row->registrationnumber;
                $array[$i]["nepalifullname"] = $row->nepalifullname;
                $array[$i]["englishfullname"] = $row->englishfullname;
                $array[$i]["leveltitle"] = $row->leveltitle;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["email"] = $row->email;
                $array[$i]["dateofbirthbs"] = $row->dateofbirthbs;
                $array[$i]["dateofbirthad"] = $row->dateofbirthad;
                $array[$i]["fatherfullname"] = $row->fatherfullname;
                $array[$i]["motherfullname"] = $row->motherfullname;
                $array[$i]["grandfatherfullname"] = $row->grandfatherfullname;
                $birthday = $row->dateofbirthad;
                if($birthday != "Undefined offset: 1"){
                    $age = Carbon::parse($birthday)->diff(Carbon::now())->format('%y बर्ष');
                    $array[$i]["age"] = $age;
                }else{
                    $array[$i]["age"] = 'Invalid Data';
                }
    
                $array[$i]["gender"] = $row->gender;
                $array[$i]["citizenshipnumber"] = $row->citizenshipnumber;
                $array[$i]["designationtitle"] = $row->designationtitle;
                $array[$i]["jobcategory"] = $row->jobcategory;
                $array[$i]["receipnumber"] = $row->receipnumber;
                $array[$i]["paymentsource"] = $row->paymentsource;
                $array[$i]["applyamount"] = $row->applyamount;
                $array[$i]["applieddatead"] = $row->applieddatead;
                $array[$i]["remarks"] = $row->remarks;
                $array[$i]["appliedstatus"] = "<span style='".$color."'>".$row->appliedstatus."</span>";
                $action = "";
    
                // $action .= ' <a href="javascript:;" class="previewUser"  data-userid="' . $row->userid . '" data-designationid="'.$row->designationid.'" ><i class="fa fa-eye"> Preview </i></a>';
                // }
                $array[$i]["action"] = $action;
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


    // show insuficient payment file
    public function insufficientPaymentReport ()
    {
        return view('admin.applicant.viewinsufficientpaymentreport');
    }


    // get insufficient payemnt report
    public function getInsufficientPaymentReport (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Applicant::getInsufficientPaymentReport($post);

            // excel export
            if (isset($post['type']) == 'excel' && isset($post['isexport']) == 'Y') {
                unset($data["totalfilteredrecs"]);
                unset($data["totalrecs"]);
                return  $this->exportInsufficientPaymentReport($data);
            }
    
            // pdf download
            if (isset($post['type']) == 'pdf' && isset($post['ispdf']) == 'Y') {
                unset($data["totalfilteredrecs"]);
                unset($data["totalrecs"]);
                $data['datas'] = $data;
                $pdf = PDF::loadView('exports.insufficientpaymentreport', $data);
                $pdf->setOption('margin-top',10);
                $pdf->setOption('margin-left',5);
                $pdf->setOption('margin-right',0);
                $pdf->setPaper('A4', 'landscape');
                $filename = "insufficientpaymentreport".".pdf";
                return $pdf->stream($filename, array('Attachment' => 0));
            }
         
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
    
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1;
                $array[$i]["registrationnumber"] = $row->registrationnumber;
                $array[$i]["applieddatebs"] = Carbon::parse($row->applieddatebs)->format('Y-m-d');
                $array[$i]["fullname"] = $row->fullname;
                $array[$i]["gender"] = $row->gender;
                $array[$i]["email"] = $row->email;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["level"] = $row->level;
                $array[$i]["designation"] = $row->designation;
                $array[$i]["jobcategory"] = $row->jobcategory;
                $array[$i]["vacancyrate"] = $row->vacancyrate;
                $array[$i]["paidamount"] = $row->paidamount;            
                $array[$i]["dueamount"] = $row->vacancyrate-$row->paidamount;            
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
}