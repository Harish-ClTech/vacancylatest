<?php

namespace App\Http\Controllers;

use App\Models\AdmitCard;
use App\Models\Vacancy;
use App\Models\Common;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use PDF;
use Illuminate\Database\QueryException;

class PreviewController extends Controller
{
    protected $type;
    protected $message;
    protected $response;
    protected $queryExceptionMessage;
    public function __construct()
    {
        $this->type = 'success';
        $this->message = '';
        $this->response = false;
        $this->queryExceptionMessage = 'Something went wrong with form data. Please check your data and try again.';
    }

    public function preview()
    {
        $userid = auth()->user()->id; //auth()->user()->personalid;
        // dd($userid);
        $profile = DB::table('personals as p')
                        ->join('districts as d', 'p.citizenshipissuedistrictid', '=', 'd.id')->where(['userid'=>auth()->user()->id])->first();

        $extraDetails = DB::table('extradetails')->where(['userid'=>auth()->user()->id])->first();
        // $contactDetails = DB::table('contactdetails')->where(['userid'=>2])->first();
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
                ) AS TEMP ON TEMP.id = PERM.userid ";
        // echo $contactSql;

        $contactDetails = DB::select($contactSql);
        // dd($contactDetails);

        $personals   = DB::table('profiles')->where(['userid'=>$userid,'status'=>'Y'])->get()->first();

        $educationDetails = DB::table('educations as e')
            ->selectRaw('universityboardname,educationfaculty,educationinstitution,devisiongradepercentage,mejorsubject,name')
            ->join('academics as a','a.id', '=', 'e.educationlevel')
            ->where(['userid'=>$userid,'e.status'=>'Y'])->get()->all();
        // dd($educationDetails);

        $trainingDetails = DB::table('trainings')
            ->selectRaw('trainingname, trainingproviderinstitutionalname, gradedivisionpercent, fromdatebs, fromdatead, fromdatebs, enddatebs, enddatead')
            ->where(['userid'=>$userid,'status'=>'Y'])->get()->all();

        $experienceDetails = DB::table('experiences')
            ->selectRaw('officename, officeaddress, jobtype, designation, service, `group` , subgroup, ranklabel, fromdatebs, enddatebs, workingstatus, workingstatuslabel, remarks, document')
            ->where(['userid'=>$userid,'status'=>'Y'])->get()->all();

        $documentImage = DB::table('documents')->where(['userid'=>$userid,'status'=>'Y'])->get()->first();

        // $documentImage = DB::table('documents')
        //             ->where(['userid' => $userid])->get()->first();

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

        return view('admin.pages.preview.preview',$data);
    }

   /**
    * A function that is used to add school setup data.
    * 
    * @param Request request The request object.
    */
    public function submit(Request $request)
    {  
        $post = $request->all();

        $sql = "SELECT
                    designation,
                    servicesgroup,
                    jobcategory,
                    D.title,
                    servicegroupname,
                    vacancynumber,
                    academicid,
                    numberofvacancy,
                    name,
                    qualification,
                    agelimit
                FROM
                    vacancies AS V
                    JOIN designations AS D ON D.id = V.designation
                    JOIN servicegroups AS S ON S.id = V.servicesgroup
                    JOIN jobcategories AS J ON J.id = V.jobcategory
                WHERE
                    V.jobstatus = 'Active'
                    'V.status' ='Y' ";

        $vacancies = DB::select($sql);
        $checkdata = Common::checkRequiredDetails($post); 

        $vacancy = [];
        if(!empty($vacancies)){
            foreach ($vacancies as $key => $value) {
                $vacancy[$value->title.'-'.$value->servicegroupname]['agelimit'] = $value->agelimit;
                $vacancy[$value->title.'-'.$value->servicegroupname]['qualification'] = $value->qualification;
                $vacancy[$value->title.'-'.$value->servicegroupname]['designation'] = $value->designation;
                $vacancy[$value->title.'-'.$value->servicegroupname]['academicid'] = $value->academicid;
                $vacancy[$value->title.'-'.$value->servicegroupname]['servicesgroup'] = $value->servicesgroup;
                $vacancy[$value->title.'-'.$value->servicegroupname]['vacancycode'][] = $value->vacancynumber;
                $vacancy[$value->title.'-'.$value->servicegroupname]['jobcat'][$value->name][] = $value;
            }
        }

        //dd($vacancy);
        $data['vacancy']   = !empty($vacancy) ? $vacancy : array();
        $data['checkdata'] = $checkdata;

        // $vacancy= Vacancy::where('jobstatus','Active')->get();
        return view('admin.pages.preview.submit',$data);
    }
    
    
    public function getAdmitcardHolder(Request $request)
    {
        try{
            $post['viewAdmitCard']= $request->viewAdmitCard;
            $post['degid']= $request->degid;
            $post['isinternalvacancy'] = $request->isinternalvacancy;
            if($post['viewAdmitCard'] != true ){
                throw new Exception('Sorry There was problem with your data.', 1);
            }
            $post['userid'] = Auth::user()->id;
            $results = AdmitCard::printAdmitCard($post);
            $data = [
                'results' => $results,
                'isinternalvacancy' => $post['isinternalvacancy']
            ];
          
            return view('admin.pages.preview.admitcard.admitcardHolder', $data); 
         
        }catch(QueryException $qe){
            $this->type = 'error';
            $this->queryExceptionMessage;
        }catch(Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
    }
    public function getAdmitCardData($post)
    {
        $newArray = [];
        $dataArray = AdmitCard::printAdmitCard($post); 
        foreach($dataArray as $value){
            $newArray['userid']=$value->userid;
            $newArray['fullname']=$value->fullname;
            $newArray['signature']=$value->signature;
            $newArray['citizenshipfront']=$value->citizenshipfront;
            $newArray['citizenshipback']=$value->citizenshipback;
            $newArray['photography']=$value->photography;

            $newArray['cropped_signature']=$value->cropped_signature;
            $newArray['cropped_citizenshipfront']=$value->cropped_citizenshipfront;
            $newArray['cropped_citizenshipback']=$value->cropped_citizenshipback;
            $newArray['cropped_photograph']=$value->cropped_photograph;

            $newArray['registrationnumber']=$value->registrationnumber;
            $newArray['appliedstatus']=$value->appliedstatus;
            $newArray['designationid']=$value->designationid;
            $newArray['designation']=$value->designation;
            $newArray['isinternalvacancy']=$value->isinternalvacancy;
            $newArray['labelname']=$value->labelname;
            $newArray['servicegroupname']=$value->servicegroupname;
            $newArray['symbolnumber']=$value->symbolnumber;
            $newArray['examcentername']=$value->examcentername;
            $newArray['job'][$value->designation][$value->vacancynumber]= $value->jobcategoryname;
        }
        return (object)$newArray;
    }
   
    public function applicantAdmitCard(Request $request)
    {
        try{
            $post['viewAdmitCard']= $request->viewAdmitCard;
            $post['degid']= $request->degid;
            $post['isinternalvacancy']= $request->isinternalvacancy;
            if($post['viewAdmitCard'] !=true ){
                throw new Exception('Sorry There was problem with your data.', 1);
            }
            $post['userid'] = Auth::user()->id;
            $data['admitCard'] = $this->getAdmitCardData($post);
            $data['isinternalvacancy'] = $post['isinternalvacancy'];
            if(!empty($data['admitCard']->symbolnumber)){
                $degid = $data['admitCard']->designationid;
				$data['btnContent'] ='<a href="javascript:;" id="printAdmitCardBtn" data-data="'.$degid.'" class="btn btn-danger"> <i class="fa fa-print" aria-hidden="true"></i> Print</a>';
            }else{
                $data['btnContent'] ='<p>यो पेज Imageहरु Edit गर्ने प्रयोजनका लागि तयार पारिएको हो । यो प्रकृया सकिए पश्चात यस स्थानमा प्रवेश पत्र प्रिन्ट गर्ने Option पाउनुहुनेछ । </p>';
            }


            $signatureSetupInfo = DB::table('signature_setups')->where(['status'=>'Y'])->first();
            $signaturerow['authorizedOfficer'] =  !empty($signatureSetupInfo->fullname)?$signatureSetupInfo->fullname:'';
            $signaturerow['authorizedDesignation'] =  !empty($signatureSetupInfo->designation)?$signatureSetupInfo->designation:'';
            $signaturerow['signatureDate'] =  !empty($signatureSetupInfo->signaturedate)?$signatureSetupInfo->signaturedate:'';
            $signaturerow['authorizedSignatureSrc'] = !empty($signatureSetupInfo->signature)? asset('uploads/signaturesetup').'/'.@$signatureSetupInfo->signature:'';
            $data['signatureSetupInfo'] = $signaturerow;

            return view('admin.pages.preview.admitcard.viewAdmitCard',$data); 
         
        }catch(QueryException $qe){
            $this->type = 'error';
            $this->queryExceptionMessage;
        }catch(Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
    }

    public function printApplicantAdmitCard(Request $request)
    {
        try{
            $post['degid'] = $request->data;
            $post['isinternalvacancy'] = $request->vacancystatus;
            $post['userid'] = Auth::user()->id;
            $data['admitCard'] = $this->getAdmitCardData($post);
            $pdf = PDF::loadView('admin.pages.preview.admitcard.pdfAdmitCard', $data);   
            $pdf->setOption('disable-javascript', true);
            $pdf->setOption('enable-local-file-access', true);
            $pdf->setOption('orientation', 'portrait');
            $pdf->setOption('keep-relative-links', true); 
            $pdf->setOption('enable-external-links', true);
            $pdf->setOption('enable-internal-links', true);
            $filename = "AdmitCard".".pdf";
            return $pdf->stream($filename, array('Attachment' => 0));

        }catch(QueryException $qe){
            $this->type = 'error';
            $this->queryExceptionMessage;
        }catch(Exception $e){
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
    }
}
