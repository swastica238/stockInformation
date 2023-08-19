<?php
include $_SERVER['DOCUMENT_ROOT']."/common/php/var.php";
include $_SERVER['DOCUMENT_ROOT']."/common/php/common.php";

$trace = isset($_REQUEST['trace']) && $_REQUEST['trace'] ? $_REQUEST['trace'] : "";

$base64URLencodeHEADER = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($HEADER));
$data = json_decode(file_get_contents('php://input'), true);
$getHeaders = apache_request_headers();

if($trace == "login"){

    $authorization = isset($getHeaders['authorization']) ? $getHeaders['authorization'] : $getHeaders['Authorization'];

    if(checkBase64Encoded(str_replace("Basic ", "", $authorization))){
        $token = str_replace("Basic ", "", $authorization);
        $memberData = explode(":", base64_decode($token));
        $memberId = $memberData[0];
        $memberPassWord = $memberData[1];

        /*$access_payload = '{"memberId":"'.$memberId.'","type":"access","iat":'.time().',"exp":'.strtotime("+1 week").'}';
        $refresh_payload = '{"memberId":"'.$memberId.'","type":"refresh","iat":'.time().',"exp":'.strtotime("+2 week").'}';*/
        $access_payload = '{"memberId":"'.$memberId.'","type":"access","iat":'.time().',"exp":'.strtotime("+5 min").'}';
        $refresh_payload = '{"memberId":"'.$memberId.'","type":"refresh","iat":'.time().',"exp":'.strtotime("+1 day").'}';

        $base64URLencode_access_PAYLOAD = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($access_payload));
        $base64URLencode_refresh_PAYLOAD = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($refresh_payload));

        $access_data = $base64URLencodeHEADER.".".$base64URLencode_access_PAYLOAD;
        $refresh_data = $base64URLencodeHEADER.".".$base64URLencode_refresh_PAYLOAD;
        $hashHmac_access_Data = hash_hmac('sha256', $access_data, $secret_key, true);
        $hashHmac_refresh_Data = hash_hmac('sha256', $refresh_data, $secret_key, true);

        $signature_access =  str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($hashHmac_access_Data));
        $signature_refresh =  str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($hashHmac_refresh_Data));

        $access_token = $base64URLencodeHEADER.".".$base64URLencode_access_PAYLOAD.".".$signature_access;
        $refresh_token = $base64URLencodeHEADER.".".$base64URLencode_refresh_PAYLOAD.".".$signature_refresh;

        header('Content-Type: application/json');
        echo json_encode(array("accessToken"=>$access_token, "refreshToken"=>$refresh_token));
        exit;


    }
} else if($trace == "refresh"){
    $authorization = isset($getHeaders['authorization']) ? $getHeaders['authorization'] : $getHeaders['Authorization'];
    $token = str_replace("Bearer ", "", $authorization);

    $memberId = checkRefreshToken($token);

    //if($memberId == "roy"){
        $access_payload = '{"memberId":"'.$memberId.'","type":"access","iat":'.time().',"exp":'.strtotime("+5 min").'}';
        $refresh_payload = '{"memberId":"'.$memberId.'","type":"refresh","iat":'.time().',"exp":'.strtotime("+1 day").'}';

        $base64URLencode_access_PAYLOAD = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($access_payload));
        $base64URLencode_refresh_PAYLOAD = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($refresh_payload));

        $access_data = $base64URLencodeHEADER.".".$base64URLencode_access_PAYLOAD;
        $refresh_data = $base64URLencodeHEADER.".".$base64URLencode_refresh_PAYLOAD;
        $hashHmac_access_Data = hash_hmac('sha256', $access_data, $secret_key, true);
        $hashHmac_refresh_Data = hash_hmac('sha256', $refresh_data, $secret_key, true);

        $signature_access =  str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($hashHmac_access_Data));
        $signature_refresh =  str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($hashHmac_refresh_Data));

        $access_token = $base64URLencodeHEADER.".".$base64URLencode_access_PAYLOAD.".".$signature_access;
        $refresh_token = $base64URLencodeHEADER.".".$base64URLencode_refresh_PAYLOAD.".".$signature_refresh;

        header('Content-Type: application/json');
        echo json_encode(array("accessToken"=>$access_token, "refreshToken"=>$refresh_token));
        exit;
    /*} else {
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }*/



}
?>