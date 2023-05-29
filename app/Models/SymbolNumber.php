<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SymbolNumber extends Model
{
    use HasFactory;

    public static function getFiscalYears()
    {
        try{
            $result = DB::table('fiscal_years')->where('status', 'Y')->get();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }


    public static function getApplicants($post)
    {
        try{
            // DB::enableQueryLog();
            // $sql = DB::table('applydetails as ad')
            //             ->select('ad.id as applydetailid','ad.symbolnumber', 'v.level', 'd.title as designationtitle', 'fy.fiscalyearname')
            //             ->join('vacancies as v', 'v.vacancynumber', '=', 'ad.vacancnumber')
            //             ->join('designations as d', 'd.id', '=', 'v.designation')
            //             ->join('fiscal_years as fy', 'fy.id', '=', 'v.fiscalyearid');
            // $sql = $sql->where('ad.status', '=', 'Y');
            // if($post['isSymbolNumber']=='Y'){
            //     $sql = $sql->where('ad.symbolnumber', '!=', '');
            // }else if($post['isSymbolNumber']=='N'){
            //     $sql = $sql->where('ad.symbolnumber', '=', '');
            // }
            // $sql = $sql->where('v.status', '=', 'Y');
            // $sql = $sql->where('v.fiscalyearid', '=', $post['fiscalyearid']);
            // $sql = $sql->where('v.level', '=', $post['levelid']);
            // $sql = $sql->where('v.designation', $post['designationid']);
            // $result = $sql->get();
            // dd(DB::getQueryLog());
            $cond = " ad.status = 'Y' AND v.status = 'Y' AND d.status = 'Y' AND fy.status = 'Y' AND aj.status = 'Y' AND aj.appliedstatus = 'Verified' ";
            if(!empty($post['fiscalyearid'])){
                $cond .= " AND v.fiscalyearid = ".$post['fiscalyearid'];
            }
            if(!empty($post['levelid'])){
                $cond .= " AND v.level = ".$post['levelid'];
            }
            if(!empty($post['designationid'])){
                $cond .= " AND v.designation = ".$post['designationid'];
            }
            // $snmCond = '';
            // if(!empty($post['isSymbolNumber'] == 'Y')){
            //     $snmCond = " AND symbolnumber != '' ";
            // }else if(!empty($post['isSymbolNumber'] == 'Y')){
            //     $snmCond = " AND symbolnumber == '' ";
            // }
            $sql = "SELECT
                        ss.*,
                        snm.symbolnumber,
                        snm.examcentername,
                        snm.examcenterid 
                    FROM
                        (
                        SELECT
                            ad.applymasterid,
                            aj.userid,
                            v.level,
                            v.designation as designationid,
                            d.title AS designationtitle,
                            fy.fiscalyearname 
                        FROM
                            applydetails AS ad
                            INNER JOIN apply_jobs AS aj ON aj.id = ad.applymasterid
                            INNER JOIN vacancies AS v ON v.id = ad.jobpostid
                            INNER JOIN designations AS d ON d.id = v.designation
                            INNER JOIN fiscal_years AS fy ON fy.id = v.fiscalyearid 
                        WHERE
                           ".$cond."
                        ) AS ss
                        LEFT JOIN ( SELECT * FROM symbol_number_manages WHERE status = 'Y'  ) AS snm ON ss.userid = snm.userid 
                    ORDER BY
                        ss.userid ASC
            ";
            // echo $sql; exit;
            $result = DB::select($sql);

            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }


    //generates symbol numbers
    public static function generateSymbolNumber($post)
    {
        try{
            DB::enableQueryLog();

            $sql = DB::table('applydetails as ad')
                        ->select('ad.id as applydetailid','ad.symbolnumber', 'v.level', 'd.title as designationtitle')
                        ->join('vacancies as v', 'v.vacancynumber', '=', 'ad.vacancnumber')
                        ->join('designations as d', 'd.id', '=', 'v.designation');
            $sql = $sql->where('ad.status', '=', 'Y');
            $sql = $sql->where('ad.symbolnumber', '=', '');
            $sql = $sql->where('v.status', '=', 'Y');
            $sql = $sql->where('v.fiscalyearid', '=', $post['fiscalyearid']);
            $sql = $sql->where('v.level', '=', $post['levelid']);
            $sql = $sql->where('v.designation', $post['designationid']);
            $result = $sql->get();
            // dd(DB::getQueryLog());

            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    //returns symbolnumbers
    public static function getSymbolNumber($post)
    {
        try{
            $result = DB::table('symbol_number_manages')
                        ->select('id', 'userid', 'symbolnumber','examcenterid','status')
                        ->where(['status' => 'Y', 'designationid' => $post['designationid']])
                        ->orderBy('symbolnumber', 'ASC')
                        ->get();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    //returns symbolnumbers with examcenter assigned
    public static function getSymbolNumberWithExamcenter($post)
    {
        try{
            $result = DB::table('symbol_number_manages as snm')
                        ->select('snm.symbolnumber', 'ec.examcentername', 'd.title as designation')
                        ->join('designations as d', 'd.id', '=', 'snm.designationid')                           
                        ->leftJoin('exam_centers as ec', 'ec.id', '=', 'snm.examcenterid')                           
                        ->where(['snm.status' => 'Y', 'ec.status' => 'Y', 'snm.examcenterid' => $post['examcenterid']])
                        ->orderBy('snm.symbolnumber', 'ASC')
                        ->get();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }



    
}
