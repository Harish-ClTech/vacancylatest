<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    use HasFactory;

    public static function storeDocumentDetails($post){
        try{
            $documentDetailsArray=[
                'userid' => auth()->user()->id,
                'personalid' => auth()->user()->personalid,
                'photography' => !empty($post['photographys']) ?$post['photographys'] :$post['back_photographys'],
                'citizenshipfront' => !empty($post['citizenshipfronts']) ? $post['citizenshipfronts'] : $post['back_citizenshipfronts'],
                'citizenshipback' => !empty($post['citizenshipbacks']) ?$post['citizenshipbacks'] :$post['back_citizenshipbacks'],
                'inclusiongroupcertificateadibashi' => !empty($post['inclusiongroupcertificateadibashi']) ? $post['inclusiongroupcertificateadibashi'] : $post['back_inclusiongroupcertificateadibashi'],
                'inclusiongroupcertificatejanajati' => !empty($post['inclusiongroupcertificatejanajati']) ?$post['inclusiongroupcertificatejanajati'] :$post['back_inclusiongroupcertificatejanajati'],
                'inclusiongroupcertificatedalit' => !empty($post['inclusiongroupcertificatedalit']) ?$post['inclusiongroupcertificatedalit'] : $post['back_inclusiongroupcertificatedalit'] ,
                'inclusiongroupcertificatepixadiyeko' => !empty($post['inclusiongroupcertificatepixadiyeko']) ?$post['inclusiongroupcertificatepixadiyeko'] :$post['back_inclusiongroupcertificatepixadiyeko'],
                'inclusiongroupcertificatemadesi'    => !empty($post['inclusiongroupcertificatemadesi']) ?$post['inclusiongroupcertificatemadesi'] :$post['back_inclusiongroupcertificatemadesi'] ,
                'signature' => !empty($post['signatures']) ?$post['signatures'] :$post['back_signatures'] ,
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s'),
            ];

            DB::beginTransaction();
            if(empty($post['documentdetailid'])){
            $result=DB::table('documents')->insert($documentDetailsArray);
            }else{
            $result=DB::table('documents')->where('id',$post['documentdetailid'])->update($documentDetailsArray);

            }
            DB::commit();
            return true;

        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }
    }

  
    
}
