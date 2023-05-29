<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\{Auth, DB, Mail, Validator};
use App\Models\{User, Common};
use Illuminate\Database\QueryException;
use Exception;

class ManageUserController extends Controller
{
    protected $type;
    protected $message;
    protected $queryExceptionMessage;
    protected $response;


    // constructor 
    public function __construct ()
    {
        $this->type = 'success';
        $this->message = 'प्रयोगकर्ता सफलतापूर्वक थपियो ।';
        $this->queryExceptionMessage = 'केही गडबड भयो। कृपया फेरि प्रयास गर्नुहोस् ।';
        $this->response = false;
    }


    // view main page
    public function index ()
    {
        return view('admin.user.viewusersetup');
    }

    
    // show user form
    public function userForm (Request $request)
    {
        try {
            $post = $request->all();
            $designations = DB::table('designations')->where('status','Y')->get();
            $levels = DB::table('levels')->where('status','Y')->get();
            $roles = DB::table('roles')->where('status','Y')->get();
    
            if (!empty(@$post['usersetupid'])) {
                $validate = Validator::make($request->all(), ['usersetupid' => 'required|numeric'], ['usersetupid.required' => $this->queryExceptionMessage, 'usersetupid.numeric' => $this->queryExceptionMessage]);
                if ($validate->fails()) {
                    throw new Exception ($validate->errors()->first(), 1);
                }
                $previousData = User::previousAllData($post);
            }
            $data = [
                'previousData' => @$previousData,
                'saveurl' => route('storeUserDetails'),
                'designations' => $designations,
                'levels' => $levels,
                'roles' => $roles
            ];
        } catch (QueryException $e) {
            $data = [];
        } catch (Exception $e) {
            $data = [];
        }
        return view('admin.user.addusersetup', $data);
    }


    // get user details in datatable
    public function getUserDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $post['userid'] = auth()->user()->id;
            $data = User::getUserDetailsData($post);
            $i = 0;
            $array = array();
            $filtereddata = (@$data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : @$data["totalrecs"]);
            $totalrecs = @$data["totalrecs"];
    
            unset($data["totalfilteredrecs"]);
            unset($data["totalrecs"]);
            foreach ($data as $row) {
                $array[$i]["sn"] = $i + 1 ;
                if($row->userstatus=='Y'){
                    $status ='<label class="switch" title="Change Status">
                            <input   type="checkbox" class="status" checked data-id="' . $row->userid . '"value="' . $row->userstatus . '">
                            <span class="slider round"></span>
                            </label>';
                }else if($row->userstatus=='N'){
                    $status ='<label class="switch" title="Change Status">
                                <input type="checkbox" class="status" data-id="' . $row->userid . '" value="' . $row->userstatus . '">
                                <span class="slider round"></span>
                                </label>';
                }
                $array[$i]["userstatus"] = $status;
                $array[$i]["profilename"] = $row->profilename;
                $array[$i]["email"] = $row->email;
                $array[$i]["contactnumber"] = $row->contactnumber;
                $array[$i]["designationtitle"] = $row->designationtitle;
                $array[$i]["userlevel"] = $row->userlevel;
    
                $action = "";

                // edit
                $action .= '<a href="javascript:;" class="editUserSetup" title="प्रयोगकर्ता सम्पादन" data-usersetup="' . $row->userid . '"  ><i class="fa fa-edit fa-lg text-primary"></i></a>';
                
                // delete
                $action .= ' | <a href="javascript:;" class="deleteUserSetup" title="प्रयोगकर्ता मेटाउने"  data-usersetup="' . $row->userid . '" ><i class="fa fa-trash fa-lg text-danger"></i></a>';
                $array[$i]["action"] = $action;
                $i++;
            }
            if (!$filtereddata) {
                $filtereddata = 0;
            }
            if (!$totalrecs) {
                $totalrecs = 0;
            }

        } catch (QueryException $e) {
            $filtereddata = 0;
            $totalrecs = 0;
            $array = [];
        }
        echo json_encode(array("recordsFiltered" => @$filtereddata, "recordsTotal" => @$totalrecs, "data" => $array));
        exit;
    }


    // store user details
    public function storeUserDetails (Request $request)
    {
        try {
            $post = $request->all();

            if ($post['usersetupid'])
                $this->message = "प्रयोगकर्ता सफलतापूर्वक अद्यावधिक गरियो ।";

            $rules = [
                'firstname' => 'required',
                'lastname' => 'required',
                'designationid'=>'required|numeric',
                'roleid'=>'required|numeric',
                'contactnumber'=>'required|numeric',
                // 'level'=>'required'
            ];
            
            if (!empty($post['usersetupid'])) {
                $rules['email']  = 'required|email|unique:users,email,'.$post['usersetupid'];
                $rules['usersetupid']  = 'required|numeric';
            }else{
                $rules['email'] = 'required|email|unique:users,email';
                $rules['password'] = 'required|max:500';
                $rules['retypepassword'] = 'required|same:password';
            }
            $messages = [
                'usersetupid.required' => 'प्रयोगकर्ता सेटअप आवश्यक हुनुपर्छ ।',
                'usersetupid.numeric' => 'प्रयोगकर्ता सेटअप संख्यात्मक मात्र हुनुपर्छ ।',
                'firstname.required' => 'तपाईले प्रयोगकर्ताको पहिलो नाम भर्नु भएको छैन |',
                'lastname.required' => 'तपाईले प्रयोगकर्ताको अन्तिम नाम भर्नुभएको छैन |',
                'designationid.required' => 'तपाईले प्रयोगकर्ताको हाल कार्यरत पद भर्नुभएको छैन |',
                'designationid.numeric' => 'तपाईले प्रयोगकर्ताको हाल कार्यरत पद भर्नुभएको छैन |',
                'roleid.required' => 'तपाईले प्रयोगकर्ताको रोल भर्नुभएको छैन |',
                'roleid.numeric' => 'तपाईले प्रयोगकर्ताको रोल भर्नुभएको छैन |',
                'contactnumber.required' => 'तपाईले सम्पर्क नम्बर भर्नुभएको छैन |',
                'contactnumber.numeric' => 'तपाईले सम्पर्क नम्बर भर्नुभएको छैन |',
                'email.required' => 'तपाईले प्रयोगकर्ताको इमेल ठेगाना भर्नुभएको छैन |',
                // 'level.required' => 'तपाईले प्रयोगकर्ताले व्यवस्थापन गर्नुपर्ने विज्ञापन भर्नुभएको छैन |',
                'password.required' => 'तपाईले पासवर्ड भर्नुभएको छैन |',
                'retypepassword.required' => 'तपाईले पुन: पासवर्ड भर्नुभएको छैन |',
                'retypepassword.same' => 'तपाईले पासवर्ड र पुन: पासवर्ड एकआपसमा मिलेन |'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                throw new Exception($validator->errors()->first(), 1);
            }

            DB::beginTransaction();

            $userlevel = implode(", ", $post['level']);

            unset($post['password']);
            unset($post['retypepassword']);

            $filteredData = sanitizeData($post);

            $userid = DB::table('profiles')->orderBy('userid', 'DESC')->first()->userid;
            $newUserid = $userid + 1;
            $user = $post['usersetupid'] == null ? new User: User::where('id',$post['usersetupid'])->first();
            if (empty($post['usersetupid'])) {
                $user->id = $newUserid;
            }
            $user->email = strtolower($filteredData['email']);
            $user->status = 'Y';
            $user->userlevel = $userlevel;
            if (empty($post['usersetupid'])) {
                $user->password = bcrypt($request->password);
            }
            $result = $user->save();

            if(!$result) {
                throw new Exception('Sorry ! There was problem while storing user info.', 1);
            }

            $profileArray = [
                'userid' =>  $newUserid,
                'firstname' => $filteredData['firstname'],
                'middlename' => $filteredData['middlename'],
                'lastname' => $filteredData['lastname'],
                'designationid' => $filteredData['designationid'],
                'gender' => $filteredData['gender'],
                'contactnumber' => $filteredData['contactnumber'],
                'email' => strtolower($filteredData['email']),
                'createdatetime' => date('Y-m-d H:i:s')
            ];
            
            if (!empty($post['usersetupid'])) {
                unset($profileArray['userid']);
                $profileResponse = DB::table('profiles')->where('userid', $post['usersetupid'])->update($profileArray);
            } else {
                $profileResponse = DB::table('profiles')->insert($profileArray);
            }

            if (!$profileResponse) {
                throw new Exception('माफ गर्नुहोस्! प्रयोगकर्ता प्रोफाइल जानकारी सम्मिलित गर्दा समस्या छ ।', 1);
            }

            $userRoleArray = [
                'userid' => $newUserid,
                'roleid' => $post['roleid'],
                'createdatetime' => date('Y-m-d H:i:s')
            ];

            $roleResponse = 0;
            if (!empty($post['usersetupid'])) {
                unset($userRoleArray['userid']);
                $roleResponse = DB::table('userroles')->where('userid', $post['usersetupid'])->update($userRoleArray);
            } else {
                $roleResponse = DB::table('userroles')->insert($userRoleArray);
            }

            if (!$roleResponse) {
                throw new Exception('माफ गर्नुहोस्! प्रयोगकर्ता भूमिका जानकारी सम्मिलित गर्दा समस्या छ ।', 1);
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


    // delete user detail
    public function deleteUserDetailsData (Request $request)
    {
        try {
            $post = $request->all();
            $this->message = 'प्रयोगकर्ता खाता सफलतापूर्वक मेटियो ।';
            $this->response = User::deleteUserDetailsData($post);
        } catch (QueryException $e) {
            $this->type = 'error';
            $this->message = $this->queryExceptionMessage;
        } catch (Exception $e) {
            $this->type = 'error';
            $this->message = $e->getMessage();
        }
        Common::getJsonData($this->type, $this->message, $this->response);
    }


    // update user status
    public function updateStatus (Request $request)
    {
        try {
            $post = $request->all();
            $this->message = 'तपाईले छान्नुभएको प्रयोगकर्ता सकृय भएको छ!';
            if($post['status'] == 'N')
                $message = 'तपाईले छान्नुभएको प्रयोगकर्ता निश्कृय भएको छ!';

            $updateStatus = DB::table('users')->where(['id'=>$post['userid']])->update(['status' => $post['status']]);
            if(!$updateStatus)
                throw new Exception('प्रयोगकर्ताको स्थिति परिवर्तन भएको छैन । कृपया पुन:प्रयास गर्नुहोस् ।', 1);
            
            $this->response = true;
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

