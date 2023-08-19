<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');
ini_set( 'session.cookie_httponly', 1 );
session_start();

ini_set("session.use_trans_sid", 0);
ini_set("url_rewriter.tags","");
ini_set('opcache.enable', '0');


/////////////////////////////////
//공통변수처리부분
/////////////////////////////////
extract($_GET);
extract($_POST);
extract($_SERVER);

if (function_exists("date_default_timezone_set")){
    date_default_timezone_set("Asia/Seoul");
}

//////////////////////////////////////////////////////////
/// 경로 관련
//////////////////////////////////////////////////////////
$str_url = explode("/",$_SERVER["REQUEST_URI"]);

$php_self = explode("/",$_SERVER["PHP_SELF"]);
$url_cnt = count($php_self) - 1;
$this_page = $php_self[$url_cnt];
$this_dir = $php_self[$url_cnt - 1];

$depth1_name = $php_self[1];

/////////////////////////////////
//DB
/////////////////////////////////
$mysql_host = "localhost" ;
$mysql_user = "swastica238";
$mysql_pwd  = "excellent12";
$mysql_db   = "swastica238" ;

$secret_key = "IWILLBERICH";
$secret_iv = "roy";

$remoteAddr = $_SERVER['REMOTE_ADDR'];

$stockAppKey = "PSxP319oLJKVP4Qv2v8I7FAcUJElZoAvLCj8";
$stockAppSecret = "Lrg43mWQ1sIoI9ctOfa62omtylhRZRdc6SumNClNu4qvmKvru0dbIxs+THqTSVd85C7W+xpuTcgODusdwKBNyF75eezzbGz9RJVd5mVUlatntDnQctSIFBZQqqSwBfzHi1SLdyzHbc+boKgeL8MnYVm3hBDdxkHbxQPJcffVoVNnwUDyYoE=";

/////////////////////////////////
//메세지
/////////////////////////////////
define("ERRORMESSGE", array('오류가 발생하였습니다.', '데이터가 올바르지 않습니다.'));
define("RESULT", array('success', 'error', 'duplicate'));
define("SUCCESSMESSGE", array('등록하였습니다.', '수정하였습니다.','삭제하였습니다','답변하였습니다.'));


////////////////////////////////////////////////////
// token
////////////////////////////////////////////////////

//token head
$HEADER = '{"alg":"HS256","typ":"JWT"}';

////////////////////////////////////////////////////
// API_KEY
////////////////////////////////////////////////////

$exchangeKey = "qkCyJicPU6wCZMnS0edgfQJJPdDesyEt";

////////////////////////////////////////////////////
// 기타 설정값
////////////////////////////////////////////////////
///
$yearRange = "2023,2024,2025";
$monthRange = "01,02,03,04,05,06,07,08,09,10,11,12";

////////////////////////////////////////////////////
// upload 폴더 관련
////////////////////////////////////////////////////

$fileTypeArray = array(
    'image'=>array('jpg','jpge','jpeg','png','gif'),
    'text'=>array('txt'),
    'application'=>array('doc', 'docx','xls','xlsx','ppt','pptx','pdf'),
    'video'=>array('mp4','webm'),

);

$editorPath = "/Upload/editor";


////////////////////////////////////////////////////
// mobile 여부 체크
////////////////////////////////////////////////////
$mAgent = array("iPhone","iPod","Android","Blackberry","Opera Mini", "Windows ce", "Nokia", "sony" );
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        break;
    }
}


?>