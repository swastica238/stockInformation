<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if(!$trace){
    echo json_encode(array('result'=>'error', 'message'=>'데이터가 올바르지 않습니다.'));
    exit;
}

if($trace == "adminLogin") {


    try{
        $con->beginTransaction();

        $q = "SELECT * FROM member WHERE member_id = :member_id AND member_pwd = :member_pwd AND status = 'y' AND member_grade = '99'";
        $rs = $con->prepare($q);
        $rs->bindValue(':member_id', $adminId, PDO::PARAM_STR);
        $rs->bindValue(':member_pwd', encrypt_decrypt("encrypt", $adminPassword), PDO::PARAM_STR);
        $rs->execute();
        $row = $rs->fetch();
        $count = $rs->rowCount();

        if (!$count) {
            echo json_encode(array('result' => RESULT[1], 'message' => ERRORMESSGE[1]));
            exit;
        }

        $q1 = "UPDATE member SET login_cnt = login_cnt + 1, last_login_date = NOW() 
                WHERE member_id = :member_id ";
        $rs1 = $con->prepare($q1);
        $rs1->bindValue(':member_id', $adminId, PDO::PARAM_STR);
        $rs1->execute();

        $q2 = "INSERT INTO member_login_log (memberIdx, loginDate) VALUES (:memberIdx, NOW())";
        $rs2 = $con->prepare($q2);
        $rs2->bindValue(':memberIdx', $row['idx'], PDO::PARAM_STR);
        $rs2->execute();

        $con->commit();

        $_SESSION['memberIdx'] = $row['idx'];
        $_SESSION['memberId'] = $row['member_id'];
        $_SESSION['memberName'] = $row['member_name'];
        $_SESSION['memberEmail'] = $row['member_email'];
        $_SESSION['memberGrade'] = $row['member_grade'];

        $locationUrl = "/Manage/main.php";

        echo json_encode(array('result' => RESULT[0], 'message' => '로그인되었습니다', 'locationUrl' => $locationUrl));
        exit;

    } catch (PDOException $e){
        $con->rollBack();
        echo json_encode(array('result' => RESULT[1], 'message' => ERRORMESSGE[0], 'errorCode' => $e->getMessage()));
        exit;
    }
} else if($trace == "logout"){
    session_destroy();
    session_commit();

    $locationUrl = "/Manage/";

    echo json_encode(array('result'=>RESULT[0], 'message'=>'로그아웃 되었습니다.', 'locationUrl'=>$locationUrl));
    exit;
}

?>