<?php

namespace App\Http\Controllers;

use App\Models\ApplyJobs;
use App\Models\Payment;
use App\Models\Vacancy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplyJobsController extends Controller
{
    //
    public function getjobdetails(Request $request)
    {
        $post = $request->all();

        $sql = "SELECT
                V.id,
                V.vacancynumber,
                V.level,
                V.designation,
                V.servicesgroup,
                V.jobcategory,
                V.vacancyrate,
                V.numberofvacancy,
                D.title,
                S.servicegroupname,
                J.name,
                L.labelname,
                D.id AS designationid,
                S.id AS servicegroupid
            FROM
                vacancies AS V
                JOIN designations AS D ON D.id = V.designation
                JOIN servicegroups AS S ON S.id = V.servicesgroup
                JOIN jobcategories AS J ON J.id = V.jobcategory 
                JOIN levels AS L ON L.id = V.level 
            WHERE
                designation =  '".$post['designationid']."'"."
                AND servicesgroup = '".$post['servicesgroupid']."'"."
                AND jobstatus = 'Active'";
        
        $vacancy = DB::select($sql);


        return view('admin.pages.applyjobs.jobdetails',compact('vacancy'));
    }

    public function storeApplyJobsDetails(Request $request){
        try{
            $post=$request->all();
            $type='success';
            $message='Apply Jobs Saved To Database';
            
            $response=Payment::storeApplyJobDetails($post);
            // // json_decode($post['appliedJobdetails'],true);
            return $response;
        }catch(Exception $e){
            $response=false;
            $type='errro';
            $message=$e->getMessage();

        } 
        echo json_encode(array('type'=>$type,'message'=>$message,'response'=>$response));

    }
}
