<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class VacancyDateMaster extends Model
{
    use HasFactory;

    // returns previous data on the basis of id
    public static function previousAllData($post){
        try{
            $result=DB::table('vacancy_date_masters')->where('id',$post['dataid'])->first();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }


    // store vacancy date
    public static function storeVacancyDate ($post)
    {
        try {
            $vancacyDateArray = [
                'fiscalyearid' => $post['fiscalyearid'],
                'vacancypublishdate' => $post['vacancypublishdate'],
                'vacancyenddate' => $post['vacancyenddate'],
                'vacancyextendeddate' => $post[ 'vacancyextendeddate'],
                'allow_registration' => !empty($post['allow_registration'])?$post['allow_registration']:'N',
                'status' => 'Y',
                'postedby' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $result = false;
            if (!empty($post['vacancydatemasterid'])) {
                $result = DB::table('vacancy_date_masters')->where('id',$post['vacancydatemasterid'])->update($vancacyDateArray);
            } else {
                $result = DB::table('vacancy_date_masters')->insert($vancacyDateArray);
            }
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }

    // get vacancy date list
    public static function getVacancyDateList($post)
    {
        try {
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
            \DB::enableQueryLog();
            $limit = 15;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            // $sql = DB::table('vacancy_date_masters as vdm')
            //             ->selectRaw('count(*) over() as totalrecs, vdm.id as vacancydatemasterid, vdm.vacancypublishdate, vdm.vacancyenddate, vdm.vacancyextendeddate, vdm.allow_registration, vdm.status, fy.fiscalyearname')
            //             ->whereRaw(['vmd.status'=> 'Y', 'fy.status'=>'Y'])
            //             ->join('fiscal_years as fy', 'fy.id', '=', 'vdm.fiscalyearid')
            //             ->orderBy('vdm.id', 'desc');
            $sql = "SELECT count(*) over() as totalrecs, vdm.id as vacancydatemasterid, vdm.vacancypublishdate, vdm.vacancyenddate, vdm.vacancyextendeddate, vdm.allow_registration, vdm.status, fy.fiscalyearname
                        FROM vacancy_date_masters as vdm
                        join fiscal_years as fy on fy.id = vdm.fiscalyearid
                    WHERE  
                        vdm.status = 'Y'
                        AND fy.status = 'Y'
                    ORDER BY
                        vdm.id DESC
            ";

            // if($get['sSearch_1'])
            //     $sql = $sql->whereRaw(" lower(fy.fiscalyearname) like '%".$get['sSearch_1']."%'");

            // if($get['sSearch_2'])
            //     $sql = $sql->whereRaw(" lower(vdm.vacancypublishdate) like '%".$get['sSearch_2']."%'");

            // if($get['sSearch_3'])
            //     $sql = $sql->whereRaw(" lower(vdm.vacancyenddate) like '%".$get['sSearch_3']."%'");

            // if($get['sSearch_4'])
            //     $sql = $sql->whereRaw(" lower(vdm.vacancyextendeddate) like '%".$get['sSearch_4']."%'");
            

            // if ($limit > -1) {
            //     $sql = $sql->take($limit)->skip($offset);
            // }
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            }

            // $result = $sql->get();
            // echo $sql; exit;
            $result = DB::select($sql);
            // dd(\DB::getQueryLog());

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

    // allow registration
    public function allowRegistration ($post)
    {
        try {
            $result = DB::table('vacancy_date_masters')->where('id', $post['vacancymasterid'])->update(['allow_registration' => $post['allow_registration']]);
            if ($result) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    
  
    // delete vacancy-date-master
    public static function deleteVacancyDateMaster ($post)
    {
        try {
            $result = DB::table('vacancy_date_masters')->where('id', $post['dataid'])->update(['status' => 'R']);
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
