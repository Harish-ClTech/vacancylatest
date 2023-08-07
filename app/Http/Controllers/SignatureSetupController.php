<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\{Auth, DB, Mail, Validator};
use App\Models\{User, Common};
use App\Traits\ImageProcessTrait;
use Illuminate\Database\QueryException;
use Exception;

class SignatureSetupController extends Controller
{
    use ImageProcessTrait;

    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor 
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'विवरण सफलतापूर्वक थपियो ।';
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
        $this->response = false;
    }


    // view main page
    public function index ()
    {
        $data['signatureSetupInfo'] = DB::table('signature_setups')->where('status', '!=', 'R')->first();
        return view('admin.signaturesetup.index', $data);
    }

    // store signature setup
    public function store (Request $request)
    {
        try {
            $post = $request->all();
            if (!empty($post['signaturesetupid'])){
                $this->message = "विवरण सफलतापूर्वक अद्यावधिक गरियो ।";
            }else{
                $this->message = "विवरण सफलतापूर्वक सेभ भयो ।";
            }
            $rules = [
                'fullname' => 'required',
                'designation' => 'required',
                'signaturedate'=>'required|string',
            ];

            if(empty($request->signaturesetupid)){
                $rules['signature'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
            }
            
            $messages = [
                'fullname' => 'पुरा नाम प्रविष्ट गर्नुहोस् ।',
                'designation' => 'पद प्रविष्ट गर्नुहोस् ।',
                'signaturedate'=>'हस्ताक्षर मिति प्रविष्ट गर्नुहोस् ।',
                'signature'=>'हस्ताक्षर अपलोड गर्नुहोस् ।',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            DB::beginTransaction();
            $signatureArray = [
                'fullname' => $post['fullname'],
                'designation' => $post['designation'],
                'signaturedate' => $post['signaturedate'],
                'status' => !empty($post['status'])?$post['status']:'N',
                'created_at' => date('Y-m-d H:i:s')
            ];
            // equivalent document
            if ($request->hasFile('signature')) {
                $file = $request->file('signature');
                $extension = $file->getClientOriginalExtension();
                $name = auth()->user()->id.'signature' . rand(111, 999999999);
                $folder = 'uploads/signaturesetup/';
                $filePath = $name. '.' . $extension;
                $this->uploadImage($file, $folder, $name);
                $signatureArray['signature'] = $filePath;
            }
            
            if (!empty($post['signaturesetupid'])) {
                $status = DB::table('signature_setups')->where('id', $post['signaturesetupid'])->update($signatureArray);
            } else {
                $status = DB::table('signature_setups')->insert($signatureArray);
            }

            if (!$status) {
                throw new Exception('माफ गर्नुहोस् ! हस्ताक्षरकर्ताको विवरण सेभ हुन सकेन ।', 1);
            }

            DB::commit();
            $this->response = true;
          
        } catch (QueryException $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            DB::rollback();
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // delete signature setup
    public function deleteSignatureSetup (Request $request)
    {
        try {
            $post = $request->all();
            $this->message = 'हस्ताक्षरकर्ताको विवरण सफलतापूर्वक मेटियो ।';
            if(empty($post['signaturesetupid'])){

            }
            
            $status = DB::table('signature_setups')->where('id', $post['signaturesetupid'])->update(['statu'=>'R']);
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }

}

