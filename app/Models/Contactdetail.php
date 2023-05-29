<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Exception;

class Contactdetail extends Model
{
    use HasFactory;

    // store contact details 
    public static function storeContactDetails ($post)
    {
        try {
            $contactDetailsArray = [                
                'userid' => $post['userid'],
                'personalid' => auth()->user()->personalid,
                'provinceid' => $post['provinceid'],
                'districtid' => $post['districtid'],
                'municipalityid' => $post[ 'municipalityid'],
                'ward' => $post['ward' ],
                'tole' => $post['tole'],
                'marga' => $post['marga'],
                'housenumber' => $post['housenumber'],
                'tempoprovinceid' => $post['tempoprovinceid'],
                'tempodistrictid' => $post['tempodistrictid'],
                'tempomunicipalityid' => $post['tempomunicipalityid'],
                'tempoward' => $post['tempoward' ],
                'tempotole' => $post['tempotole'],
                'tempomarga' => $post['tempomarga'],
                'tempohousenumber' => $post['tempohousenumber'],
                'tempophonenumber' => $post['tempophonenumber'],
                'mobilenumber' => $post['mobilenumber'],
                'email' => $post['email'],
                'maillingaddress' => $post['maillingaddress'],
                'postedby' => $post['userid'],
                'posteddatetime' => date('Y-m-d H:i:s')
            ];
            DB::beginTransaction();
            $result = false;
            if (empty($post['contactdetailid'])) {
                $result = DB::table('contactdetails')->insert($contactDetailsArray);
            } else {
                $result = DB::table('contactdetails')->where('id', $post['contactdetailid'])->update($contactDetailsArray);
            }
            if (!$result) {
                throw new Exception ("Couldn't Save Contact Details.Please, try again.", 1);
            }
            DB::commit();
            $response = [
                "success" => true,
                "id" => $contactDetailsArray['personalid']
            ];

        } catch (Exception $e){
            DB::rollback();
            $response = [
                "success" => false,
                "id" => $e->getMessage()
            ];
        }
        return $response;
    }
}
