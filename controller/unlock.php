<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $q = "INSERT INTO `unlock` (`type`, gubun, stock, summary, currentPrice, targetPrice, lossCutPrice, interViewDate) 
                VALUES (:type, :gubun, :stock, :summary, :currentPrice, :targetPrice, :lossCutPrice, :interViewDate)";
        $rs = $con->prepare($q);
        $rs->bindValue(':type', $type, PDO::PARAM_STR);
        $rs->bindValue(':gubun', $gubun, PDO::PARAM_STR);
        $rs->bindValue(':stock', $stock, PDO::PARAM_STR);
        $rs->bindValue(':summary', $summary, PDO::PARAM_STR);
        $rs->bindValue(':currentPrice', $currentPrice, PDO::PARAM_INT);
        $rs->bindValue(':targetPrice', $targetPrice, PDO::PARAM_INT);
        $rs->bindValue(':lossCutPrice', $lossCutPrice, PDO::PARAM_INT);
        $rs->bindValue(':interViewDate', $interViewDate, PDO::PARAM_STR);
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

    $sWhere = "";

    if($searchKeyword){
        $sWhere .= " AND a.stock LIKE :searchKeyword";
    }

    $q2 = "SELECT a.*
            , (SELECT COUNT(*) FROM buy_info WHERE stockName = a.stock) buyCount
            FROM `unlock` a WHERE type = '잠금해제' AND a.interViewDate >= DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -2 MONTH), '%Y-%m-%d') ".$sWhere." ORDER BY a.interViewDate DESC ";
    $rs2 = $con->prepare($q2);
    if($searchKeyword){
        $rs2->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml1 = "";

    if($count2){
        foreach ($LISTRS2 as $row2){

            //$buyYN = $row2['buyCount'] > 0 ? "style='background:#f4f5f8'" : "";
            $buyYN = $row2['buyCount'] > 0 ? "class='checked'" : "";

            $appendHtml1 .= "<tr ".$buyYN.">
                                <td class='center'><a href='indexView.php?idx=".$row2['idx']."'>".$row2['interViewDate']."</a></td>
                                <td class='center'><a href='indexView.php?idx=".$row2['idx']."'>".$row2['gubun']."</a></td>                                
                                <td class='center'><a href='indexView.php?idx=".$row2['idx']."'>".$row2['stock']."</a></td>
                                <td class='center'>".number_format($row2['currentPrice'])."</td>
                                <td class='center'>".number_format($row2['targetPrice'])."</td>
                                <td class='center'>".number_format($row2['lossCutPrice'])."</td>
                           </tr>
                            ";
        }
    }

    $q3 = "SELECT a.*
            , (SELECT COUNT(*) FROM buy_info WHERE stockName = a.stock) buyCount
            FROM `unlock` a WHERE type = 'KB하반기유망주' ".$sWhere." ORDER BY a.interViewDate DESC ";
    $rs3 = $con->prepare($q3);
    if($searchKeyword){
        $rs3->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs3->execute();
    $count3 = $rs3->rowCount();
    $LISTRS3 = $rs3->fetchAll();

    $appendHtml2 = "";

    if($count3){
        foreach ($LISTRS3 as $row3){

            $buyYN = $row3['buyCount'] > 0 ? "class='checked'" : "";

            $appendHtml2 .= "<tr ".$buyYN.">
                                <td class='center'><a href='indexView.php?idx=".$row3['idx']."'>".$row3['interViewDate']."</a></td>
                                <td class='center'><a href='indexView.php?idx=".$row3['idx']."'>".$row3['gubun']."</a></td>
                                <td class='center'><a href='indexView.php?idx=".$row3['idx']."'>".$row3['stock']."</a></td>                                
                                <td class='center'>".number_format($row3['currentPrice'])."</td>
                                <td class='center'>".number_format($row3['targetPrice'])."</td>
                                <td class='center'>".number_format($row3['lossCutPrice'])."</td>
                           </tr>
                            ";
        }
    }

    $q4 = "SELECT a.*
            , (SELECT COUNT(*) FROM buy_info WHERE stockName = a.stock) buyCount
            FROM `unlock` a WHERE type = 'KB추천주' AND a.interViewDate >= DATE_FORMAT(DATE_ADD(NOW(), INTERVAL -2 MONTH), '%Y-%m-%d') ".$sWhere." ORDER BY a.interViewDate DESC ";
    $rs4 = $con->prepare($q4);
    if($searchKeyword){
        $rs4->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs4->execute();
    $count4 = $rs4->rowCount();
    $LISTRS4 = $rs4->fetchAll();

    $appendHtml3 = "";

    if($count4){
        foreach ($LISTRS4 as $row4){

            $buyYN = $row4['buyCount'] > 0 ? "class='checked'" : "";

            $appendHtml3 .= "<tr ".$buyYN.">
                                <td class='center'><a href='indexView.php?idx=".$row4['idx']."'>".$row4['interViewDate']."</a></td>
                                <td class='center'><a href='indexView.php?idx=".$row4['idx']."'>".$row4['gubun']."</a></td>
                                <td class='center'><a href='indexView.php?idx=".$row4['idx']."'>".$row4['stock']."</a></td>                                
                                <td class='center'>".number_format($row4['currentPrice'])."</td>
                                <td class='center'>".number_format($row4['targetPrice'])."</td>
                                <td class='center'>".number_format($row4['lossCutPrice'])."</td>
                           </tr>
                            ";
        }
    }

    echo json_encode(array('unlockList1'=>$appendHtml1, 'unlockList2'=>$appendHtml2, 'unlockList3'=>$appendHtml3));
    exit;

} else if($trace == "setState") {
    try {
        $q2 = "UPDATE `unlock` SET successYN = :successYN, successDate = :successDate, buyYN = :buyYN, summary = :summary WHERE idx = :idx ";
        $rs2 = $con->prepare($q2);
        $rs2->bindValue(':successYN', $successYN, PDO::PARAM_STR);
        $rs2->bindValue(':successDate', $successDate, PDO::PARAM_STR);
        $rs2->bindValue(':buyYN', $buyYN, PDO::PARAM_STR);
        $rs2->bindValue(':summary', $summary, PDO::PARAM_STR);
        $rs2->bindValue(':idx', $idx, PDO::PARAM_INT);
        $rs2->execute();

        echo json_encode(array('result' => RESULT[0], 'message' => SUCCESSMESSGE[1], 'goLink' => 'index.php'));
        exit;
    } catch (PDOException $e) {
        echo json_encode(array('result' => RESULT[1], 'message' => ERRORMESSGE[0]));
        exit;
    }
} else if($trace == "getType"){
    $q = "SELECT * FROM site_code WHERE major_code = 'type' ORDER BY minor_code ASC";
    $rs = $con->prepare($q);
    $rs->execute();
    $count = $rs->rowCount();
    $LISTRS = $rs->fetchAll();
    $appendHtml = "<option value=''>선택</option>";

    if($count){
        foreach ($LISTRS as $row){
            $appendHtml .= "<option value='".$row['minor_code']."'>".$row['code_name']."</option>";
        }
    }

    echo json_encode(array('appendHtml'=>$appendHtml));
}