<?php
include $_SERVER['DOCUMENT_ROOT']."/common/php/var.php";
include $_SERVER['DOCUMENT_ROOT']."/common/php/common.php";

$trace = isset($_REQUEST['trace']) && $_REQUEST['trace'] ? $_REQUEST['trace'] : "";

$con = cConnDB();

$base64URLencodeHEADER = str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($HEADER));
$data = json_decode(file_get_contents('php://input'), true);
$getHeaders = apache_request_headers();

header('Content-Type: application/json');

if($trace == "list"){

    $dataSet = array();

    $nowPage = isset($_REQUEST['nowPage']) && $_REQUEST['nowPage'] ? $_REQUEST['nowPage'] : 1;
    $listViewCount = isset($_REQUEST['listViewCount']) && $_REQUEST['listViewCount'] ? $_REQUEST['listViewCount'] : 10;

    $q = "SELECT COUNT(*) totalCount FROM store ORDER BY ratings DESC, deliveryFee ASC";
    $rs = $con->prepare($q);
    $rs->execute();
    $row = $rs->fetch();
    $totalCount = $row['totalCount'];

    $start = ($nowPage - 1) * $listViewCount;
    $totalPage = ceil($totalCount / $listViewCount);
    $nowTotalCount = $nowPage * $listViewCount;

    $moreYN = $totalCount > $nowTotalCount ? true : false;

    $q1 = "SELECT * FROM store ORDER BY ratings DESC, deliveryFee ASC LIMIT ".$start.", ".$listViewCount;
    $rs1 = $con->prepare($q1);
    $rs1->execute();
    $count1 = $rs1->rowCount();
    $LISTRS1 = $rs1->fetchAll();

    if($count1){
        foreach ($LISTRS1 as $row1){
            $tagsArray = array();

            if($row1['tags']){
                $tags = explode(",", $row1['tags']);
                foreach ($tags as $tagsData){
                    $tagsArray[] = trim($tagsData);
                }
            }

            $dataSet[] = array(
                "id"=>strval($row1['idx'])
            ,"name"=>$row1['name']
            ,"thumbUrl"=>isHttpsRequest()."/img".$row1['thumbUrl']
            ,"tags"=>$tagsArray
            ,"detail"=>$row1['detail']
            ,"priceRange"=>$row1['priceRange']
            ,"ratings"=>strval($row1['ratings'])
            ,"ratingsCount"=>$row1['ratingsCount']
            ,"deliveryTime"=>$row1['deliveryTime']
            ,"deliveryFee"=>$row1['deliveryFee']
            );
        }
    }

    echo json_encode(array("meta"=>array("count"=>$count1,"hasMore"=>$moreYN),"data"=>$dataSet));
    exit;
} else if($trace == "view"){
    $q = "SELECT * FROM store WHERE idx = :idx";
    $rs = $con->prepare($q);
    $rs->bindValue(':idx', $id, PDO::PARAM_INT);
    $rs->execute();
    $row = $rs->fetch();

    $tagsArray = array();
    $productArray = array();

    if($row['tags']){
        $tags = explode(",", $row['tags']);
        foreach ($tags as $tagsData){
            $tagsArray[] = trim($tagsData);
        }
    }

    $q1 = "SELECT * FROM store_product WHERE storeIdx = :storeIdx ORDER BY idx ASC";
    $rs1 = $con->prepare($q1);
    $rs1->bindValue(':storeIdx', $id, PDO::PARAM_INT);
    $rs1->execute();
    $count1 = $rs1->rowCount();
    $LISTRS1 = $rs1->fetchAll();

    if($count1){
        foreach ($LISTRS1 as $row1){
            $productArray[] = array("id"=>strval($row1['idx']), "name"=>$row1['name'], "imgUrl"=>isHttpsRequest()."/img".$row1['imgUrl'],"detail"=>$row1['detail'],"price"=>$row1['price']);
        }
    }


    $dataSet = array(
        "id"=>strval($row['idx'])
        ,"name"=>$row['name']
        ,"thumbUrl"=>isHttpsRequest()."/img".$row['thumbUrl']
        ,"tags"=>$tagsArray
        ,"detail"=>$row['detail']
        ,"priceRange"=>$row['priceRange']
        ,"ratings"=>strval($row['ratings'])
        ,"ratingsCount"=>$row['ratingsCount']
        ,"deliveryTime"=>$row['deliveryTime']
        ,"deliveryFee"=>$row['deliveryFee']
        ,"detail"=>$row['detail']
        ,"products"=>$productArray
        );

    echo json_encode($dataSet);
    exit;
}

?>