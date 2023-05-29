<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Mail;
use App\Mail\AccessGrant;

class Common extends Model
{
    //returns id's of diffrent profile related tables id of that loggedin user
    public static function getProfileIds()
    {
        try{
            $userid = auth()->user()->id;
            if(!$userid)
                throw new Exception('माफ गर्नुहोला ! तपाईले लगईन गर्नु भएको छैन ।', 1);
                
            $sql = "SELECT
                    p.id AS personalid,
                    d.id AS documentid,
                    ex.id AS otherdetailid,
                    cd.id AS contactid,
                    exp.experienceid,
                    tr.trainingid,
                    ed.educationid
                FROM
                    personals AS p
                    LEFT JOIN documents AS d ON p.userid = d.userid
                    LEFT JOIN extradetails AS ex ON p.userid = ex.userid
                    LEFT JOIN contactdetails AS cd ON p.userid = cd.userid
                    LEFT JOIN ( SELECT max( id ) AS experienceid, userid FROM experiences WHERE userid = ".$userid." ) AS exp ON exp.userid = p.userid
                    LEFT JOIN ( SELECT max( id ) AS trainingid, userid FROM trainings WHERE userid = ".$userid." ) AS tr ON tr.userid = p.userid
                    LEFT JOIN ( SELECT max( id ) AS educationid, userid FROM educations WHERE userid = ".$userid." ) AS ed ON ed.userid = p.userid
                WHERE
                    p.userid = ".$userid."
            ";
            $result = DB::select($sql);
            if(!empty($result)){
                $result = $result[0];
            }
         } catch (Exception $e) {
            throw $e;
        }
        return $result;
    }


    // check Required details
    public static function checkRequiredDetails ($post)
    {
        try {
            $result = DB::table('v_checkallrequired')->where(['userid' => $post['userid']])->get();
            return $result;

        } catch (QueryException $e) {
            throw $e;
        } 
    }


    // check for education details
    public static function checkEducationDetails ($post)
    {
        try {
            // $sql  = "SELECT
            //             * 
            //         FROM
            //             v_checkeducatioin 
            //         WHERE
            //             userid = ".$post['userid']
            //             AND designation = ".$post['designationid']." 
            //             AND servicesgroup = ".$post['servicesgroupid']." 
            //             AND academicid = ".$post['academicid'];

            // $result = DB::select($sql);

            $result = DB::table('v_checkeducatioin')
                        ->where([
                            'userid' => $post['userid'],
                            'designation' => $post['designationid'],
                            'servicesgroup' => $post['servicesgroupid'],
                            'academicid' => $post['academicid']
                        ]);

            if(!empty($result)) {
                return $result;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }    


    // get vacancy wise Applied details
    public static function getVacancywiseAppliedJobsDetails ($post)
    {
        try {
            $cond = ['userid'=>$post['userid']];
            if (!empty($post['designationid'])) {
                $cond['designationid'] = $post['designationid'];
            }
            // dd($cond);
            // $aplicantDetails = DB::table('v_new_aplicantreport')
            //                             ->where($cond)
            //                             ->orderBy('jobapplyid', 'desc')
            //                             ->get();

            $aplicantDetails = DB::table('v_new_applicantreport')
                                        ->where($cond)
                                        ->orderBy('jobapplyid', 'desc')
                                        ->get();

                                        // dd($aplicantDetails);

            $groupArray = [];
            $appliedVacancyArray = [];
            $applicantDetailsArray = [];
            if (!empty($aplicantDetails)) {
                // foreach($aplicantDetails as $akey=>$aval){
                //     $groupArray[$aval->designation] = $aval;
                // }
                foreach ($aplicantDetails as $akey=>$aval) {
                    $groupArray[$aval->jobapplyid]['receipnumber'] = $aval->receipnumber;
                    $groupArray[$aval->jobapplyid]['registrationnumber'] = $aval->registrationnumber;
                    $groupArray[$aval->jobapplyid]['applieddatead'] = $aval->applieddatead;
                    $groupArray[$aval->jobapplyid]['applyamount'] = $aval->applyamount;
                    $groupArray[$aval->jobapplyid]['paymentsource'] = $aval->paymentsource;
                    $groupArray[$aval->jobapplyid]['appliedstatus'] = $aval->appliedstatus;
                    // $groupArray[$aval->jobapplyid][$aval->designation][] = $aval;
                    // $groupArray[$aval->jobapplyid][$aval->designation][] = $aval;
                    // $groupArray[$aval->jobapplyid][$aval->designation][] = $aval;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['vacancycanceled']= $aval->vacancycanceled;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['appliedstatus']= $aval->appliedstatus;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['designationid']= $aval->designationid;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['remarks']= $aval->remarks;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['feedback']= $aval->feedback;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['jobCategories'][$aval->jobcategoryname]['jobcategoryname'] = $aval->jobcategoryname;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['jobCategories'][$aval->jobcategoryname]['vacancynumber'] = $aval->vacancynumber;
                    $groupArray[$aval->jobapplyid]['applyDetails'][$aval->designation]['jobCategories'][$aval->jobcategoryname]['vacancycanceledremarks'] = $aval->vacancycanceledremarks;
                }
                // foreach($aplicantDetails as $gkey=>$gval){
                //     $appliedVacancyArray[$gval->designation][$gval->vacancynumber]['vacancynumber'] = $gval->vacancynumber;
                //     $appliedVacancyArray[$gval->designation][$gval->vacancynumber]['jobcategoryname'] = $gval->jobcategoryname;
                //     $appliedVacancyArray[$gval->designation][$gval->vacancynumber]['vacancycanceled'] = $gval->vacancycanceled;
                //     $appliedVacancyArray[$gval->designation][$gval->vacancynumber]['vacancycanceledremarks'] = $gval->vacancycanceledremarks;
                // }
                // $applicantDetailsArray['applicantArray'] = $groupArray;
                // $applicantDetailsArray['appliedVacancyArray'] = $appliedVacancyArray;
                
                // return (object)$groupArray;
                return $groupArray;
            } else { 
                return [];
            }
        } catch (Exception $e) {
            $response = [ 
                "success" => false,
                "id" => $e->getMessage()
            ];
        }
        return $response;
    }


    // check job apply details
    public static function checkJobApplyDetails ($post)
    {
        try {
            $vacancyApplyStatus = DB::table('v_applystatusreport')->where(['userid'=>$post['userid']])->first(); 
            if(!empty($vacancyApplyStatus)) {
                return $vacancyApplyStatus;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    // get applied job details
    public static function getAppliedJobsDetails ($post)
    {
        try {
            $cond = ['userid' => $post['userid']];

            if (!empty($post['designationid'])) {
                $cond['designationid'] = $post['designationid'];
            }
            
            $aplicantDetails = DB::table('v_aplicantreport')
                                    ->where($cond)
                                    ->orderBy('jobapplyid', 'desc')
                                    ->get();

            if (!empty($aplicantDetails)) {
                return $aplicantDetails;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    // grant modify access
    public static function grantModifyAccess ($email, $fieldname)
    {
        Mail::to($email)->send(new AccessGrant($fieldname));
    }


    // get access log details 
    public static function getAccesslogs ($post)
    {
        try {
            $cond = " WHERE 1=1 ";
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }

            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(FT.fullname) like '%" . $get['sSearch_1'] . "%'";
    
            if ($get['sSearch_2'])
                $cond .= " AND lower(FT.contactnumber) like '%" . $get['sSearch_2'] . "%'";
    
            if ($get['sSearch_3'])
                $cond .= " AND lower(FT.sendby) like '%" . $get['sSearch_3'] . "%'";
    
             if ($get['sSearch_4'])
                $cond .= " AND lower(FT.message) like '%" . $get['sSearch_4'] . "%'";
    
            if ($get['sSearch_5'])
                $cond .= " AND lower(FT.logstatus) like '%" . $get['sSearch_5'] . "%'";
    
            if ($get['sSearch_6'])
                $cond .= " AND lower(FT.modulename) like '%" . $get['sSearch_6'] . "%'";
    
            if ($get['sSearch_7'])
                $cond .= " AND lower(FT.createdatetime) like '%" . $get['sSearch_7'] . "%'";
    
            if ($get['sSearch_8'])
                $cond .= " AND lower(FT.logqueue) like '%" . $get['sSearch_8'] . "%'";
    
            $sql = "SELECT
                        COUNT(*) OVER () AS totalrecs,
                        FT.* 
                    FROM
                        (
                        SELECT
                            CONCAT_WS( ' ', firstname, middlename, lastname ) AS fullname,
                            contactnumber,
                            sendby,
                            al.id,
                            message,
                            logstatus,
                            logqueue,
                            modulename,
                            al.createddatetime 
                        FROM
                            profiles AS pd
                            INNER JOIN accesslogs AS al ON pd.userid = al.userid 
                        WHERE
                            al.status = 'Y' 
                            AND pd.status = 'Y' 
                        ORDER BY
                            al.id DESC 
                        ) AS FT ".$cond;

    
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


    // get Vacancies
    public static function getVacancies ()
    {
        try {
            $result = [];
            $result = DB::table('vacancies as v')
                        ->selectRaw('designation,
                                servicesgroup,
                                jobcategory,
                                D.title,
                                servicegroupname,
                                vacancynumber,
                                academicid,
                                numberofvacancy,
                                name,
                                qualification,
                                agelimit')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->join('servicegroups as s', 's.id', '=', 'v.servicesgroup')
                        ->join('jobcategories as j', 'j.id', '=', 'v.jobcategory')
                        ->where([
                            'v.jobstatus' => 'Active', 
                            'v.status' => 'Y'
                        ])->get();

            return $result;

        } catch (Exception $e) {
            return [];
        }
    }


    // get districts
    public static function getDistricts ()
    {
        try {
            $districts = [];
            $districts = DB::table('districts')->where('status','Y')->get();
            return $districts;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get fiscal years
    public static function getFiscalYears()
    {
        try{
            $result = DB::table('fiscal_years')->where('status', 'Y')->get();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    // get levels
    public static function getLevels ($post)
    {
        try {
            $sql = DB::table('vacancies as v')
                        ->select('v.vacancynumber', 'v.level')
                        ->where([['v.status', '=', 'Y'], ['fiscalyearid', '=', $post['fiscalyearid']]]);

            $result = $sql->get()->groupBy('level');

            if (!empty($result)) {
                return $result;
            } else {
                return [];
            } 

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get designations list
    public static function getDesignations ($post)
    {
        try{

            $sql = DB::table('vacancies as v')
                        ->select('v.vacancynumber', 'v.level', 'd.id as designationid', 'd.title as designationtitle')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->where([['v.status', '=', 'Y'], ['d.status', '=', 'Y'], ['fiscalyearid', '=', $post['fiscalyearid']] ]);
            if (!empty($post['levelid'])) {
                $sql = $sql->where('v.level', $post['levelid']);
            }
            $result = $sql->groupBy('v.designation')->get();

            if (!empty($result)) {
                return $result;
            } else {
                return [];
            }

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get JSON data
    public static function getJsonData ($type, $message, $response) 
    {
        echo json_encode(['type' => $type, 'message' => $message, 'response' => $response]);
        exit;
    }
}
