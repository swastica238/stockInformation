<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $q = "INSERT INTO exchange_info (`type`, exchangeRate, koreaMoney, dollarMoney, registerDate) VALUES (:type, :exchangeRate, :koreaMoney, :dollarMoney, NOW())";
        $rs = $con->prepare($q);
        $rs->bindValue(':type', $exchangeType, PDO::PARAM_STR);
        $rs->bindValue(':exchangeRate', $exchangeRate, PDO::PARAM_INT);
        $rs->bindValue(':koreaMoney', $koreaMoney, PDO::PARAM_INT);
        $rs->bindValue(':dollarMoney', $dollarMoney, PDO::PARAM_INT);
        $rs->execute();

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0], 'goLink'=>'index.php'));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
} else if($trace == "getList"){
    $nowPage = isset($_REQUEST['nowPage']) && $_REQUEST['nowPage'] ? $_REQUEST['nowPage'] : 1;
    $listViewCount = isset($_REQUEST['listViewCount']) && $_REQUEST['listViewCount'] ? $_REQUEST['listViewCount'] : 10;

    $sWhere = "";

    if($searchKey){
        $sWhere .= " AND a.type = :type ";
    }

    //검색 숫자
    $q1 = "SELECT count(*) SEARCH_CNT 
            FROM exchange_info a
            WHERE 1 = 1 ".$sWhere;
    $rs1 = $con->prepare($q1);
    if($searchKey){
        $rs1->bindValue(':type', $searchKey, PDO::PARAM_STR);
    }
    $rs1->execute();
    $row1 = $rs1->fetch();
    $SEARCH_CNT = $row1['SEARCH_CNT'];

    $start = ($nowPage - 1) * $listViewCount;
    $totalPage = ceil($SEARCH_CNT / $listViewCount);

    $q2 = "SELECT a.*            
            FROM exchange_info a
            WHERE 1 = 1 ".$sWhere." ORDER BY a.registerDate DESC limit ".$start.", ".$listViewCount;

    $rs2 = $con->prepare($q2);
    if($searchKey){
        $rs2->bindValue(':type', $searchKey, PDO::PARAM_STR);
    }

    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml = "";
    $i1 = 0;

    if($count2){
        foreach ($LISTRS2 as $row2){
            $type = $row2['type'] == "b" ? "원->달러": "달러->원" ;
            $isType = $row2['type'] == "s" ? "style='color:#f4f5f8'" : "";

            $appendHtml .= "<tr ".$isSellBackGround.">
                                <td class='center'>".substr($row2['registerDate'],0,10)."</td>
                                <td class='center'>".$type."</td>
                                <td class='center'>".$row2['exchangeRate']."</td>
                                <td class='center'>".number_format($row2['koreaMoney'])."</td>
                                <td class='center'>".$row2['dollarMoney']."</td>
                           </tr>
                            ";

            $i1++;
        }
    }

    echo json_encode(array('SEARCH_CNT'=>$SEARCH_CNT, 'nowPage'=>$nowPage,'listViewCount'=>$listViewCount, 'totalPage'=>$totalPage, 'appendHtml'=>$appendHtml));
    exit;

}