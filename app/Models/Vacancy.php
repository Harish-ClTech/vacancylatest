<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception, Bsdate;

class Vacancy extends Model
{
    use HasFactory;

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


    // store vacancy detail
    public static function storeVacancyDetails ($post)
    {
        try {
            $isInternalVacancy = 'N';
            if(isset($post['isinternalvacancy'])){
                $isInternalVacancy = 'Y';
            }
            $vancacyDetailsArray = [
                'vacancynumber' => $post['vacancynumber'],
                'level' => $post[ 'level'],
                'designation' => $post[ 'designation'],
                'servicesgroup' => $post[ 'servicesgroup'],
                'jobcategory' => $post[ 'jobcategory' ],
                'academicid' =>$post['academicid'],
                'vacancyrate' => (int)$post['vacancyrate'],
                'numberofvacancy' => $post[ 'numberofvacancy'],
                'vacancypublishdate' => $post['vacancypublishdate'],
                'vacancyenddate' => $post['vacancyenddate'],
                'extendeddate' => $post[ 'extendeddate'],
                'jobstatus' => $post['jobstatus'],
                'agelimit' => $post['agelimit'],
                'isinternalvacancy' => $isInternalVacancy,
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s')
            ];
            // dd($vancacyDetailsArray);
            
 
            $result = false;
            if (!empty($post['vacancysetupid'])) {
                $result = DB::table('vacancies')->where('id',$post['vacancysetupid'])->update($vancacyDetailsArray);
            } else {
                $result = DB::table('vacancies')->insert($vancacyDetailsArray);
            }
            return $result;

        } catch (QueryException $e) {
            throw $e;
        }
    }


    // get vacancies details
    public static function getVacancyDetailsData ($post)
    {
        try {
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
            
            $limit = 15;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            
            $cond = "v.status='Y'";
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(v.vacancynumber) like '%" . $get['sSearch_1'] . "%'";
    
            if ($get['sSearch_2'])
                $cond .= " AND lower(v.level) like '%" . $get['sSearch_2'] . "%'";
    
            $sql = "SELECT
                        ( SELECT count(*) FROM vacancies WHERE status = 'Y' ) AS totalrecs,
                        v.*,
                        d.title,
                        jc.name,
                        sg.servicegroupname,
                        l.labelname,
                        a.name AS qualification 
                    FROM
                        vacancies AS v
                        JOIN levels AS l ON l.id = v.level 
                        JOIN servicegroups AS sg ON sg.id = servicesgroup
                        JOIN designations AS d ON d.id = v.designation
                        JOIN academics AS a ON a.id = v.academicid
                        JOIN jobcategories AS jc ON jc.id = v.jobcategory 
                    WHERE
                        " . $cond . " 
                    ORDER BY
                        v.id DESC";
    
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            }
    
            $result = DB::select($sql);
    
            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            return $ndata;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get previous vacancy details
    public static function previousAllData ($post)
    {
        try {
            $result = DB::table('vacancies')->where('id', $post['vacancysetupid'])->first();
            return $result;

        } catch (Exception $e){
            throw $e;
        }
    }


    // get current vacancy details
    public static function getCurrentVacancy ()
    {
        try {
            $result = DB::table('vacancies as v')
                        ->selectRaw('l.labelname, d.title as designation, a.name as academic, s.servicegroupname, 
                        jc.name as jobcategoryname, v.numberofvacancy, v.vacancypublishdate, v.vacancyenddate, v.extendeddate, v.vacancynumber')
                        ->where('jobstatus', 'Active')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->join('academics as a', 'a.id', '=', 'v.academicid')
                        ->join('servicegroups as s','s.id', '=', 'v.servicesgroup')
                        ->join('jobcategories as jc','jc.id', '=', 'v.jobcategory')
                        ->join('levels as l', 'l.id', '=', 'v.level')
                        ->orderBy('v.id', 'asc')->get();

            if (!empty($result)) {
                return $result; 
            } else {
                return [];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    // get current vacancy list
    public static function getCurrentVacancyList($post)
    {
        try {
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }

            $limit = 15;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $today = Carbon::now()->format('Y-m-d');
            $currentDate = \Bsdate::eng_to_nep($today);
            // dd($currentDate);
            $sql = DB::table('vacancies as v')
                        ->selectRaw('count(*) over() as totalrecs, l.labelname, d.title as designation, a.name as academic, s.servicegroupname, 
                        jc.name as jobcategoryname, v.numberofvacancy, v.vacancypublishdate, v.vacancyenddate, v.extendeddate, v.vacancynumber, v.isinternalvacancy')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->join('academics as a', 'a.id', '=', 'v.academicid')
                        ->join('servicegroups as s','s.id', '=', 'v.servicesgroup')
                        ->join('jobcategories as jc','jc.id', '=', 'v.jobcategory')
                        ->join('levels as l', 'l.id', '=', 'v.level')
                        ->where('v.extendeddate','>=', $currentDate)
                        ->whereRaw("v.jobstatus = 'Active' AND v.status = 'Y'")
                        ->orderBy('v.id', 'asc');
            if($get['sSearch_1'])
                $sql = $sql->whereRaw(" lower(v.vacancynumber) like '%".$get['sSearch_1']."%'");

            if($get['sSearch_2'])
                $sql = $sql->whereRaw(" lower(l.labelname) like '%".$get['sSearch_2']."%'");

            if($get['sSearch_3'])
                $sql = $sql->whereRaw(" lower(d.title) like '%".$get['sSearch_3']."%'");

            if($get['sSearch_5'])
                $sql = $sql->whereRaw(" lower(s.servicegroupname) like '%".$get['sSearch_5']."%'");
            
            if($get['sSearch_6'])
                $sql = $sql->whereRaw(" lower(jc.name) like '%".$get['sSearch_6']."%'");



                       
            if ($limit > -1) {
                $sql = $sql->take($limit)->skip($offset);
            }

            $result = $sql->get();
            

            if ($result) {
                $ndata = $result;
                $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
                $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            } else {
                $ndata = array();
            }
            return $ndata;
        } catch (Exception $e) {
            throw $e;
        }
    }


    // get applied vacancy detail
    public static function getAppliedVacancy ($post)
    {
        try {
            // $sql  = "SELECT
            //             JD.jobpostid,
            //             JM.receipnumber,
            //             JM.posteddatetime,
            //             JM.userid,
            //             FD.remarks,
            //             JM.appliedstatus,
            //             V.vacancynumber,
            //             D.title AS degignationname 
            //         FROM
            //             applyjobmasters AS JM
            //             INNER JOIN applyjobdetails AS JD ON JM.id = JD.applyjobmasterid
            //             INNER JOIN vacancies AS V ON V.id = JD.jobpostid
            //             INNER JOIN designations AS D ON D.id = V.designation
            //             LEFT JOIN feedbacks AS FD ON JD.jobpostid = FD.jobpostid 
            //         WHERE
            //             JM.STATUS = 'Y' 
            //             AND jm.userid = ".$post['userid']." 
            //         ORDER BY
            //             JM.posteddatetime DESC";

            $sql = DB::table('applyjobmasters AS jm')
                        ->join('applyjobdetails AS jd', 'jd.applyjobmasterid', '=', 'jm.id')
                        ->join('vacancies AS v', 'jd.jobpostid', '=', 'v.id')
                        ->join('designations AS d', 'v.designation', '=', 'd.id')
                        ->leftJoin('feedbacks AS fd', 'jd.jobpostid', '=', 'fd.jobpostid')
                        ->select('jd.jobpostid', 'jm.receipnumber', 'jm.posteddatetime', 'jm.userid', 'fd.remarks', 'jm.appliedstatus', 'v.vacancynumber', 'd.title AS degignationname')
                        ->where(['jm.status' => 'Y', 'jm.userid' => $post['userid']])
                        ->orderBy('jm.posteddatetime', 'DESC');

            $result = $sql->get()->all();
            
            return $result;

        } catch (Exeption $e) {
            throw $e;
        }
    }


    // delete vacancy detail
    public static function deleteVacancyDetailsData ($post)
    {
        try {
            $result = DB::table('vacancies')->where('id', $post['vacancysetupid'])->update(['status' => 'R']);
            if ($result) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw $e;
        }
    }



    
}
