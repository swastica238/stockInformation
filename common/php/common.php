<?php

//DB 컨넥션
function cConnDB(){
    global $mysql_host, $mysql_user, $mysql_pwd, $mysql_db;
    try{
        $dsn = 'mysql:dbname='.$mysql_db.';host='.$mysql_host.';port=3306;charset=utf8mb4';
        $dbh = new PDO($dsn, $mysql_user, $mysql_pwd);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $dbh;
    } catch (PDOException $e){
        print "Error!: ".$e->getMessage()."<br>";
    }
}

//알럿 후 페이지 이동
function cAlerLocation($psText,$locationInfo) {
    $psText = str_replace("\r\n", " ", $psText);
    $psText = str_replace("\n", " ", $psText);
    $psText = str_replace("\r", " ", $psText);
    echo ("
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<script type='text/javascript'>
		alert('".$psText."');
		window.location.href = '".$locationInfo."';
	</script>
	");
}

//페이지 이동
function cLocation($locationInfo) {
    echo("
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <script type='text/javascript'>	
		window.location.href = '".$locationInfo."';
	</script>
	");
}

//이전페이지로 이동
function cAlertBack($psText) {
    $psText = str_replace("\r\n", " ", $psText);
    $psText = str_replace("\n", " ", $psText);
    $psText = str_replace("\r", " ", $psText);
    echo("
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<script type='text/javascript'>
		alert('".$psText."');
		history.back(-1);
	</script>
	");
}

//알럿
function cAlert($psText) {
    $psText = str_replace("\r\n", " ", $psText);
    $psText = str_replace("\n", " ", $psText);
    $psText = str_replace("\r", " ", $psText);
    echo("
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<script type='text/javascript'>
		alert('".$psText."');		
	</script>
	");
}

//암호화 복호화(encrypt:암호화, decrypt:복호화)
function encrypt_decrypt($action, $string) {
    global $secret_key, $secret_iv;

    $output = false;
    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function login_encrypt_decrypt($action, $string, $secret_key, $secret_iv) {

    $output = false;
    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);

    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function ftnMakeRadioValue($Name, $Value, $Text, $CheckedValue, $DefaultValue, $ClickEvent, $EnterNumber, $Style){
    $ReturnValue = "";
    $splitValue = explode(",", $Value);
    $splitText = explode(",",$Text);

    for ($RadioLoop = 0; $RadioLoop  < count($splitValue); $RadioLoop++){

        $ReturnValue .= "<label for='".$Name."_".$RadioLoop."'";
        if($Style != ""){
            $ReturnValue .= " class='".$Style."' ";
        }

        $ReturnValue .= ">";


        $ReturnValue .= "<input type='radio' name='".$Name."' id='".$Name."_".$RadioLoop."' value='".$splitValue[$RadioLoop]."' class='fChk' " ;

        if ($ClickEvent != ""){
            $ReturnValue .= " onclick='".$ClickEvent."' ";
        }

        if($CheckedValue >= 0){
            if($CheckedValue == $splitValue[$RadioLoop]){
                $ReturnValue .= " checked ";
            } else {
                $ReturnValue .= "";
            }
        } else {
            if($DefaultValue && $DefaultValue == $splitValue[$RadioLoop]){
                $ReturnValue = $ReturnValue . " checked ";
            } else {
                $ReturnValue .= "";
            }
        }

        $ReturnValue .= " title='".$Name."' />";

        $ReturnValue .= " ".$splitText[$RadioLoop]."</label> ";

        if ($EnterNumber != ""){
            if (($RadioLoop + 1) % $EnterNumber == 0){
                $ReturnValue .= "<br>";
            }
        }
    }

    $ftnMakeRadioValue = $ReturnValue;
    return $ftnMakeRadioValue;
}

function ftnMakeRadioValue2($Name, $radioArray, $CheckedValue, $DefaultValue, $ClickEvent, $EnterNumber, $Style){
    $ReturnValue = "";
    $RadioLoop = 0;
    foreach ($radioArray as $key => $value){
        $ReturnValue .= "<label for='".$Name."_".$RadioLoop."'>".$value."</label>";
        $ReturnValue .= "<input type='radio' name='".$Name."' id='".$Name."_".$RadioLoop."' value='".$key."' " ;
        if ($ClickEvent != ""){
            $ReturnValue .= " onclick='".$ClickEvent."' ";
        }
        if($Style != ""){
            $ReturnValue .= " class='".$Style."' ";
        }
        if($CheckedValue ){
            if($CheckedValue == $key){
                $ReturnValue .= " checked ";
            } else {
                $ReturnValue .= "";
            }
        } else {
            if($DefaultValue && $DefaultValue == $key){
                $ReturnValue = $ReturnValue . " checked ";
            } else {
                $ReturnValue .= "";
            }
        }
        $ReturnValue .= " title='".$Name."' style='vertical-align:middle' />";

        if ($EnterNumber != ""){
            if (($RadioLoop + 1) % $EnterNumber == 0){
                $ReturnValue .= "<br>";
            }
        }
        $RadioLoop++;
    }

    $ftnMakeRadioValue = $ReturnValue;
    return $ftnMakeRadioValue;
}

function ftnMakeCheckboxValue($SelectName, $SelectID, $OptionValue, $CommentValue, $SelectValue, $ExecFunction){
    $ftnMakeCheckboxValue = "";

    if($OptionValue != ""){
        $s_SelectID = explode(",", $SelectID);
        $s_OptionValue = explode(",", $OptionValue);
        $s_CommentValue = explode(",", $CommentValue);
        if($SelectValue){
            $s_SelectValue = explode(",", $SelectValue);
        }


        for($i1 = 0; $i1 < count($s_OptionValue); $i1++){
            $ftnMakeCheckboxValue .= "<input type='checkbox' name='".$SelectName."' ";
            if($s_SelectID[$i1]){
                $ftnMakeCheckboxValue .= " id='".$SelectName."_".$s_SelectID[$i1]."' ";
            }
            if($s_OptionValue[$i1]){
                $ftnMakeCheckboxValue .= " value='".$s_OptionValue[$i1]."' ";
            }
            if($SelectValue){
                for($i2 = 0; $i2 < count($s_SelectValue); $i2++){
                    if($s_SelectValue[$i2] == $s_OptionValue[$i1]){
                        $ftnMakeCheckboxValue .= " checked ";
                    } else {
                        $ftnMakeCheckboxValue .= " ";
                    }
                }
            }
            if($ExecFunction){
                $ftnMakeCheckboxValue .= " onclick=\"".$ExecFunction."\" ";
            }
            $ftnMakeCheckboxValue .= " />";
            if($SelectID){
                $ftnMakeCheckboxValue .= " <label for='".$SelectName."_".$s_SelectID[$i1]."'>";
            }
            $ftnMakeCheckboxValue .= $s_CommentValue[$i1];
            if($SelectID){
                $ftnMakeCheckboxValue .= " </label> ";
            }

        }
    }


    return $ftnMakeCheckboxValue;
}


function ftnMakeSelectValue($SelectName, $OptionValue, $CommantValue, $DefaultValue, $SelectValue, $ExecFunction, $class = 'fSelect'){
    if($OptionValue != ""){
        if($SelectName != "" && $ExecFunction == ""){
            if($class != ""){
                $ftnMakeSelectValue = "<select id='".$SelectName."' name='".$SelectName."' class='".$class."' title='".$SelectName."'>";
            } else {
                $ftnMakeSelectValue = "<select id='".$SelectName."' name='".$SelectName."' title='".$SelectName."'>";
            }


        } else if($SelectName != "" && $ExecFunction != "") {
            if($class != ""){
                $ftnMakeSelectValue = "<select id='".$SelectName."' name='".$SelectName."' class='".$class."' title='".$SelectName."' onchange=\"".$ExecFunction."\">";
            } else {
                $ftnMakeSelectValue = "<select id='".$SelectName."' name='".$SelectName."' title='".$SelectName."' onchange=\"".$ExecFunction."\">";
            }
        }

        $OptionValueS = explode(",", $OptionValue);
        $CommantValueS = explode(",", $CommantValue);

        if($DefaultValue != ""){
            $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='' selected>".$DefaultValue."</option>";
        }

        for($i = 0 ; $i < count($OptionValueS); $i ++){
            $OptionValueV = Trim($OptionValueS[$i]);
            $CommantValueV = Trim($CommantValueS[$i]);

            if($OptionValueV == $SelectValue){
                $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='".$OptionValueV."' selected>".$CommantValueV."</option>";
            } else {
                $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='".$OptionValueV."'>".$CommantValueV."</option>";
            }
        }

        $ftnMakeSelectValue = $ftnMakeSelectValue . "</select>";
    } else {
        if ($SelectName != "" && $ExecFunction == ""){
            $ftnMakeSelectValue = "<select name='".$SelectName."' title='".$SelectName."'>";
        } else if ($SelectName != "" && $ExecFunction != ""){
            $ftnMakeSelectValue = "<select name='".$SelectName."' title='".$SelectName."' onchange='".$ExecFunction."'>";
        }

        if ($DefaultValue != ""){
            $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='' selected>".$DefaultValue."</option>";
        }

        $ftnMakeSelectValue = $ftnMakeSelectValue . "</select>";

    }
    return $ftnMakeSelectValue;
}

Function ftnMakeSelectValue2($SelectName, $SelectObject, $DefaultValue, $SelectValue, $ExecFunction, $class = 'fSelect'){
    $ftnMakeSelectValue = "";

    if (isset($SelectObject) && !Empty($SelectObject)){
        if ($SelectName != "" && $ExecFunction == ""){
            if ($class != ""){
                $ftnMakeSelectValue = "<select name='".$SelectName."' id='".$SelectName."' class='".$class."' title='".$SelectName."'>";
            } else {
                $ftnMakeSelectValue = "<select name='".$SelectName."' id='".$SelectName."' title='".$SelectName."'>";
            }
        } else if ($SelectName != "" && $ExecFunction != ""){
            if ($class != ""){
                $ftnMakeSelectValue = "<select name='".$SelectName."' id='".$SelectName."' class='".$class."' title='".$SelectName."' onchange=\"".$ExecFunction."\">";
            } else {
                $ftnMakeSelectValue = "<select name='".$SelectName."' id='".$SelectName."' title='".$SelectName."' onchange=\"".$ExecFunction."\">";
            }
        }

        if ($DefaultValue != ""){
            $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='' selected>".$DefaultValue."</option>";
        }

        foreach ($SelectObject as $key => $value){
            if($SelectValue == $key){
                $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='".$key."' selected>".$value."</option>";
            } else {
                $ftnMakeSelectValue = $ftnMakeSelectValue . "<option value='".$key."' >".$value."</option>";
            }

        }

        $ftnMakeSelectValue = $ftnMakeSelectValue . "</select>";
    }

    return $ftnMakeSelectValue;
}

function ftnMakeSelectCode($SelectName, $LISTRS, $DefaultValue, $SelectValue, $ExecFunction, $class = 'fSelect'){

    $ftnMakeSelectValue = "";

    if(count($LISTRS)){
        $className = isset($class) && $class ? "class='".$class."'" : "";
        $functionName = isset($ExecFunction) && $ExecFunction ? "onchange=\"".$ExecFunction."\"" : "";

        $ftnMakeSelectValue = "<select id='".$SelectName."' name='".$SelectName."' ".$className." ".$functionName." title='".$SelectName."'>";

        if($DefaultValue){
            $ftnMakeSelectValue .= "<option value=''>".$DefaultValue."</option>";
        }
        foreach ($LISTRS as $row){
            if($row['minorCode'] == $SelectValue){
                $ftnMakeSelectValue .= "<option value='".$row['minorCode']."' selected>".$row['codeName']."</option>";
            } else {
                $ftnMakeSelectValue .= "<option value='".$row['minorCode']."'>".$row['codeName']."</option>";
            }

        }
        $ftnMakeSelectValue .= "</select>";

    }

    return $ftnMakeSelectValue;
}

function fileCheck($directory, $filename){
    $fileCheck = "";

    if(is_dir($directory) && file_exists($directory)){
        $handle = opendir($directory);
        while(false !== ($file = readdir($handle))){
            if($file != "." && $file != ".."){
                $s_file = explode(".",$file);
                if($s_file[0] == $filename){
                    $fileCheck = $file;
                    break;
                }
            }
        }
    }

    return $fileCheck;

}

function changeDate($dateValue){
    if($dateValue){
        if(strpos($dateValue, "-") == false){
            return substr($dateValue,0,4)."-".substr($dateValue,4,2)."-".substr($dateValue,6,2);
        } else {
            return $dateValue;
        }
    } else {
        return "";
    }
}

function removeDir($directory){
    $handle = opendir($directory);
    while($file = readdir($handle)){
        @unlink($directory.$file);
    }
    closedir($directory);
    return "success";
}

function removeFile($directory, $file){
    @unlink($directory.$file);
    return "success";
}

function removeFileTotalPath($file){
    @unlink($file);
    return "success";
}


function makeNumber($digit, $inNumber){
    $outNumber = "";
    for($i1 = 1; $i1 <= $digit; $i1++){
        $outNumber .= "0";
    }
    $outNumber .= $inNumber;

    return substr($outNumber, $digit * -1);
}

function cUploadIFile($fileTypeArray, $psImgUploadDir, $psImgUploadTempName, $psImgUploadName, $psImgUploadType, $psImgNewName, $psAlertMessageFirstStr) {


    if($psImgUploadName){
        $fileType = explode("/",$psImgUploadType);
        $aImgAllowExtension = $fileTypeArray[$fileType[0]];
        $i1 = strrpos($psImgUploadName, ".");

        if($i1 === false) {
            cAlert("'" . $psAlertMessageFirstStr . "'는 업로드 할 수 없는 파일입니다.");
            exit;
        }

        $sImgExtension = substr($psImgUploadName, $i1 + 1);

        $b1 = false;
        for($i1 = 0; $i1 < count($aImgAllowExtension); $i1 ++) {
            if($aImgAllowExtension[$i1] == strtolower($sImgExtension)) {
                $b1 = true;
            }
        }

        if(!$b1) {
            cAlert("'" . $psAlertMessageFirstStr . "'는 업로드 할 수 없는 파일입니다.");
            exit;
        }

        $sImgName = $psImgNewName . "." . $sImgExtension;

        if(!is_dir($psImgUploadDir)){
            mkdir($psImgUploadDir, 0777, true);
        }

        if(!copy($psImgUploadTempName, $psImgUploadDir."/".$sImgName)) {
            cAlert("'" . $psAlertMessageFirstStr . "' 파일 업로드에 실패했습니다.");
            exit;
        }

        return $sImgName;
    } else {
        return '';
    }


}

function getBrowserInfo()
{
    $userAgent = $_SERVER["HTTP_USER_AGENT"];
    if(preg_match('/MSIE/i',$userAgent) && !preg_match('/Opera/i',$u_agent)){
        $browser = 'Internet Explorer';
    }
    else if(preg_match('/Firefox/i',$userAgent)){
        $browser = 'Mozilla Firefox';
    }
    else if (preg_match('/Chrome/i',$userAgent)){
        $browser = 'Google Chrome';
    }
    else if(preg_match('/Safari/i',$userAgent)){
        $browser = 'Apple Safari';
    }
    elseif(preg_match('/Opera/i',$userAgent)){
        $browser = 'Opera';
    }
    elseif(preg_match('/Netscape/i',$userAgent)){
        $browser = 'Netscape';
    }
    else{
        $browser = "Other";
    }

    return $browser;
}

function fileDownload($directory, $file_name, $file_real_name){

    $down_file = $directory.$file_name;

    if(file_exists($down_file)){
        $filesize = filesize($down_file);
        header("Content-Type:application/octet-stream");
        header("Content-Disposition:attachment;filename=$file_real_name");
        header("Content-Transfer-Encoding:binary");
        header("Content-Length:".$filesize);
        header("Cache-Control:cache,must-revalidate");
        header("Pragma:no-cache");
        header("Expires:0");
        if(is_file($down_file)){
            $fp = fopen($down_file,"r");
            fpassthru($fp);
            fclose($fp);
        }
    } else {
        cAlert("파일이 없습니다.");
    }
}

function KrDate($date){
    $t = strtotime($date) - time();

    if($t < 3600 * 24 * 7){
        if($t < 60) return $t . '초 전';
        else if($t < 3600) return floor($t / 60) . '분 전';
        else if($t < 3600 * 24) return floor($t / 3600) . '시간 전';
        else if($t < 3600 * 24 * 7)  return floor($t / (3600 * 24)) . '일 전';
    } else {
        return date('Y-m-d', strtotime($date));
    }
}

function sendPush($token, $serverKey , $title, $body, $link){
    $result = "";

    $url = "https://fcm.googleapis.com/fcm/send";

    $fields = array( 'registration_ids' => $token
    , 'notification' => array( 'title' => $title
        , 'body' => $body
        , 'sound' => 'default'
        , 'badge' => '1' )
    , 'data' => array('url' => $link)
    , 'priority'=>'high' );

    $headers = array( 'Authorization:key ='.$serverKey, 'Content-Type: application/json' );



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
        //die('FCM Send Error: ' . curl_error($ch));
        $result = "error";
    } else {
        $result = "success";
    }
    curl_close($ch);

    return $result;
}

function newDayIcon($newDayIconyn, $newDay, $regDate){
    $returnValue = "";
    if($newDayIconyn == "Y"){
        $nowDay = new DateTime(date("Y-m-d"));
        $calDate = new DateTime($regDate);
        if($nowDay->diff($calDate)->days >= 0 && $nowDay->diff($calDate)->days <= $newDay){
            $returnValue = "<span class='icoNew'></span>";
        }
    }
    return $returnValue;
}

function makeInput($name, $value, $class, $style){
    return "<input type='text' name='".$name."' id='".$name."' value='".$value."' class='fText ".$class."' style='".$style."'> ";
}

function setYN($status){
    return $status == 'Y' ? '예' : "아니오";
}


function checkRefreshToken($token){
    if($token) {
        $decode_array = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))), true);
        if ($decode_array) {
            if($decode_array['type'] != "refresh"){
                echo json_encode(array('result' => RESULT[1], 'message' => '정상적인 토큰이 아닙니다.'));
                exit;
            }
            if($decode_array['exp'] < time()){
                echo json_encode(array('result' => RESULT[1], 'message' => '만료된 토큰입니다.'));
                exit;
            }
            return $decode_array['memberId'];
        }
    } else {
        echo json_encode(array('result' => RESULT[1], 'message' => '토큰이 없습니다.'));
        exit;
    }
}

function checkToken($token){
    if($token) {
        $decode_array = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))), true);
        if ($decode_array) {
            if($decode_array['type'] != "access"){
                echo json_encode(array('result' => RESULT[1], 'message' => '정상적인 토큰이 아닙니다.'));
                exit;
            }
            if($decode_array['exp'] < time()){
                echo json_encode(array('result' => RESULT[1], 'message' => '만료된 토큰입니다.'));
                exit;
            }
            return $decode_array['memberId'];
        }
    } else {
        echo json_encode(array('result' => RESULT[1], 'message' => '토큰이 없습니다.'));
        exit;
    }
}

function makeMark($length){
    $returnValue = "";

    for($i1 = 0; $i1 < $length; $i1++){
        $returnValue .= "*";
    }
    return $returnValue;
}

function ePrint($value){
    echo "<pre>".print_r($value, true)."</pre>";
}

function cutKor($contents, $strLength){
    $makeContents = $contents;
    if(mb_strlen($strLength) > 50){
        $makeContents = mb_substr($contents, 'UTF-8');
    }
    return $makeContents;
}

function checkBase64Encoded($data){
    if(preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)){
        return true;
    } else {
        return false;
    }
}

function isHttpsRequest() {
    if ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        return "https://".$_SERVER['HTTP_HOST'];
    } else {
        return "http://".$_SERVER['HTTP_HOST'];
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function calBuyPlan($plan, $startPrice, $totalBuyPrice){
    if($plan == "A"){
        makeTr(1, $startPrice, 1, $totalBuyPrice * 0.01);
        makeTr(2, $startPrice, 0.99, $totalBuyPrice * 0.02);
        makeTr(3, $startPrice, 0.98, $totalBuyPrice * 0.03);
        makeTr(4, $startPrice, 0.97, $totalBuyPrice * 0.04);
        makeTr(5, $startPrice, 0.95, $totalBuyPrice * 0.05);
        makeTr(6, $startPrice, 0.93, $totalBuyPrice * 0.05);
        makeTr(7, $startPrice, 0.9, $totalBuyPrice * 0.1);
        makeTr(8, $startPrice, 0.85, $totalBuyPrice * 0.15);
        makeTr(9, $startPrice, 0.8, $totalBuyPrice * 0.15);
        makeTr(10, $startPrice, 0.75, $totalBuyPrice * 0.4);
    } else if($plan == "B"){
        makeTr(1, $startPrice, 1, $totalBuyPrice * 0.1);
        makeTr(2, $startPrice, 0.9, $totalBuyPrice * 0.2);
        makeTr(3, $startPrice, 0.8, $totalBuyPrice * 0.3);
        makeTr(4, $startPrice, 0.75, $totalBuyPrice * 0.4);
    } else if($plan == "C"){
        makeTr(1, $startPrice, 1, $totalBuyPrice * 0.01);
        makeTr(2, $startPrice, 0.97, $totalBuyPrice * 0.02);
        makeTr(3, $startPrice, 0.94, $totalBuyPrice * 0.04);
        makeTr(4, $startPrice, 0.91, $totalBuyPrice * 0.06);
        makeTr(5, $startPrice, 0.88, $totalBuyPrice * 0.08);
        makeTr(6, $startPrice, 0.85, $totalBuyPrice * 0.1);
        makeTr(7, $startPrice, 0.82, $totalBuyPrice * 0.14);
        makeTr(8, $startPrice, 0.79, $totalBuyPrice * 0.18);
        makeTr(9, $startPrice, 0.76, $totalBuyPrice * 0.22);
        makeTr(10, $startPrice, 0.73, $totalBuyPrice * 0.25);
    }

}
function makeTr($no, $price, $rate, $totalPrice){
    $calPrice = getPrice($price, $rate);
    $calQuantity = floor($totalPrice/$calPrice);
    echo ("<tr>
                                            <td style='text-align: center'>".$no."</td>
                                             <td style='text-align: center'>".number_format($calPrice)."</td>
                                             <td style='text-align: center'>".floor($totalPrice/$calPrice)."</td>
                                             <td style='text-align: center'>".number_format($calPrice * $calQuantity)."</td>
                                            </tr>");
}

function getPrice($price, $rate){
    $nowPrice = floor($price * $rate);

    if($nowPrice <= 2000){
        $returnPrice =  $nowPrice;
    } else if($nowPrice > 2000 && $nowPrice <= 5000){
        $returnPrice =  $nowPrice - ($nowPrice % 5);
    } else if($nowPrice > 5000 && $nowPrice <= 20000){
        $returnPrice =  $nowPrice - ($nowPrice % 10);
    } else if($nowPrice > 20000 && $nowPrice <= 50000){
        $returnPrice =  $nowPrice - ($nowPrice % 50);
    } else if($nowPrice > 50000 && $nowPrice <= 200000){
        $returnPrice =  $nowPrice - ($nowPrice % 100);
    } else if($nowPrice > 200000 && $nowPrice <= 500000){
        $returnPrice =  $nowPrice - ($nowPrice % 500);
    } else if($nowPrice > 500000){
        $returnPrice =  $nowPrice - ($nowPrice % 1000);
    }

    return $returnPrice;
}

function stickerStar($number){
    $returnValue = "";

    for($i1 = 0; $i1 < $number; $i1++){
        $returnValue .= "☆";
    }

    return $returnValue;
}

function getKoreaInvestmentAuth($stockAppKey, $stockAppSecret){
    $url = "https://openapi.koreainvestment.com:9443/oauth2/Approval";


    $headers = array(
        'Content-Type: application/json; utf-8'
    );

    $fcmFields = array(
        'grant_type' => "client_credentials",
        'appkey' => $stockAppKey,
        'secretkey' => $stockAppSecret
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $response = json_decode(curl_exec($ch), true);

    return $response['approval_key'];
}

?>