<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Education extends Model
{
    use HasFactory;

    // store education details
    public static function storeEducationDetails ($post)
    {
        try {
            $educationDetailsArray = [
                'userid' => $post['userid'],
                'personalid' => auth()->user()->personalid,
                'universityboardname' => $post['universityboardname'],
                'educationlevel' => $post['educationlevel'],
                'educationfaculty'=>$post['educationfaculty'],
                'educationinstitution' => $post['educationinstitution'],
                'devisiongradepercentage' => $post['devisiongradepercentage'],
                'mejorsubject' => $post['mejorsubject'],
                'qulificationawardeddetails' => $post['qulificationawardeddetails'],
                'passoutdatead' => $post['passoutdatead'],
                'passoutdatebs' => $post['passoutdatebs'],
                'educationaltype' => $post['educationaltype'],
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')        
            ];

            if (!empty($post['academicdocument'])) {
                $educationDetailsArray['academicdocument'] = json_encode($post['academicdocument']);
            } else {
                $educationDetailsArray['academicdocument'] = $post['back_academicdocument'];
            }

            if (!empty($post['equivalentdocument'])) {
                $educationDetailsArray['equivalentdocument'] = $post['equivalentdocument'];
            } else {
                $educationDetailsArray['equivalentdocument'] = $post['back_equivalentdocument'];
            }
            DB::beginTransaction();
            $result = false;
            if (empty($post['educationdetailid'])) {
                $result = DB::table('educations')->insert($educationDetailsArray);
            } else {
                $result = DB::table('educations')->where('id', $post['educationdetailid'])->update($educationDetailsArray);
            }
            DB::commit();
            return $result;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // get educational details in datatables 
    public static function getEducationDetailsData ($post)
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
                $cond .= " AND lower(e.universityboardname) like '%" . $get['sSearch_1'] . "%'";

            if ($get['sSearch_1'])
                $cond .= " AND lower(e.educationlevel) like '%" . $get['sSearch_1'] . "%'";

        
            $sql = "SELECT
                        ( SELECT count(*) FROM educations WHERE status = 'Y' AND postedby = 13 ) AS totalrecs,
                        e.*,
                        a.name 
                    FROM
                        educations AS e
                        JOIN academics AS a ON a.id = e.educationlevel 
                    WHERE
                        e.status =  'Y'
                        AND e.postedby = " . $post['userid'] . " 
                        AND a.status = 'Y' 
                        " . $cond . " 
                    ORDER BY
                        e.id DESC";
                
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
            }
            // echo $sql; exit;
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


    // get previous educational details
    public static function previousAllData ($post)
    {
        try {
            $result = [];
            $result = DB::table('educations')->where('id', $post['educationdetailid'])->first();
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }


    // delete educational details 
    public static function deleteEducationDetailsData ($post)
    {
        try {
            $isDeleted = false;
            $isDeleted = DB::table('educations')->where('id', $post['educationdetailid'])->update(['status' => 'R']);
            return $isDeleted;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
