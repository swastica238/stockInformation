<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='ko' lang='ko'><head>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta name='copyright' content='Copyright(c) .All Rights Reserved.'>
    <link rel="stylesheet" type="text/css" href="/Manage/css/layout.css" media="all" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/Manage/css/suio.css" media="all" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/common/css/jquery-ui.css" media="all" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/common/css/datetimepicker.css" media="all" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/Manage/css/admin.css" media="all" charset="utf-8">
    <script type='text/javascript' src='/common/js/jquery-3.3.1.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='/common/js/jquery-ui.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='/common/js/jquery.datetimepicker.js' charset='utf-8'></script>
    <script type='text/javascript' src='/common/js/common.js' charset='utf-8'></script>
    <script type='text/javascript' src='/Manage/js/admin.js' charset='utf-8'></script>
    <script src='/common/js/smeditor/js/HuskyEZCreator.js' type='text/javascript'></script>
    <title>Admin</title>
</head>
<body>
<div id='wrap'>

    <div id="header">
        <div class="mUtilDown member line" style="float: right;margin-right: 52px">
            <button type="button" class="btnMember eClick" title="로그인 정보">로그인 정보</button>
            <div class="utilDown">
                <div class="utilTitle">
                    <h2><?php echo $_SESSION['memberId']?></h2>
                    <p class="desc"><?php echo $_SESSION['memberName']?></p>
                </div>

                <div class="button">
                    <a href="javascript:logout()">
                        <button type="button" class="btnLogout">로그아웃</button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div id="container">
