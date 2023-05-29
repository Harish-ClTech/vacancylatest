<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Auth;
use Exception;
use Image;
use File;

class Document extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'personalid', 'userid', 'photography', 'citizenshipfront', 
        'citizenshipback', 'inclusiongroupcertificateadibashi', 
        'inclusiongroupcertificatejanajati', 'inclusiongroupcertificatedalit', 
        'inclusiongroupcertificatepixadiyeko', 'inclusiongroupcertificatemadesi', 
        'signature', 'status', 'postedby', 'posteddatetime', 'lastmodifiedby', 
        'lastmodifieddatetime', 'ipaddress', 'devices' 
    ];
   

    // store document details 
    public static function storeDocumentDetails ($post)
    {
        try {
            $documentDetailsArray = [
                'userid' => auth()->user()->id,
                'personalid' => auth()->user()->personalid,
                'photography' => !empty($post[ 'photographys']) ?$post[ 'photographys'] :$post[ 'back_photographys'],
                'citizenshipfront' => !empty( $post['citizenshipfronts']) ? $post['citizenshipfronts'] : $post['back_citizenshipfronts'],
                'citizenshipback' => !empty($post[ 'citizenshipbacks']) ?$post['citizenshipbacks'] :$post['back_citizenshipbacks'],
                'inclusiongroupcertificateadibashi' => !empty( $post['inclusiongroupcertificateadibashi']) ? $post['inclusiongroupcertificateadibashi'] : $post['back_inclusiongroupcertificateadibashi'],
                'inclusiongroupcertificatejanajati' => !empty($post['inclusiongroupcertificatejanajati']) ?$post['inclusiongroupcertificatejanajati'] :$post['back_inclusiongroupcertificatejanajati'],
                'inclusiongroupcertificatedalit' => !empty($post['inclusiongroupcertificatedalit']) ?$post['inclusiongroupcertificatedalit'] : $post['back_inclusiongroupcertificatedalit'] ,
                'inclusiongroupcertificatepixadiyeko' => !empty($post[ 'inclusiongroupcertificatepixadiyeko' ]) ?$post[ 'inclusiongroupcertificatepixadiyeko' ] :$post['back_inclusiongroupcertificatepixadiyeko'],
                'inclusiongroupcertificatemadesi' => !empty($post['inclusiongroupcertificatemadesi']) ?$post['inclusiongroupcertificatemadesi'] :$post['back_inclusiongroupcertificatemadesi'] ,
                'disabilitydocument' => !empty($post['inclusiongroupcertificateapanga']) ?$post['inclusiongroupcertificateapanga'] :$post['back_inclusiongroupcertificateapanga'] ,
                'signature' => !empty($post['signatures']) ?$post['signatures'] :$post['back_signatures'] ,
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s'),
            ];

            DB::beginTransaction();
            $result = false;
            if (empty($post['documentdetailid']))  {
                $result = DB::table('documents')->insert($documentDetailsArray);
            } else {
                $result = DB::table('documents')->where('id',$post['documentdetailid'])->update($documentDetailsArray);
            }
            DB::commit();
            return $result;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    
    // update cropped image
    public static function updateCroppedImage($post)
    {
        try {
            $userid = auth()->user()->id;
            $filetype = '';
            $cropped_name = '';
            $result = false;

            if (!empty($post['editid'])) {
                $filetype = $post['editid'];
                $cropped_name = 'cropped_'.$filetype;
                $folderPath = public_path('uploads/cropped/'.$filetype.'/');
            } else {
                throw new Exception('Please Choose an image to edit.', 1);
            }

            $document = Document::where(['status'=>'Y', 'userid'=>$userid])->first();
            if (!empty($post['undoEdit']) && $post['undoEdit'] == true) {
                $oldfile = File::delete( $folderPath.$document->$cropped_name);
                $document->$cropped_name = '';
                $result = $document->save();
            } else {
                File::delete( $folderPath.$document->$cropped_name);
                File::isDirectory($folderPath) or File::makeDirectory($folderPath, 0777, true, true);
    
                $image_parts = explode(";base64,", $post['image']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $extension = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $filename = $filetype . rand(111, 99999) . '.' . $extension;
                $image_path = $folderPath . $filename;
                $image =  Image::make($image_base64)->save($image_path);
                $document->$cropped_name = $filename;
                $result = $document->save();
            }
            return $result;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
