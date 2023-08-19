<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";

$con = cConnDB();

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">
    <meta property="og:title" content="관리자 로그인">
    <meta property="og:description" content="관리자 로그인 바로가기!">
    <meta property="og:type" content="website">

    <title>관리자 로그인</title>
    <link rel="stylesheet" type="text/css" href="/common/css/font/notosans.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Manage/css/login.css" media="all">
    <script type="text/javascript" src="/common/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/common/js/common.js"></script>
</head>
<body>
<div id="wrap">

    <header id="header">
        <h1 class="logo">
            <a href="#" title="쇼핑몰 바로가기">Roy</a>
        </h1>
    </header>

    <div id="container">
        <section id="contents">
            <div class="section">
                <form name="frm_user" id="frm_user">
                    <div class="tabCont" style="display: block">
                        <div style="display: block">
                            <div class="mFormBox">
                                <div class="column">
                                    <strong class="title">아이디</strong>
                                    <div class="gridPosition">
                                        <input type="text" class="fText suffix" placeholder="아이디를 입력해 주세요." title="아이디" name="adminId" id="adminId" tabindex="1" maxlength="20">
                                    </div>
                                </div>
                                <div class="column">
                                    <strong class="title">비밀번호</strong>
                                    <div class="gridPosition">
                                        <input type="password" class="fText typePassword" placeholder="비밀번호를 입력해 주세요." title="비밀번호" name="adminPassword" id="adminPassword" tabindex="2" maxlength="20">
                                        <button type="button" class="btnView ePasswordClick off"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mButton">
                        <button type="button" class="btnStrong large" tabindex="5" onclick="loginCheck();">로그인</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

    <footer id="footer">
        <p class="copyright">Copyright © Roy Corp. All Rights Reserved.</p>
    </footer>

</div>
</body>
</html>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Manage/index_js.php";
?>
