<?php
if(!isset($_SESSION) || $_SESSION['memberGrade'] != "99"){
    echo ("<script>alert('관리자만 접근할 수 있습니다.');location.href='/Manage';</script>");
}
?>
