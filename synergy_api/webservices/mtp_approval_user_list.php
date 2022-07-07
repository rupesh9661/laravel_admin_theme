<?php
require_once('../admin/functions/common_function.php');
require_once('../admin/include/conectdb.php');
require_once('../admin/include/config.inc.php');
require_once('../admin/include/my-functions.php');

$user_id = mysqli_real_escape_string($dbc, trim(stripslashes($_GET['userid'])));
$month = mysqli_real_escape_string($dbc, trim(stripslashes($_GET['month'])));
$_SESSION['resursivedata']=[];
recursivejuniors($user_id);
$juniors = join(',',$_SESSION['resursivedata']);
if($juniors==''){ $juniors=0; }
$_SESSION['resursivedata']='';
global $dbc;
 $query = "SELECT  DISTINCT person_id,CONCAT_WS(' ',first_name,middle_name,last_name) as  person_fullname,working_date,admin_approved FROM monthly_tour_program mtp INNER JOIN person ON person.id=mtp.person_id WHERE DATE_FORMAT(`working_date`,'%Y-%m')='$month'  AND admin_approved='0' AND person_id IN ($juniors,$user_id)";
$res = mysqli_query($dbc, $query);

while($rows = mysqli_fetch_assoc($res)){
    $rows['admin_approved_status']=$rows['admin_approved_status']==1?'Approved':$rows['admin_approved_status']==2?'Rejected':'Not Approved';
    $data[] = $rows;
}

    if(empty($data)){
        $final_data = Array ( 'result' => Array ('0' =>Array ( 'person_id' =>Null, 'person_fullname' =>Null)));
    }else{
        $final_data = array('result'=>$data);
    }

$result = json_encode($final_data);
echo $result;
