<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extradetail extends Model
{
    use HasFactory;


    // store extra details
    public static function storeExtraDetails ($post)
    {
        try {
            $extraDetailsArray = [                
                'userid' => $post['userid'],
                'personalid' => (int)auth()->user()->personalid,
                'cast' => $post['cast'],
                'religion' => $post['religion'],
                'religionother' => $post['religionother'],
                'maritalstatus' => $post['maritalstatus'],
                'employmentstatus' => $post['employmentstatus'],
                'employmetothers' => $post['employmetothers'],
                'motherlanguage' => $post['motherlanguage'],
                'spousename' => $post['spousename'],
                'spousecitizen' => $post['spousecitizen'],
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            DB::beginTransaction();
            $result = false;
            if (empty($post['extradetailid']) || $post['extradetailid'] == 'null' || $post['extradetailid'] == null) {
                $result = DB::table('extradetails')->insert($extraDetailsArray);
            } else {
                $result = DB::table('extradetails')->where('id', $post['extradetailid'])->update($extraDetailsArray); 
            }

            if (!$result) {
                throw new Exception ("Something went wrong.Please, try again.", 1);
            }
            DB::commit();
            $response = [
                "success" => true,
                "id" => $extraDetailsArray['personalid']
            ];

        } catch (Exception $e) {
            DB::rollback();
            $response = [
                "success" => false,
                "id" => $e->getMessage()
            ];
        }
        return $response;
    }
}
