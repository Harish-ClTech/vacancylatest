<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\Result;

class Applicant extends Model
{
    use HasFactory;


    // get applicant list
    public static function getApplicantListData ($post)
    {
        try {
            $cond = "1=1 ";
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
    
            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }

            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";

            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }

            if ($get['sSearch_1'])
                $cond .= " AND lower(registrationnumber) like '%" . $get['sSearch_1'] . "%'";

            if ($get['sSearch_2'])
                $cond .= " AND lower(applieddatead) like '%" . $get['sSearch_2'] . "%'";

            if ($get['sSearch_3'])
                $cond .= " AND lower(receipnumber) like '%" . $get['sSearch_3'] . "%'";

            if ($get['sSearch_4'])
                $cond .= " AND lower(fullname) like '%" . $get['sSearch_4'] . "%'";

            if ($get['sSearch_5'])
                $cond .= " AND lower(applyamount) like '%" . $get['sSearch_5'] . "%'";

            if ($get['sSearch_6'])
                $cond .= " AND lower(paymentsource) like '%" . $get['sSearch_6'] . "%'";

            if ($get['sSearch_7'])
                $cond .= " AND lower(contactnumber) like '%" . $get['sSearch_7'] . "%'";

            if ($get['sSearch_8'])
                    $cond .= " AND lower(designation) = '" . $get['sSearch_8'] . "'";	

            if ($get['sSearch_9'])
                    $cond .= " AND lower(labelname) like '%" . $get['sSearch_9'] . "%'";

            if ($get['sSearch_10'])
                $cond .= " AND lower(appliedstatus) like '%" . $get['sSearch_10'] . "%'";

            if ($get['sSearch_11'])
                    $cond .= " AND lower(gender) like '" . $get['sSearch_11'] . "%'";  

            $sql = "SELECT 
                        COUNT(*) OVER() AS totalrecs, 
                        registrationnumber,
                        userid,
                        jobapplyid,
                        registrationnumber,
                        receipnumber,
                        applieddatead,
                        applyamount,
                        appliedstatus,
                        labelname,
                        designation,
                        designationid,
                        paymentsource,
                        remarks,
                        fullname,
                        contactnumber,gender 
                    FROM v_applierreport 
                    where ".$cond." 
                    GROUP BY 
                        registrationnumber,
                        userid,
                        jobapplyid,
                        registrationnumber,
                        receipnumber,
                        applieddatead,
                        applyamount,
                        appliedstatus,
                        labelname,
                        designation,
                        paymentsource,
                        remarks,
                        fullname,
                        gender,
                        contactnumber,
                        designationid
                    ORDER BY jobapplyid desc ";

            
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
    

    // store user remarks
	public static function storeUsersDetails ($post)
    {
        try {
            $updateApplyJob = [
                'remarks' => $post['remarks'],
                'appliedstatus' => $post['status']
            ];

            $feedbackdata = '';
            if(!empty($post['autotext'])) {
                foreach($post['autotext'] as $rowd){
                    $feedbackdata .= $rowd.'#';
                }
            }

            $updateApplyJob['feedback'] = $feedbackdata;
            $updateApplyJob['iscropimage'] = (!empty($post['iscropimage']) && ($post['iscropimage'] !='null')) ? 'Y' : 'N';
            $updateApplyJob['lastmodifiedby'] = auth()->user()->id;
            $updateApplyJob['lastmodifieddatetime'] = date('y-m-d h:i:s'); 

            DB::beginTransaction();

            $isUpdated = DB::table('apply_jobs')->where(['userid'=>$post['userid'], 'id'=>$post['jobapplyid']])->update($updateApplyJob);
	        if (!$isUpdated) {
                return false;
            }

            $user = DB::table('users')->where('id', $post['userid'])->first(); 
            if(!$user) {
                return false;
            }

            $approw = DB::table('v_applierreport')->where('userid', $post['userid'])->first();
	        $designation = DB::table('designations')->where('id', $post['designationid'])->first();

            $post['applicantname'] = '';
            $post['designation']   = '';
            if (!empty($approw)) {
                $post['applicantname'] = $approw->fullname;
                $post['designation'] = $designation->title;
            }
            $message = self::messageHtml($post);

            $emaildata['message']       = $message;
            $emaildata['autotext']      = $post['autotext'];
            $emaildata['applicantname'] = "Dear Mr./Ms. ".$post['applicantname'];
	        $emaildata['remarks']       =  $post['remarks'];
            Mail::to($user->email)->send(new Result($emaildata));
            DB::commit();
            return true;

        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


    // get registered candidate details
    public static function getCandidatesDetails ($post) 
    {
        try {
            $cond = " =1 ";
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }

            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";
            
            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(fullname) like '%" . $get['sSearch_1'] . "%'";
    
            if ($get['sSearch_2'])
                $cond .= " AND lower(gender) like '%" . $get['sSearch_2'] . "%'";
    
            if ($get['sSearch_3'])
                $cond .= " AND lower(contactnumber) like '%" . $get['sSearch_3'] . "%'";
    
            if ($get['sSearch_4'])
                $cond .= " AND lower(email) like '%" . $get['sSearch_4'] . "%'";
    
            if ($get['sSearch_5'])
                $cond .= " AND lower(createdatetime) like '%" . $get['sSearch_5'] . "%'";
    
            $sql = "SELECT
                    COUNT(*) OVER () AS totalrecs,
                    pr.* 
                FROM
                    (
                    SELECT
                        p.id AS id,
                        p.userid AS userid,
                        CONCAT_WS( ' ', firstname, middlename, lastname ) AS fullname,
                        gender,
                        email,
                        contactnumber,
                        p.createdatetime AS createdatetime 
                    FROM
                        PROFILES AS p
                        JOIN userroles AS ur ON ur.userid = p.userid 
                    WHERE
                        p.STATUS = 'Y' 
                        AND ur.STATUS = 'Y' 
                        AND ur.roleid = 2 
                    ) AS pr 
                WHERE 1=1 $cond 
                ORDER BY
                    pr.id DESC";
                            
                        // echo $sql;exit;
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
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


    // change apply job title
    public static function changeApplyJobTitle ($post)
    {
        try {
            $result = false;
            if (!empty($post['applycategoryid'])) {
                $result = DB::table('applydetails')->where('id', $post['applydetailid'])->update(['jobpostid' => $post['applycategoryid']]);

            } else {
                throw new Exception("तपाईंले काम कोटि छनोट गर्न आवश्यक छ ।", 1);
            }

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
   

    // store modified job details
    public static function storeModifiedJobDetails ($post)
    {
        try {
            $result = DB::table('apply_jobs')->where('receipnumber', $post['idx'])->where('userid', $post['userid'])->first();

            if (!empty($result)) {
                return $response = [
                    'success' => false,
                    'message' => 'Transaction and Job Details already in table'
                ];
            }
            DB::beginTransaction();
            $insertArrayApplyJobs = [
                'userid' => $post['userid'],
                'receipnumber' => $post['idx'], //Khalti/ESEWA/CONNECTIPS Token Number
                'paymentsource' => $post['paymentsource'], // Khalti/ESEWA/CONNECTIPS
                'applieddatebs' => date('Y-m-d H:i:s'),
                'applieddatead' => date('Y-m-d H:i:s'),
                'applyamount' => $post['response']['totalsum'],
                'postedby' => auth()->user()->id,
                'posteddatetime' => date('Y-m-d H:i:s')
            ];

            $result = DB::table('apply_jobs')->insertGetId($insertArrayApplyJobs);
            $vacnyNums = [];
            if (!empty($post['vacancyid'])) {
                foreach ($post['vacancyid'] as $vacancyid) {
                    $vacancy = Vacancy::where('id', $vacancyid)->first();
                    $insertArrayApplyDetails[] = [
                        'applymasterid' => $result, // Apply Jobs Id 
                        'jobpostid' => $vacancyid, // Vacancy ID
                        'postedby' => auth()->user()->id,
                        'posteddatetime' => date('Y-m-d H:i:s')
                    ];
                    $vacnyNums[] = $vacancy->vacancynumber;
                }
            } else {
                foreach ($post['response']['appliedVacancyNo'] as $vaccancyno) {
                    $vacancy = Vacancy::where('vacancynumber', $vaccancyno)->first();
                    $insertArrayApplyDetails[] = [
                        'applymasterid' => $result, // Apply Jobs Id 
                        'jobpostid' => $vacancy->id, // Vacancy ID
                        'vacancnumber' => $vaccancyno,
                        'vacancyrate' => (!empty($post['isdoubleamount']) && ($post['isdoubleamount']=='Y')) ? $vacancy->vacancyrate*2 : $vacancy->vacancyrate,
                        'postedby' => auth()->user()->id,
                        'posteddatetime' => date('Y-m-d H:i:s')
                    ];
                    $vacnyNums[] = $vacancy->vacancynumber;
                }
            }

            $vacnynumbers = '';
            if (!empty($vacnyNums)) {
                $vacnynumbers = implode(", ", $vacnyNums);
            }
            $response1 = DB::table('applydetails')->insert($insertArrayApplyDetails);
            $response2 = DB::table('apply_jobs')->where(['id' => $result, 'userid' => $post['userid']])->update(['registrationnumber' => $result]);
            DB::commit();
            return $response = [
                'success' => true,
                'message' => 'Transaction and Job Details Stored Successfully. Please pay your pending Fee if any.'
            ];
        } catch (Exception $e) {
            DB::rollback();
            throw $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }


    // get message 
    public static function messageHtml ($post)
    {
        $message = '';
        if ($post['status'] == 'Verified'){
            $message .= "We are pleased to inform you that your application has been approved for the position of [".$post['designation']."] at Citizenship Investment Trust. After few days you will be able to print out admit card from dashboard.";
        } else if ($post['status'] == 'Incomplete'){
            $message .= 'Your application is incomplete. Please fulfill the necessary as follows:';
        } else if ($post['status'] == 'Rejected'){
            $message .= 'Your application has been rejected due to the following reason:';
        }
        return $message;
    }


    // get application status summary
    public static function getApplicantStatusSummary ()
    {
        try {
            // $sql  = "SELECT
            //             count( appliedstatus ) AS total,
            //             appliedstatus 
            //         FROM
            //             apply_jobs 
            //         GROUP BY
            //             appliedstatus 
            //         ORDER BY
            //             appliedstatus";
    
            $response = DB::table('apply_jobs')->selectRaw('count( appliedstatus ) AS total, appliedstatus')->groupBY('appliedstatus')->orderBy('appliedstatus', 'DESC')->get();

            return $response;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get userwise application status 
    public static function getUserWiseApplicantStatus ()
    {
        try {
            $sql  = "SELECT
                            pd.*,
                            jd.appliedstatus, 
                            jd.total
                        FROM
                            (
                            SELECT  
                                u.id,
                                u.userlevel,
                                u.email,
                                pf.contactnumber,
                                CONCAT_WS( ' ', pf.firstname, pf.middlename, pf.lastname ) AS username 
                            FROM
                                users AS u
                                JOIN profiles AS pf ON u.id = pf.userid
                                JOIN userroles AS ur ON u.id = ur.userid 
                            WHERE
                                pf.status = 'Y' 
                                AND u.status = 'Y' 
                                AND ur.roleid = 1 ORDER BY pf.firstname
                            ) AS pd
                            LEFT JOIN ( SELECT COUNT(jp.userid) AS total, jp.appliedstatus, jp.lastmodifiedby FROM apply_jobs AS jp WHERE STATUS = 'Y' GROUP BY jp.appliedstatus, jp.lastmodifiedby ) AS jd ON pd.id = jd.lastmodifiedby";
            
            $response = DB::select($sql);
            return $response;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get vacancy report
    public static function getVacancyReport ($post)
    {
        try {
            $cond = "1=1 ";
            $limit = 10;
            $offset = 0;
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";
    
            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }
    
            if ($get['sSearch_1'])
                $cond .= " AND lower(jad.registrationnumber) like '%" . $get['sSearch_1'] . "%'";
    
            if ($get['sSearch_2'])
                $cond .= " AND lower(pd.nepalifullname) like '%" . $get['sSearch_2'] . "%'";
    
            if ($get['sSearch_3'])
                $cond .= " AND lower(pd.englishfullname) like '%" . $get['sSearch_3'] . "%'";
    
            if ($get['sSearch_4'])
                $cond .= " AND lower(pd.gender) like '%" . $get['sSearch_4'] . "%'";
    
            if ($get['sSearch_9'])
                $cond .= " AND lower(pd.contactnumber) like '%" . $get['sSearch_9'] . "%'";
            
            if ($get['sSearch_10'] && $get['sSearch_10'] != 'all')
                $cond .= " AND lower(jad.designationtitle) like '%" . $get['sSearch_10'] . "%'";    
    
            if ($get['sSearch_11'] && $get['sSearch_11'] != 'all')
                $cond .= " AND lower(jad.leveltitle) like '%" . $get['sSearch_11'] . "%'";    
            
            if ($get['sSearch_12'] && $get['sSearch_12'] != 'all')
                $cond .= " AND lower(jad.jobcategory) like '%" . $get['sSearch_12'] . "%'";    
    
            if ($get['sSearch_13'])
                $cond .= " AND lower(jad.applieddatead) like '%" . $get['sSearch_13'] . "%'";     

            if ($get['sSearch_13'])
                $cond .= " AND lower(jad.receipnumber) like '%" . strtolower($get['sSearch_13']) . "%'"; 

            if ($get['sSearch_15'] && $get['sSearch_15'] != 'all')
                $cond .= " AND lower(jad.paymentsource) like '%" . strtolower($get['sSearch_15']) . "%'";   
            
            if ($get['sSearch_17'] && $get['sSearch_17'] != 'all') {
                $cond .= " AND lower(jad.appliedstatus) like '%" . strtolower($get['sSearch_17']) . "%'";
            }
    
            $sql  = "SELECT
                        COUNT(pd.userid) OVER() AS totalrecs,
                        pd.userid,
                        pd.email,
                        pd.contactnumber,
                        pd.nepalifullname,
                        pd.englishfullname,
                        pd.fatherfullname,
                        pd.motherfullname,
                        pd.grandfatherfullname,
                        pd.dateofbirthbs,
                        pd.dateofbirthad,
                        pd.gender,
                        pd.citizenshipnumber,
                        jad.registrationnumber,
                        jad.receipnumber,
                        jad.paymentsource,
                        jad.applyamount,
                        date(jad.applieddatead) as applieddatead,
                        jad.appliedstatus,
                        jad.leveltitle,
                        jad.designationtitle,
                        jad.remarks,
                        GROUP_CONCAT( DISTINCT jad.jobcategory SEPARATOR ', ') as jobcategory FROM
                    (SELECT
                        pfd.userid AS userid,
                        pfd.email AS email,
                        pfd.contactnumber AS contactnumber,
                        concat_ws( ' ', pd.nfirstname, pd.nmiddlename, pd.nlastname ) AS nepalifullname,
                        concat_ws( ' ', pd.efirstname, pd.emiddlename, pd.elastname ) AS englishfullname,
                        concat_ws( ' ', pd.fatherfirstname, pd.fathermiddlename, pd.fatherlastname ) AS fatherfullname,
                        concat_ws( ' ', pd.motherfirstname, pd.mothermiddlename, pd.motherlastname ) AS motherfullname,
                        concat_ws( ' ', pd.grandfatherfirstname, pd.grandfathermiddlename, pd.grandfatherlastname ) AS grandfatherfullname,
                        pd.dateofbirthad AS dateofbirthad,
                        pd.dateofbirthbs AS dateofbirthbs,
                        pd.gender AS gender,
                        pd.citizenshipnumber AS citizenshipnumber
                    FROM
                        (
                            personals pd
                            JOIN profiles pfd ON ((
                                    pfd.userid = pd.userid
                                )))
                    WHERE
                        ( pfd.STATUS = 'Y' )) AS pd
                    INNER JOIN(
                    SELECT
                        aj.userid AS userid,
                        aj.registrationnumber AS registrationnumber,
                        aj.appliedstatus AS appliedstatus,
                        aj.receipnumber,
                        aj.paymentsource,
                        aj.applyamount,
                        aj.applieddatead,
                        vs.LEVEL AS leveltitle,
                        vs.vacancynumber AS vacancynumber,
                        dg.title AS designationtitle,
                        jbc.NAME AS jobcategory,
                        aj.remarks AS remarks
                    FROM
                        ((((
                                        apply_jobs aj
                                        JOIN applydetails ad ON ((
                                                aj.id = ad.applymasterid
                                            )))
                                    JOIN vacancies vs ON ((
                                            vs.id = ad.jobpostid
                                        )))
                                JOIN designations dg ON ((
                                        dg.id = vs.designation
                                    )))
                            JOIN jobcategories jbc ON ((
                                    jbc.id = vs.jobcategory
                                )))
                    WHERE
                        (
                        aj.STATUS = 'Y')) AS jad
                        ON jad.userid = pd.userid where $cond
                        GROUP BY
                            pd.userid,
                            pd.email,
                            pd.contactnumber,
                            pd.nepalifullname,
                            pd.englishfullname,
                            pd.dateofbirthbs,
                            pd.dateofbirthad,
                            pd.gender,
                            pd.citizenshipnumber,
                            jad.registrationnumber,
                            jad.appliedstatus,
                            jad.leveltitle,
                            jad.designationtitle,
                            jad.remarks,
                            jad.receipnumber,
                            jad.paymentsource,
                            jad.applyamount,
                            jad.applieddatead 
                        ORDER BY 
                            pd.userid ASC";
    
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


    // get insufficient payment details in datatable
    public static function getInsufficientPaymentReport ($post)
    {
        try {
            $cond = "1=1 ";
            $get = $post;
            foreach ($get as $key => $value) {
                $get[$key] = trim(strtolower(htmlspecialchars($get[$key], ENT_QUOTES)));
            }
            $limit = 10;
            $offset = 0;
            if (!empty($get["iDisplayLength"])) {
                $limit = $get['iDisplayLength'];
                $offset = $get["iDisplayStart"];
            }
            $sorting = $get['sSortDir_0'] ? $get['sSortDir_0'] : 'desc';
            $orderby = "fullname " . $sorting . "";
        
            if ($get['iSortCol_0']) {
                if ($get['iSortCol_0'] == 1) {
                    $orderby = " fullname " . $sorting . "";
                }
            }
        
            if ($get['sSearch_1'])
                $cond .= " AND lower(registrationnumber) like '%" . $get['sSearch_1'] . "%'";
        
            if ($get['sSearch_2'])
                $cond .= " AND lower(applieddatebs) like '%" . $get['sSearch_2'] . "%'";
        
            if ($get['sSearch_3'])
                $cond .= " AND lower(fullname) like '%" . $get['sSearch_3'] . "%'";
        
            if ($get['sSearch_4'])
                $cond .= " AND lower(gender) = ‍‍'".$get['sSearch_4'] . "'";
           
            if ($get['sSearch_5'])
                $cond .= " AND lower(email) like '%" . $get['sSearch_5'] . "%'";
        
            if ($get['sSearch_6'])
                $cond .= " AND lower(contactnumber) like '%" . $get['sSearch_6'] . "%'";
        
            $sql = "SELECT
                        COUNT(*) OVER() AS totalrecs,
                        registrationnumber,
                        applieddatebs,
                        fullname,
                        gender,
                        email,
                        contactnumber,
                        level,
                        designation,
                        jobcategory,
                        vacancyrate,
                        paidamount
                    FROM
                        v_insufficiantpayment
                    WHERE
                        vacancyrate > paidamount
                        AND
                        ".$cond."
                    ORDER BY
                        fullname";
            
            if ($limit > -1) {
                $sql = $sql . ' limit ' . $limit . ' offset ' . $offset . '';
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


    // store remarks of cancelled application
    public static function storeRemarksToCancelApplication ($post)
    {
        try {
            $updateApplyJobDetail = [
                'vacancycanceled' => 'Y',
                'vacancycanceledremarks' => $post['vacancycanceledremarks']
            ];

            $updateApplyJobDetail['lastmodifiedby'] = auth()->user()->id;
            $updateApplyJobDetail['lastmodifieddatetime'] = date('y-m-d h:i:s'); 

            DB::beginTransaction();

            $jobDetailUpdated = DB::table('applydetails')->where(['id'=>$post['jobapplydetailid']])->update($updateApplyJobDetail);
	        if (!$jobDetailUpdated) {
                return false;
            }

            $user = DB::table('users')->where('id', $post['userid'])->first(); 
            if (empty($user)) {
                return false;
            }
            $post['applicantname'] = '';
            $post['designation']   = '';

            $approw = DB::table('profiles')->where('userid', $post['userid'])->first();
            if (!empty($approw)) {
                $post['applicantname'] = $approw->firstname.' '. $approw->middlename.' '. $approw->lastname;
            }

            $post['status'] = 'Rejected';
            $message = self::messageHtml($post);

            $emaildata['message']       = $message;
            $emaildata['applicantname'] = "Dear Mr./Ms. ".$post['applicantname'];
	        $emaildata['remarks']       =  $post['vacancycanceledremarks'];
            Mail::to($user->email)->send(new Result($emaildata));

            DB::commit();
            return true;

        } catch (Exception $e){
            DB::rollback();
            throw $e;
        }
    }


    // get specific contact detail
    public static function getContactDetail ($userid) 
    {
        try {
            $contactSql = "SELECT
                            *
                            FROM
                            (
                            SELECT
                                AD.*,
                                P.provincename,
                                D.districtname,
                                M.vdcormunicipalitiename
                            FROM
                                (
                                SELECT
                                    userid,
                                    provinceid,
                                    districtid,
                                    municipalityid,
                                    ward,
                                    tole,
                                    marga,
                                    housenumber,
                                    phonenumber
                                FROM
                                    contactdetails
                                WHERE
                                    userid = " . $userid . "
                                    AND STATUS = 'Y'
                                ) AS AD
                                JOIN provinces AS P ON P.id = AD.provinceid
                                JOIN districts AS D ON D.id = AD.districtid
                                JOIN vdcormunicipalities AS M ON M.id = AD.municipalityid
                            ) AS PERM
                            JOIN (
                            SELECT
                                AD.*,
                                P.provincename AS tempprovincename,
                                D.districtname AS tempdistrictname,
                                M.vdcormunicipalitiename AS tempvdcormunicipalitiename
                            FROM
                                (
                                SELECT
                                    userid AS id,
                                    tempoprovinceid,
                                    tempodistrictid,
                                    tempomunicipalityid,
                                    tempoward,
                                    tempotole,
                                    tempomarga,
                                    tempohousenumber,
                                    tempophonenumber,
                                    maillingaddress
                                FROM
                                    contactdetails
                                WHERE
                                    userid = " . $userid . "
                                    AND STATUS = 'Y'
                                ) AS AD
                                JOIN provinces AS P ON P.id = AD.tempoprovinceid
                                JOIN districts AS D ON D.id = AD.tempodistrictid
                            JOIN vdcormunicipalities AS M ON M.id = AD.tempomunicipalityid
                            ) AS TEMP ON TEMP.id = PERM.userid ";

                $result = DB::select($contactSql);
                return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specific profile detail
    public static function getProfileDetail ($userid)
    {
        try {
            $result = DB::table('personals as p')
                        ->join('districts as d', 'p.citizenshipissuedistrictid', '=', 'd.id')
                        ->where(['userid' => $userid])
                        ->first();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specific education detail
    public static function getEducationDetail ($userid) 
    {
        try {
            $result = DB::table('educations as e')
                        ->select('universityboardname', 'educationfaculty', 'educationinstitution', 'devisiongradepercentage', 'mejorsubject', 'name', 'academicdocument' ,'equivalentdocument')
                        ->join('academics as a', 'a.id', '=', 'e.educationlevel')
                        ->where(['userid' => $userid, 'e.status'=>'Y'])
                        ->get()->all();
            
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specific training detail
    public static function getTrainingDetail ($userid)
    {
        try {
            $result = DB::table('trainings')
                        ->select('trainingname', 'trainingproviderinstitutionalname', 'gradedivisionpercent', 'fromdatebs', 'fromdatead', 'enddatebs', 'enddatead', 'document')
                        ->where(['userid' => $userid, 'status'=>'Y'])
                        ->get()->all();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specific experience detail
    public static function getExperienceDetail ($userid)
    {
        try {
            $result = DB::table('experiences')
                        ->select('officename', 'officeaddress', 'jobtype', 'designation', 'service', 'group' , 'subgroup', 'ranklabel', 'fromdatebs', 'enddatebs', 'workingstatus', 'workingstatuslabel', 'remarks', 'document')
                        ->where(['userid' => $userid, 'status'=>'Y'])
                        ->get()->all();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specifit photo detail
    public static function getPhotoDetail ($userid) 
    {
        try {
            $result = DB::table('documents')
                        ->select('photography')
                        ->where(['userid' => $userid, 'status' => 'Y'])
                        ->get()->first();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get specific 
    public static function getDocumentDetail ($userid) 
    {
        try {
            $result = DB::table('documents')
                        ->where(['userid' => $userid, 'status' => 'Y'])
                        ->get()->first();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get vacancies
    public static function getVacancies ($post) 
    {
        try {
            // $vacancieSql = "SELECT
            //                     v.id,
            //                     jc.name,
            //                     v.vacancynumber 
            //                 FROM
            //                     vacancies AS v
            //                     JOIN jobcategories AS jc ON jc.id = v.jobcategory 
            //                 WHERE
            //                     v.STATUS = 'Y' 
            //                     AND v.designation =".$post['designationid']."";

            // $result = DB::select($vacancieSql);

            $result = DB::table('vacancies as v')
                        ->select('v.id', 'jc.name', 'v.vacancynumber')
                        ->join('jobcategories as jc', 'jc.id', '=', 'v.jobcategory')
                        ->where(['v.status' => 'Y', 'v.designation' => $post['designationid']])
                        ->get();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get extra detail 
    public static function getExtraDetail ($userid) 
    {
        try {
            $result = DB::table('extradetails')->where(['userid' => $userid])->first();
            return $result;

        } catch (Exception $e) {
            throw $e;
        } 
    }


    // modify application 
    public static function getModifyApplication ($post) 
    {
        try {
            $sql  = "SELECT vdd.*, JB.jobpostid FROM 
                        (SELECT
                            V.id,
                            V.vacancynumber,
                            V.level,
                            V.designation,
                            V.servicesgroup,
                            V.jobcategory,
                            V.vacancyrate,
                            V.numberofvacancy,
                            D.title,
                            S.servicegroupname,
                            J.name,
                            L.labelname,
                            D.id AS designationid,
                            S.id AS servicegroupid
                        FROM
                            vacancies AS V
                            JOIN designations AS D ON D.id = V.designation
                            JOIN servicegroups AS S ON S.id = V.servicesgroup
                            JOIN jobcategories AS J ON J.id = V.jobcategory 
                            JOIN levels AS L ON L.id = V.level 
                        WHERE
                            designation =  " . $post['designationid'] . "
                            AND servicesgroup = " . $post['servicesgroupid'] . "
                            AND V.jobstatus = 'Active' AND V.status ='Y') as vdd 
                        LEFT JOIN(
                            SELECT jobpostid FROM apply_jobs as jb 
                            INNER JOIN applydetails AS ad ON ad.applymasterid = jb.id
                            WHERE jb.status = 'Y' and ad.status = 'Y' AND userid = " . $post['userid'] . " AND jobpostid IN(SELECT id FROM vacancies WHERE designation =  " . $post['designationid'] . " AND servicesgroup = " . $post['servicesgroupid'] . " AND jobstatus = 'Active')) AS JB 
                        ON JB.jobpostid = vdd.id";

            $result = DB::select($sql);
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }


    // get min/max
    public static function getMinMax ($post) 
    {
        try {
            // $sql = "SELECT
            //             max( V.vacancyrate ) AS maxval,
            //             min( V.vacancyrate ) AS minval 
            //         FROM
            //             vacancies AS V
            //             JOIN designations AS D ON D.id = V.designation
            //             JOIN servicegroups AS S ON S.id = V.servicesgroup
            //             JOIN jobcategories AS J ON J.id = V.jobcategory
            //             JOIN levels AS L ON L.id = V.LEVEL 
            //         WHERE
            //             V.designation = '" . $post['designationid'] . "' 
            //             AND V.servicesgroup = '" . $post['servicesgroupid'] . "' 
            //             AND V.jobstatus = 'Active'";
                
            // $result = DB::select($sql);

            $result = DB::table('vacancies as v')
                        ->selectRaw('max(v.vacancyrate) as maxval, min( V.vacancyrate ) as minval')
                        ->join('designations as d', 'd.id', '=', 'v.designation')
                        ->join('servicegroups as s', 's.id', '=', 'v.servicesgroup')
                        ->join('jobcategories as j', 'j.id', '=', 'v.jobcategory')
                        ->join('levels as l', 'l.id', '=', 'v.level')
                        ->where([
                            'v.designation' => $post['designationid'], 
                            'v.servicesgroup' => $post['servicesgroupid'], 
                            'v.jobstatus' => 'Active'
                        ])->first();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
