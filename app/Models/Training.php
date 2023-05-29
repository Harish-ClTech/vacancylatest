<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Exception;

class Training extends Model
{
    use HasFactory;

    // store training details
    public static function storeTrainingDetails ($post)
    {
        try {
            $trainingDetailsArray = [                
                'userid' => $post['userid'],
                'personalid' => auth()->user()->personalid,
                'trainingproviderinstitutionalname' => $post[ 'trainingproviderinstitutionalname'],
                'trainingname' => $post[ 'trainingname'],
                'gradedivisionpercent' => $post['gradedivisionpercent'],
                'fromdatebs' => $post[ 'fromdatebs'],
                'enddatebs' => $post[ 'enddatebs' ],
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];
            // dd($post); 
            if (!empty($post['documents'])) {
                $trainingDetailsArray['document'] = json_encode($post['documents']);
            } else {
                $trainingDetailsArray['document'] = $post['back_document'];
            }
            DB::beginTransaction();
            $result = false;
            if (empty($post['trainingdetailid'])) {
                $result = DB::table('trainings')->insert($trainingDetailsArray);
            } else {
                $result = DB::table('trainings')->where('id',$post['trainingdetailid'])->update($trainingDetailsArray); 
            }
            if (!$result) {
                throw new Exception ('Something went wrong.Please, try again.', 1);
            }
            DB::commit();
            return $result;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // list traingin details in datatables
    public static function getTrainingDetailsData ($post)
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
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(trainingproviderinstitutionalname) like '%" . $get['sSearch_1'] . "%'";
    
            $sql = "SELECT
                        count(*) AS totalrecs,
                        t.* 
                    FROM
                        trainings AS t 
                    WHERE
                        t.status = 'Y'
                        AND t.postedby = " . $post['userid'] . " 
                        " . $cond . " 
                    ORDER BY
                        t.id DESC";
    
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
            $result = DB::table('trainings')->where('id',$post['trainingdetailid'])->first();
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // delete training data
    public static function deleteTrainingDetailsData ($post)
    {
        try {
            $isDeleted = false;
            $isDeleted = DB::table('trainings')->where('id', $post['trainingdetailid'])->update(['status' => 'R']);
            return $isDeleted;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
