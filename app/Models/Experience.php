<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Experience extends Model
{
    use HasFactory;

    // store experience details
    public static function storeExperienceDetails ($post)
    {
        try {
            $experinceDetailsArray = [ 
                'userid' => $post['userid'],
                'personalid' => auth()->user()->personalid,
                'officename' => $post[ 'officename'],
                'officeaddress' => $post['officeaddress'],
                'designation' => $post['designation'],
                'jobtype' => $post['jobtype'],
                'service' => $post['service'],
                'group' => $post['group'],
                'subgroup' => $post['subgroup'],
                'ranklabel' => $post['ranklabel'],
                'fromdatebs' => $post['fromdatebs'],
                'enddatebs' => $post['enddatebs'],
                'workingstatus' => $post['workingstatus'],
                'workingstatuslabel' => $post['workingstatuslabel'],
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            if (!empty($post['document'])) {
                $experinceDetailsArray['document'] = json_encode($post['document']);
            } else {
                $experinceDetailsArray['document'] = $post['back_document'];
            }
            DB::beginTransaction();
            $result = false;
            if (empty($post['experiencedetailid'])) {
                $result = DB::table('experiences')->insert($experinceDetailsArray);
            } else {
                $result = DB::table('experiences')->where('id', $post['experiencedetailid'])->update($experinceDetailsArray);
            }
            DB::commit();
            return $result;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // get experience details data in datatables
    public static function getExperienceDetailsData ($post)
    {
        try {
            $cond = " ";

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
    
            if ($get['sSearch_1']) {
                $cond .= " AND lower(municipalityname) like '%" . $get['sSearch_1'] . "%'";
            }

            $sql = "SELECT
                        count(*) as totalrecs,
                        e.* 
                    FROM
                        experiences AS e 
                    WHERE
                        e.status='Y' 
                        AND e.postedby = " . $post['userid'] . "
                        " . $cond . " 
                    ORDER BY
                        e.id DESC";
    
    
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

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get previous data
    public static function previousAllData ($post)
    {
        try {
            $result = [];
            $result = DB::table('experiences')->where('id', $post['experiencedetailid'])->first();
            return $result;

        } catch (Exception $e){
            throw $e;
        }
    }


    // delete experience details data
    public static function deleteExperienceDetailsData ($post)
    {
        try {
            $isDeleted = false;
            $isDeleted = DB::table('experiences')->where('id', $post['experiencedetailid'])->update(['status' => 'R']);
            return $isDeleted;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
