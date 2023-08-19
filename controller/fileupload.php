<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "editorUpload"){
    $new_file_name = isset($_FILES['file_name']) ? cUploadIFile($fileTypeArray, $_SERVER["DOCUMENT_ROOT"].$editorPath, $_FILES['file_name']['tmp_name'], $_FILES['file_name']['name'], $_FILES['file_name']['type'], "editor_" . time(), "에디터 파일") : "";

    if($new_file_name){
        echo json_encode(array('result'=>RESULT[0],'viewFileName'=>$editorPath."/".$new_file_name, 'uploadFileName'=>$new_file_name));
        exit;
    } else {
        echo json_encode(array('result'=>RESULT[1]));
        exit;
    }
}


?>