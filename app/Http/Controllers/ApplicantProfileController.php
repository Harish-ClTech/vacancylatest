<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Common;
use App\Models\Document;
use App\Models\Personal;
use App\Models\Training;
use App\Models\Vacancy;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantProfileController extends Controller
{

    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;

    
    // constructor
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = '';
        $this->response = false;
        $this->queryExceptionMessage = "Something went wrong.Please, try again.";
    }


    // show main page
    public function index (Request $request)
    {
        $data['personalIds'] = Common::getProfileIds();

        return view('admin.pages.applicantprofile', $data);
    }

    

    //returns tabwise content
    public function getApplicatData(Request $request)
    {  
        try{
            $post = $request->all();
            $userid = auth()->user()->id;
            $post['userid'] = $userid;
            $verifyInfoDetails = Common::checkJobApplyDetails($post);

            $data = [];
            $view = '';
            $previousData = [];
            $verifyInfoDetails = [];
            $personalIds = Common::getProfileIds();



            $personalId = !empty($personalIds->personalid) ? $personalIds->personalid:'';
            $otherdetailId =!empty($personalIds->otherdetailid) ? $personalIds->otherdetailid:'';
            $contactId = !empty($personalIds->contactid) ? $personalIds->contactid:'';
            $educationId = !empty($personalIds->educationid) ? $personalIds->educationid:'';
            $experienceId = !empty($personalIds->experienceid) ? $personalIds->experienceid:'';
            $documentId = !empty($personalIds->documentid) ? $personalIds->documentid:'';
            $trainingId = !empty($personalIds->trainingid) ? $personalIds->trainingid:'';
            // dd(session()->all(), $personalId, $otherdetailId, $contactId, $educationId, $experienceId, $trainingId, $documentId);

            // $districts = Common::getDistricts();
            $districts = DB::table('districts')->where('status','Y')->get();
           

            if ($post['tabid'] == 'personal') 
            {
                if (!empty($post['userid'])) {
                    $previousData = Personal::previousAllData($post);
                }
                $data = [ 
                    'previousData' => $previousData,
                    'districts' => $districts,
                    'verifydoctdetails' => $verifyInfoDetails,
                    'saveurl' => route('storePersonalDetails')
                ];
                $view = 'admin.pages.personal.viewpersonalsetup';
            }
            else if ($post['tabid'] == 'otherdetail') 
            {
                if(!empty($personalId)){
                    if (!empty(@$post['userid'])) {
                        $previousData = DB::table('extradetails')->where('userid', $post['userid'])->first();
                    }
                    $data = [
                        'previousData' => @$previousData,
                        'saveurl' => route('storeExtraDetailsData'),
                        'verifydoctdetails'=> $verifyInfoDetails
                    ];
                    $view = 'admin.pages.otherdetails.otherdetailssetup';
                }else{
                    exit;
                }
            }
            else if ($post['tabid'] == 'contact') 
            {
                $provinces = DB::table('provinces')->where('status','Y')->get();
                $vdcormunicipalities = DB::table('vdcormunicipalities')->where('status','Y')->get();
                if(!empty($personalId) && !empty($otherdetailId)){
                    if (!empty($post['userid'])) {
                        $previousData = DB::table('contactdetails')
                                        ->where('userid', $post['userid'])
                                        ->first();
                    }
                    $data = [
                        'provinces' => $provinces,
                        'districts' => $districts,
                        'vdcormunicipalities' => $vdcormunicipalities,
                        'previousData' => @$previousData,
                        'verifydoctdetails' => $verifyInfoDetails
                    ];
                    $view = 'admin.pages.contactdetails.contactdetails';
                }else{
                    exit;
                }
            }
            else if ($post['tabid'] == 'education') 
            {
                if(!empty($personalId) && !empty($otherdetailId) && !empty($contactId)){
                    $data = [
                        'verifydoctdetails' => $verifyInfoDetails
                    ];
                    $view = 'admin.pages.education.vieweducationsetup';
                }else{
                    exit;
                }
            }
            else if ($post['tabid'] == 'experience') 
            {
                if(!empty($personalId) && !empty($otherdetailId) && !empty($contactId)){
                    $data = [];

                    $view = 'admin.pages.experience.viewexperiencesetup';
                }else{
                

                }
                
            }
            
            else if ($post['tabid'] == 'training') 
            {
                if(!empty($personalId) && !empty($otherdetailId) && !empty($contactId)){
                    $personalDetailsId = DB::table('personals')->select('id')->where('userid', auth()->user()->id)->first()->id;
                    if (!empty(@$post['trainingdetailid'])) {
                        $previousData = Training::previousAllData($post);
                    }
                    $data = [
                        'previousData' => @$previousData,
                        'saveurl' => route('storeTrainingDetails'),
                        'personalid' => @$personalDetailsId
                    ];
                    $view = 'admin.pages.training.viewtrainingsetup';
                }else{
                    exit;
                }
            }
            
            else if ($post['tabid'] == 'document') 
            {
                
                if(!empty($personalId) && !empty($otherdetailId) && !empty($contactId) && !empty($educationId)){
                    \DB::enableQueryLog(); // Enable query log

                    $document = Document::where('userid', auth()->user()->id)->first();
                    // Your Eloquent query executed by using get()

                    // dd(\DB::getQueryLog()); // Show results of log
                    if (!empty($userid)) {
                        $tabledata = DB::table('documents')->where('userid', $userid)->first();
                        $verifyInfoDetails = Common::checkJobApplyDetails($post);
                        if ($tabledata) {
                            $previousData = $tabledata;
                        }
                    }
                    $data = [
                        'previousData' => @$previousData,
                        'document' => $document,
                        'verifydoctdetails' => $verifyInfoDetails
                    ];
                    $view = 'admin.pages.document.viewdocumentsetup';
                }else{
                    exit;
                }
            }

            else if ($post['tabid'] == 'preview') 
            {
                if(!empty($personalId) && !empty($otherdetailId) && !empty($contactId) && !empty($educationId)  && !empty($documentId)){
                    $profile = DB::table('personals as p')
                                    ->join('districts as d', 'p.citizenshipissuedistrictid', '=', 'd.id')->where(['userid'=>auth()->user()->id])->first();

                    $extraDetails = DB::table('extradetails')->where(['userid'=>auth()->user()->id])->first();
                    $contactSql = "SELECT
                            *
                        FROM
                            (
                            SELECT
                                AD.*,
                                P.provincename,
                                D.districtname,
                                M.vdcormunicipalitiename
                            FROM
                                (
                                SELECT
                                    userid,
                                    provinceid,
                                    districtid,
                                    municipalityid,
                                    ward,
                                    tole,
                                    marga,
                                    housenumber,
                                    phonenumber
                                FROM
                                    contactdetails
                                WHERE
                                    userid =".auth()->user()->id."
                                    AND STATUS = 'Y'
                                ) AS AD
                                JOIN provinces AS P ON P.id = AD.provinceid
                                JOIN districts AS D ON D.id = AD.districtid
                                JOIN vdcormunicipalities AS M ON M.id = AD.municipalityid
                            ) AS PERM
                            JOIN (
                            SELECT
                                AD.*,
                                P.provincename AS tempprovincename,
                                D.districtname AS tempdistrictname,
                                M.vdcormunicipalitiename AS tempvdcormunicipalitiename
                            FROM
                                (
                                SELECT
                                    userid AS id,
                                    tempoprovinceid,
                                    tempodistrictid,
                                    tempomunicipalityid,
                                    tempoward,
                                    tempotole,
                                    tempomarga,
                                    tempohousenumber,
                                    tempophonenumber,
                                    maillingaddress
                                FROM
                                    contactdetails
                                WHERE
                                    userid = ".auth()->user()->id."
                                    AND STATUS = 'Y'
                                ) AS AD
                                JOIN provinces AS P ON P.id = AD.tempoprovinceid
                                JOIN districts AS D ON D.id = AD.tempodistrictid
                            JOIN vdcormunicipalities AS M ON M.id = AD.tempomunicipalityid
                            ) AS TEMP ON TEMP.id = PERM.userid 
                    ";

                    $contactDetails = DB::select($contactSql);
                    $personals   = DB::table('profiles')->where(['userid'=>$userid,'status'=>'Y'])->get()->first();
                    $educationDetails = DB::table('educations as e')
                        ->selectRaw('universityboardname,educationfaculty,educationinstitution,devisiongradepercentage,mejorsubject,name')
                        ->join('academics as a','a.id', '=', 'e.educationlevel')
                        ->where(['userid'=>$userid,'e.status'=>'Y'])->get()->all();

                    $trainingDetails = DB::table('trainings')
                        ->selectRaw('trainingname, trainingproviderinstitutionalname, gradedivisionpercent, fromdatebs, fromdatead, fromdatebs, enddatebs, enddatead')
                        ->where(['userid'=>$userid,'status'=>'Y'])->get()->all();

                    $experienceDetails = DB::table('experiences')
                        ->selectRaw('officename, officeaddress, jobtype, designation, service, `group` , subgroup, ranklabel, fromdatebs, enddatebs, workingstatus, workingstatuslabel, remarks, document')
                        ->where(['userid'=>$userid,'status'=>'Y'])->get()->all();

                    $documentImage = DB::table('documents')->where(['userid'=>$userid,'status'=>'Y'])->get()->first();

                    // calculate age
                    $personal = DB::table('personals')->select('dateofbirthad')->where(['userid'=>auth()->user()->id,'status'=>'Y'])->first();
                    $dobad = $personal->dateofbirthad;
                    $todaydatead = Carbon::now()->format('Y-m-d');
                    $datediff = Carbon::parse($dobad)->diff($todaydatead)->format('%y बर्ष, %m महिना, %d दिन');
                    $data = [
                        'profile' => $profile,
                        'extraDetails' => $extraDetails,
                        'contactDetails' => $contactDetails[0] ?? '',
                        'educationDetails' => $educationDetails,
                        'trainingDetails' => $trainingDetails,
                        'experienceDetails' => $experienceDetails,
                        'documentImage'=> $documentImage,
                        'agead' => $datediff,
                        'emailphone'=>$personals
                    ];
                    $view = 'admin.pages.preview.preview';
                }else{
                    exit;
                }
            }
            else if ($post['tabid'] == 'submit') 
            {

                $sql = "SELECT
                            designation,
                            servicesgroup,
                            jobcategory,
                            D.title,
                            servicegroupname,
                            vacancynumber,
                            vacancypublishdate,
                            vacancyenddate,
                            extendeddate,
                            academicid,
                            numberofvacancy,
                            J.name,
                            agelimit,
                            isinternalvacancy,
                            A.name AS qualification 
                        FROM
                            vacancies AS V
                            JOIN designations AS D ON D.id = V.designation
                            JOIN servicegroups AS S ON S.id = V.servicesgroup
                            JOIN jobcategories AS J ON J.id = V.jobcategory
                            JOIN academics AS A ON A.id = V.academicid 
                        WHERE
                            V.jobstatus = 'Active' AND V.status = 'Y'";


                $vacancies = DB::select($sql);
                $checkdata = Common::checkRequiredDetails($post); 

                $vacancy = [];
                if(!empty($vacancies)){
                    foreach ($vacancies as $key => $value) {

                        $isInternalVacant = '';
                        if($value->isinternalvacancy == 'Y'){
                            $isInternalVacant = '(आ.प्र)';
                        }

                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['agelimit'] = $value->agelimit;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['qualification'] = $value->qualification;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['designation'] = $value->designation;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['academicid'] = $value->academicid;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['servicesgroup'] = $value->servicesgroup;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['vacancycode'][] = $value->vacancynumber;
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['vacancypublishdate'] = $value->vacancypublishdate.' 23:59:59';
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['vacancyenddate'] = $value->vacancyenddate.' 23:59:59';
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['extendeddate'] = $value->extendeddate.' 23:59:59';
                        $vacancy[$value->title.'-'.$value->servicegroupname][$isInternalVacant]['jobcat'][$value->name][] = $value;
                    }
                }

                $data['vacancy']   = !empty($vacancy) ? $vacancy : array();
                $data['checkdata'] = $checkdata;
                // dd($data);

                $view = 'admin.pages.preview.submit';
            }
        }catch(QueryException $qe){
            $data = [];
        }catch(Exception $e){
            $data = [];
        }
        return view($view, $data);
    }


    

    // show applicant application
    public function myApplication ()
    {
        try {
            $post = [];
            $post['userid'] = auth()->user()->id;
            // $data['newvac'] = Vacancy::getCurrentVacancy();
            $data['appliedData'] = Common::getVacancywiseAppliedJobsDetails($post);

        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.myapplication', $data);
    }

    // show available vacancy list
    public function availableVacancy ()
    {
        return view('admin.availablevacancy');
    }


    // get vacancy list
    public function getAvailableVacancyList (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = Vacancy::getCurrentVacancyList($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                $array[$i]["vacancynumber"] = $row->vacancynumber;
                $array[$i]["labelname"] = $row->labelname;
                $array[$i]["designation"] = $row->designation;
                $array[$i]["academic"] = $row->academic;
                $array[$i]["servicegroupname"] = $row->servicegroupname;
                $array[$i]["jobcategoryname"] = $row->jobcategoryname;
                $array[$i]["numberofvacancy"] = $row->numberofvacancy;
                $array[$i]["vacancypublishdate"] = $row->vacancypublishdate;
                $array[$i]["vacancyenddate"] = $row->vacancyenddate;
                $array[$i]["extendeddate"] = $row->extendeddate;

                $isInternalVacancy = 'होइन';
                if($row->isinternalvacancy == 'Y'){
                    $isInternalVacancy = 'हो';
                }
                $array[$i]["isinternalvacancy"] = $isInternalVacancy;

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
