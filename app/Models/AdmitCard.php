<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class AdmitCard extends Model
{
    use HasFactory;


    // get admit card data
    public static function getApplicantData ($post)
    {
        try {
            $get = $post;
            $cond = " AND 1=1 ";
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }

            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $cond = ' 1=1 ';
            $level = ' ';

            // if (!empty($post['designationid'])) {
            //     $designation= "and dg.id = ".$post['designationid']."";
            // }
            if (!empty($post['designationid'])) {
                $cond .= " AND designationid = ".$post['designationid']." ";
            }
            if (!empty($post['vacancytype'])) {
                $cond .= " AND isinternalvacancy = '".$post['vacancytype']."' ";
            }

            // if (!empty($post['levelid'])) {
            //     $level = "and lv.id = ".$post['levelid']." ";
            // }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";

            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }

            if ($get['sSearch_1'])
                $cond .= " AND nepalifullname like '%" . $get['sSearch_1'] . "%'";

            if ($get['sSearch_3'])
                $cond .= " AND lower(symbolnumber) like '%" . $get['sSearch_3'] . "%'";

            // $sql = "SELECT
            //             COUNT(*) OVER() AS totalrecs,
            //             ab.userid AS userid,
            //             ab.id AS jobapplyid,
            //             ab.registrationnumber AS registrationnumber,
            //             ab.appliedstatus AS appliedstatus,
            //             vc.vacancynumber AS vacancynumber,
            //             lv.labelname AS labelname,
            //             dg.title AS designation,
            //             dg.id AS designationid,
            //             jbc.name AS jobcategoryname,
            //             concat_ws( ' ', p.efirstname, p.emiddlename, p.elastname ) AS fullname
            //         FROM
            //             apply_jobs ab
            //             JOIN applydetails abd ON ab.id = abd.applymasterid
            //             JOIN vacancies vc ON vc.id = abd.jobpostid
            //             JOIN levels lv ON lv.id = vc.level
            //             JOIN designations dg ON dg.id = vc.designation
            //             JOIN jobcategories jbc ON jbc.id = vc.jobcategory
            //             JOIN personals p ON p.userid = ab.userid
            //         WHERE
            //             ab.status = 'Y'
            //             AND abd.status = 'Y'
            //             AND vc.status = 'Y' 
            //             AND ab.appliedstatus='Verified'   
            //             $designation $level
            // ";
            
            $sql = "SELECT
                        *,
                        COUNT(*) OVER() AS totalrecs 
                    FROM v_locasewa_reports
                    WHERE
                        $cond";

            if ($limit > -1) 
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            
            $result = DB::select($sql);
            // dd($result);
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


    // print admit card=-;'
    public static function printAdmitCard ($post)
    {
        try {
            $cond =' 1=1 ';
            if(!empty($post['designationid'])){
                $cond .= " and designationid = ".$post['designationid']."";
            }
            if(!empty($post['levelid'])){
                $cond .= " and levelid = ".$post['levelid']."";
            }
            if(!empty($post['userid'])){
                $cond .= " and userid = ".$post['userid']."";
            }
            // if(!empty($post['degid'])){
            //     $cond .= " and dg.id = ".$post['degid']."";
            // }
            if(!empty($post['degid'])){
                $cond .= " and designationid = ".$post['degid']."";
            }
            if(!empty($post['isinternalvacancy'])){
                $cond .= " and isinternalvacancy = '".$post['isinternalvacancy']."'";
            }
            // dd($post);
            $symbolCond = ' 1=1 ';
            if(!empty($post['symbol_from']) && !empty($post['symbol_to'])){
                // $symbolCond .= " AND symbolnumber BETWEEN ".$post['symbol_from']." AND ".$post['symbol_to']." ";
                $cond .= " AND symbolnumber BETWEEN ".$post['symbol_from']." AND ".$post['symbol_to']." ORDER BY symbolnumber ASC";
            }
            
            // $sql = "SELECT
            //             ab.userid AS userid,
            //             ab.id AS jobapplyid,
            //             ab.registrationnumber AS registrationnumber,
            //             ab.appliedstatus AS appliedstatus,
            //             vc.vacancynumber AS vacancynumber,
            //             sg.servicegroupname AS servicegroupname,
            //             lv.labelname AS labelname,
            //             dg.title AS designation,
            //             dg.id AS designationid,
            //             jbc.NAME AS jobcategoryname,
            //             concat_ws( ' ', p.efirstname, p.emiddlename, p.elastname ) AS fullname,
            //             dm.signature AS signature,
            //             dm.citizenshipfront AS citizenshipfront,
            //             dm.citizenshipback AS citizenshipback,
            //             dm.photography AS photography,
            //             dm.cropped_signature,
            //             dm.cropped_citizenshipfront,
            //             dm.cropped_citizenshipback,
            //             dm.cropped_photograph 	
            //         FROM
            //             apply_jobs AS ab
            //             JOIN applydetails abd ON ab.id = abd.applymasterid
            //             JOIN vacancies vc ON vc.id = abd.jobpostid
            //             JOIN servicegroups sg ON sg.id = vc.servicesgroup
            //             JOIN levels lv ON lv.id = vc.
            //             LEVEL JOIN designations dg ON dg.id = vc.designation
            //             JOIN jobcategories jbc ON jbc.id = vc.jobcategory
            //             JOIN documents dm ON dm.userid = ab.userid
            //             JOIN personals p ON p.userid = ab.userid
            //         WHERE
            //             ab.status = 'Y'
            //             AND abd.status = 'Y'
            //             AND vc.status = 'Y' 
            //             AND p.status='Y' 
            //             AND ab.appliedstatus='Verified' 
            //             ".$cond;
            

            // $sql = "SELECT
            //             ap.*,
            //             snm.symbolnumber,
            //             snm.examcentername,
            //             COUNT(*) OVER() AS totalrecs 
            //         FROM v_admincardprint as ap
            //         LEFT JOIN 
            //             (SELECT userid, symbolnumber, examcentername FROM symbol_number_manages WHERE ".$symbolCond.") as snm on snm.userid = ap.userid
            //         WHERE 
            //             ".$cond." 
            // ";
            $sql = "SELECT
                        ap.*,
                        COUNT(*) OVER() AS totalrecs 
                    FROM v_admitcardprint as ap
                    WHERE 
                        ".$cond." ";

            $results=DB::select($sql);
            return $results;
        } catch (Exception $e) {
            throw $e;
        }
    }


    // get single admit card detail
    public function getSingleAdmitCardData ($post)
    {
        try {
            $designation='';
            $level='';

            if(!empty($post['designationid'])){
                $designation= "and dg.id = ".$post['designationid']."";
            }
            if(!empty($post['levelid'])){
                $level= "and lv.id = ".$post['levelid']."";
            }

            $sql="SELECT
                    ab.userid AS userid,
                    ab.id AS jobapplyid,
                    ab.registrationnumber AS registrationnumber,
                    ab.appliedstatus AS appliedstatus,
                    vc.vacancynumber AS vacancynumber,
                    sg.servicegroupname AS servicegroupname,
                    lv.labelname AS labelname,
                    dg.title AS designation,
                    dg.id AS designationid,
                    jbc.name AS jobcategoryname,
                    concat_ws( ' ', p.efirstname, p.emiddlename, p.elastname ) AS fullname,
                    dm.signature AS signature,
                    dm.citizenshipfront as citizenshipfront,
                    dm.photography as photography
                FROM
                    ((((((((
                                            apply_jobs ab
                                            JOIN applydetails abd ON ( ab.id = abd.applymasterid ))
                                        JOIN vacancies vc ON ( vc.id = abd.jobpostid ))
                                        JOIN servicegroups sg ON ( sg.id = vc.servicesgroup ))
                                    JOIN levels lv ON ( lv.id = vc.level ))
                                JOIN designations dg ON ( dg.id = vc.designation ))
                            JOIN jobcategories jbc ON ( jbc.id = vc.jobcategory ))
                        JOIN documents dm ON ( dm.userid = ab.userid ))
                    JOIN personals p ON ( p.userid = ab.userid ))
                WHERE
                    ab.status = 'Y'
                    AND abd.status = 'Y'
                AND vc.status = 'Y' and p.status='Y' and ab.appliedstatus='Verified'   $designation $level ";

            $results = DB::select($sql);
    
            $dataArray = [];
            foreach ($results as $value)
            {
                $dataArray[$value->designation][$value->fullname]['fullname']=$value->fullname;
                $dataArray[$value->designation][$value->fullname]['signature']=$value->signature;
                $dataArray[$value->designation][$value->fullname]['citizenshipfront']=$value->citizenshipfront;
                $dataArray[$value->designation][$value->fullname]['photography']=$value->photography;
                $dataArray[$value->designation][$value->fullname]['registrationnumber']=$value->registrationnumber;
                $dataArray[$value->designation][$value->fullname]['appliedstatus']=$value->appliedstatus;
                $dataArray[$value->designation][$value->fullname]['designation']=$value->designation;
                $dataArray[$value->designation][$value->fullname]['labelname']=$value->labelname;
                $dataArray[$value->designation][$value->fullname]['servicegroupname']=$value->servicegroupname;
                $dataArray[$value->designation][$value->fullname]['job'][$value->designation][$value->vacancynumber]= $value->jobcategoryname;
            }
            return $dataArray;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

