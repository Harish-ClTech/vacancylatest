<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Bsdate;
class Vacancy extends Model
{
    use HasFactory;

    public static function storeVacancyDetails($post){
        try{

            $vancacyDetailsArray=[
                'vacancynumber' => $post['vacancynumber'],
                'level' => $post[ 'level'],
                'designation' => $post[ 'designation'],
                'servicesgroup' => $post[ 'servicesgroup'],
                'jobcategory' => $post[ 'jobcategory' ],
                'academicid' =>$post['academicid'],
                'vacancyrate' => $post['vacancyrate'],
                'numberofvacancy' => $post[ 'numberofvacancy'],
                'vacancypublishdate' => $post['vacancypublishdate'],
                'vacancyenddate' => $post['vacancyenddate'],
                'extendeddate' => $post[ 'extendeddate'],
                'jobstatus' => $post['jobstatus'],
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s'), 
            ];
 
            DB::beginTransaction();
            if(empty($post['vacancysetupid'])){
                $result=DB::table('vacancies')->insert($vancacyDetailsArray);
            }else{
            $result=DB::table('vacancies')->where('id',$post['vacancysetupid'])->update($vancacyDetailsArray);
                
            }
            DB::commit();
            return true;

        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public static function getVacancyDetailsData($post)
    {
        $cond = "v.status='Y'";
        $limit = 15;
        $offset = 0;
        $get = $_GET;
        foreach ($get as $key => $value) {
            $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
        }
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }


        if ($get['sSearch_1'])
            $cond .= " AND lower(v.vacancynumber) like '%" . $get['sSearch_1'] . "%'";
            if ($get['sSearch_2'])
            $cond .= " AND lower(v.level) like '%" . $get['sSearch_2'] . "%'";

            $sql = "Select  (select count(*) from vacancies where status='Y') as totalrecs,v.*,d.title,jc.name,sg.servicegroupname,l.labelname,a. name as qualification from vacancies as v
            join levels as l on l.id=v.level join servicegroups as sg on sg.id=servicesgroup 
            join designations as d on d.id=v.designation
            join academics as a on a.id=v.academicid
            join jobcategories as jc on jc.id=v.jobcategory
            where " . $cond . " and v.postedby= " . $post['userid'] . " order by v.id desc";


        if ($limit > -1) {
            $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
        }
        $result = DB::select($sql);
        if ($result) {
            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
        } else {
            $ndata = array();
        }
        return $ndata;
    }

    public static function previousAllData($post){
        try{
            $result=DB::table('vacancies')->where('id',$post['vacancysetupid'])->first();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    public static function getCurrentVacancy(){
        try{
          

            $result = DB::table('vacancies as v')
                        ->selectRaw('l.labelname, d.title as designation, a.name as academic, s.servicegroupname, jc.name as jobcategoryname, v.numberofvacancy, v.vacancyenddate, v.vacancynumber')
                        ->where('jobstatus', 'Active')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->join('academics as a', 'a.id', '=', 'v.academicid')
                        ->join('servicegroups as s','s.id', '=', 'v.servicesgroup')
                        ->join('jobcategories as jc','jc.id', '=', 'v.jobcategory')
                        ->join('levels as l', 'l.id', '=', 'v.level')
                        ->orderBy('vacancyenddate', 'desc')->get();
            if($result)
                return $result; 
            else 
                return [];
        } catch(Exeption $e) {
            throw $e;
        }
    }

    public static function getAppliedVacancy($post){
        try{
            $sql  = " SELECT JD.jobpostid, JM.receipnumber, JM.posteddatetime, JM.userid, FD.remarks, JM.appliedstatus, V.vacancynumber, D.title as degignationname  FROM applyjobmasters AS JM
                        INNER JOIN applyjobdetails AS JD ON JM.id = JD.applyjobmasterid
                        INNER JOIN vacancies AS V ON V.id  = JD.jobpostid
                        INNER JOIN designations AS D ON D.id = V.designation
                        LEFT JOIN feedbacks as FD ON JD.jobpostid = FD.jobpostid 
                        WHERE  JM.status ='Y' AND jm.userid = ".$post['userid']." ORDER BY JM.posteddatetime  DESC ";

            $result = DB::select($sql);
            if($result)
                return $result;
            else 
                return [];

        } catch(Exeption $e) {
            throw $e;
        }
    }

    public static function deleteVacancyDetailsData($post)
    {
        try {
            DB::beginTransaction();
            DB::table('vacancies')->where('id', $post['vacancysetupid'])->update(['status' => 'R']);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function designationTitle()
    {
        return $this->hasOne(Designation::class, 'id','designation');
    }
    public function servicegroup()
    {
        return $this->hasOne(Servicegroup::class,'id','servicesgroup');
    }
    public function jobCategory()
    {
        return $this->hasOne(Jobcategory::class,'id','jobcategory');
    }
}
