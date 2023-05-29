<?php

namespace App\Models;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'status',
        'userlevel'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, 'id','profileid');
    }

    public function role()
    {
        return $this->hasOne(Role::class, 'id','roleid');
    }

    // get previous data
    public static function previousAllData ($post)
    {
        try {
            $cond = [
                'pf.STATUS' => 'Y', 
                'u.STATUS' => 'Y', 
                'ur.STATUS' => 'Y', 
                'pf.userid' => $post['usersetupid']
            ];

            $sql = DB::table('users AS u')
                    ->join('profiles AS pf', 'pf.userid', '=', 'u.id') 
                    ->join('userroles AS ur', 'ur.userid', '=', 'u.id')
                    ->leftJoin('designations AS d', 'd.id', '=', 'pf.designationid')
                    ->selectRaw("u.id AS userid,
                        u.STATUS AS userstatus,
                        u.userlevel,
                        pf.email,
                        pf.contactnumber,
                        pf.firstname, 
                        pf.middlename, 
                        pf.lastname,
                        pf.gender,
                        d.id AS designationid,
                        d.title AS designationtitle"
                    )
                    ->where($cond);

            $result = $sql->get()->all();

            if ($result) {
                return $result;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    // get user data
    public static function getUserDetailsData ($post)
    {
        try {
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
    
            $cond = ' 1=1 ';
            if ($get['sSearch_1']) {
                $cond .= " AND lower(up.profilename) like '%" . $get['sSearch_1'] . "%' ";
            }

            if ($get['sSearch_2']) {
                $cond .= " AND lower(d.title) like '%" . $get['sSearch_2'] . "%'";
            }

            $sql = "SELECT
                        COUNT(*) OVER() AS totalrecs,
                        up.*,
                        d.title AS designationtitle 
                    FROM
                        (
                        SELECT
                            u.id AS userid,
                            u.status AS userstatus,
                            u.userlevel,
                            pf.email,
                            pf.contactnumber,
                            CONCAT_WS( ' ', pf.firstname, pf.middlename, pf.lastname ) AS profilename,
                            pf.gender,
                            pf.designationid 
                        FROM
                            users AS u
                            JOIN PROFILES AS pf ON pf.userid = u.id
                            JOIN userroles AS ur ON ur.userid = u.id 
                        WHERE
                            (u.status = 'Y' || u.status = 'N') 
                            AND pf.status = 'Y' 
                            AND ur.status = 'Y' 
                            AND ur.roleid = 1
                            AND u.id > 1 
                        ) AS up
                    LEFT JOIN ( SELECT id, title FROM designations WHERE status = 'Y' ) AS d ON d.id = up.designationid
                    WHERE $cond
                    ORDER BY up.userid DESC";
    
            if ($limit > -1) {
                $sql = $sql.' LIMIT '.$limit.' OFFSET '.$offset;
            }

            $result = DB::select($sql);

            $ndata = $result;
            $ndata['totalrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            $ndata['totalfilteredrecs'] = @$result[0]->totalrecs ? $result[0]->totalrecs : 0;
            return $ndata;
            
        } catch (Exception $e) {
            throw $e;
        }
    }


    // delete user detail
    public static function deleteUserDetailsData ($post)
    {
        try {
            DB::beginTransaction();

            $deleteUsers = DB::table('users')->where('id', $post['usersetupid'])->update(['status' => 'R']);
            $deleteRoles = DB::table('userroles')->where('userid', $post['usersetupid'])->update(['status' => 'R']);
            $deleteProfiles = DB::table('profiles')->where('userid', $post['usersetupid'])->update(['status' => 'R']);
            if(!$deleteUsers && !$deleteRoles && !$deleteProfiles)
                throw new Exception('Sorry ! There was problem while deleting user.', 1);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // update user status
    public static function updateUserStatus($post)
    {
        try {
            DB::beginTransaction();

            $deleteUsers = DB::table('users')->where('id', $post['usersetupid'])->update(['status' => 'N']);
            $deleteNoles = DB::table('userroles')->where('userid', $post['usersetupid'])->update(['status' => 'N']);
            $deleteProfiles = DB::table('profiles')->where('userid', $post['usersetupid'])->update(['status' => 'N']);
            if(!$deleteUsers && !$deleteRoles && !$deleteProfiles)
                throw new Exception('Sorry ! There was problem while updating user status.', 1);

            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
