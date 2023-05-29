<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamCenter extends Model
{
    use HasFactory;

    //store examcenter
    public static function storeExamCenter ($post)
    {
        try {
            $examCenterArray = [
                'examcentername' => $post['examcentername'],
                'address' => $post[ 'address'],
                'status' => $post[ 'status'],
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s'), 
            ];
 
            DB::beginTransaction();
            
            $result = false;
            if (empty($post['examcenterid'])) {
                $result = DB::table('exam_centers')->insert($examCenterArray);
            } else {
                if( $post['status'] != 'Y'){
                    $isAssigned = DB::table('symbol_number_manages')->where('examcenterid', $post['examcenterid'])->get();
                    if(!empty($isAssigned)){
                        throw new Exception('माफ गर्नुहोला ! यस परिक्षाकेन्द्रमा परिक्षा तोकीएकोले स्थिति परिवर्तन गर्न असमर्थ छाैँ ।', 1);
                    }
                }
                $result = DB::table('exam_centers')->where('id',$post['examcenterid'])->update($examCenterArray);
            }
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    // list of all exam centers
    public static function examCenterList($post)
    {
        
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
        $cond = "status !='N'";

        if ($get['sSearch_1'])
            $cond .= " AND lower('examcentername') like '%" . $get['sSearch_1'] . "%'";

        if ($get['sSearch_2'])
            $cond .= " AND lower('address') like '%" . $get['sSearch_2'] . "%'";

        $sql = "SELECT 
                    count(*) over () as totalrecs,
                    id,
                    examcentername,
                    address,
                    status
                FROM exam_centers 
                WHERE 
                ". $cond ."
                ORDER BY id DESC
        ";

        if ($limit > -1) {
            $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
        }
        $result = DB::select($sql);
        if ($result ) {
            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
        } else {
            $ndata = array();
        }
        return $ndata;
    }

    // get previous data for edit
    public static function previousAllData($post){
        try{
            $result=DB::table('exam_centers')->where('id',$post['examcenterid'])->first();
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    //delete exam center
    public static function deleteExamCenter($post)
    {
        try {
            $isAssigned = DB::table('symbol_number_manages')->where('examcenterid', $post['examcenterid'])->get();
            if(empty($isAssigned)){
                $status = DB::table('exam_centers')->where('id', $post['examcenterid'])->update(['status' => 'N']);
            }else{
                throw new Exception('माफ गर्नुहोला ! यस परिक्षाकेन्द्रमा परिक्षा तोकीएकोले डिलिट गर्न असमर्थ छाैँ ।', 1);
            }
            return $status;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }    
}
