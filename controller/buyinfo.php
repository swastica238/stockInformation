<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $q = "INSERT INTO buy_info (stockName, planType, startPrice, totalBuyMoney, buyReason, registerDate) VALUES (:stockName, :planType, :startPrice, :totalBuyMoney, :buyReason, NOW())";
        $rs = $con->prepare($q);
        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
        $rs->bindValue(':planType', $planType, PDO::PARAM_INT);
        $rs->bindValue(':startPrice', $price, PDO::PARAM_INT);
        $rs->bindValue(':totalBuyMoney', $totalBuyMoney, PDO::PARAM_INT);
        $rs->bindValue(':buyReason', $buyReason, PDO::PARAM_STR);
        $rs->execute();

        $q1 = "SELECT LAST_INSERT_ID() idx";
        $rs1 = $con->prepare($q1);
        $rs1->execute();
        $row1 = $rs1->fetch();
        $idx = $row1['idx'];

        $q2 = "INSERT INTO buy_info_list (buyIdx, price, quantity, registerDate) VALUES (:buyIdx, :price, :quantity, NOW())";
        $rs2 = $con->prepare($q2);
        $rs2->bindValue(':buyIdx', $idx, PDO::PARAM_INT);
        $rs2->bindValue(':price', $price, PDO::PARAM_INT);
        $rs2->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $rs2->execute();

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
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

    if($searchKeyword){
       $sWhere .= " AND a.stockName LIKE :searchKeyword ";
    }

    //검색 숫자
    $q1 = "SELECT count(*) SEARCH_CNT 
            FROM buy_info a
            WHERE 1 = 1 ".$sWhere;
    $rs1 = $con->prepare($q1);
    if($searchKeyword){
        $rs1->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs1->execute();
    $row1 = $rs1->fetch();
    $SEARCH_CNT = $row1['SEARCH_CNT'];

    $start = ($nowPage - 1) * $listViewCount;
    $totalPage = ceil($SEARCH_CNT / $listViewCount);

    $q2 = "SELECT a.*
            , (SELECT COUNT(*) FROM buy_info_list WHERE buyIdx = a.idx) buyCount
            , (SELECT SUM(price*quantity) FROM buy_info_list WHERE buyIdx = a.idx) buyTotalMoney
            , (SELECT SUM(price*quantity) / SUM(quantity) FROM buy_info_list WHERE buyIdx = a.idx) avgPrice
            , (SELECT SUM(quantity) FROM buy_info_list WHERE buyIdx = a.idx ) totalQuantity
            , (SELECT COUNT(*) FROM `unlock` WHERE stock = a.stockName AND interViewDate >= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL -30 DAY ) ) unlockCount
            FROM buy_info a
            WHERE 1 = 1 ".$sWhere." ORDER BY a.isSell DESC, a.idx DESC limit ".$start.", ".$listViewCount;

    $rs2 = $con->prepare($q2);
    if($searchKeyword){
        $rs2->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }

    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml = "";
    $i1 = 0;
    $sumTotalMoney = 0;

    if($count2){
        foreach ($LISTRS2 as $row2){
            $isSell = $row2['isSell'] == "y" ? "매도" : "보유";
            $isSellBackGround = $row2['isSell'] == "n" ? "style='background:#f4f5f8'" : "";

            $buyTotalMoney = $row2['totalQuantity'] == 0 ? 0 : $row2['buyTotalMoney'];
            $sumTotalMoney = $sumTotalMoney + $buyTotalMoney;

            $unlockCount = $row2['unlockCount'] > 0 ? "<span style='color:red'>✪</span> " : "";

            $appendHtml .= "<tr ".$isSellBackGround.">
                                <td class='center'><a href='indexView.php?idx=".$row2['idx']."'>".$unlockCount.$row2['stockName']."</a></td>
                                <td class='center'>".$row2['registerDate']."</td>
                                <td class='center'>".number_format($buyTotalMoney)."</td>
                                <td class='center'>".number_format($row2['totalQuantity'])."</td>
                                <td class='center'>".number_format($row2['avgPrice'])."</td>
                                <td class='center'>".number_format($row2['buyCount'])."</td>
                                <td class='center'>".number_format($row2['avgPrice'] * 1.1)."</td>
                                <td class='center'>".number_format($row2['avgPrice'] * 0.9)."</td>                                                              
                                <td class='center'>".$isSell."</td>   
                           </tr>
                            ";

            $i1++;
        }
    }

    echo json_encode(array('SEARCH_CNT'=>$SEARCH_CNT, 'nowPage'=>$nowPage, 'totalPage'=>$totalPage, 'appendHtml'=>$appendHtml, 'sumTotalMoney'=>number_format($sumTotalMoney)));
    exit;

} else if($trace == "saveBuy"){
    try {
        $q2 = "INSERT INTO buy_info_list (buyIdx, price, quantity, registerDate) VALUES (:buyIdx, :price, :quantity, NOW())";
        $rs2 = $con->prepare($q2);
        $rs2->bindValue(':buyIdx', $idx, PDO::PARAM_INT);
        $rs2->bindValue(':price', $price, PDO::PARAM_INT);
        $rs2->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $rs2->execute();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
        exit;
    } catch (PDOException $e){
        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0]));
        exit;
    }
} else if($trace == "saveSell"){
    try {

        $sellAll = "n";

        $con->beginTransaction();

        $q = "SELECT SUM(quantity) totalQuantity
                , SUM(
                    CASE WHEN quantity > 0 THEN quantity * price ELSE 0 END 
                ) sumBuyMoney
                , SUM(
                    CASE WHEN quantity < 0 THEN quantity * price ELSE 0 END 
                ) sumSellMoney
                FROM buy_info_list WHERE buyIdx = :buyIdx";
        $rs = $con->prepare($q);
        $rs->bindValue(':buyIdx', $idx, PDO::PARAM_INT);
        $rs->execute();
        $row = $rs->fetch();

        $q2 = "INSERT INTO buy_info_list (buyIdx, price, quantity, registerDate) VALUES (:buyIdx, :price, :quantity, NOW())";
        $rs2 = $con->prepare($q2);
        $rs2->bindValue(':buyIdx', $idx, PDO::PARAM_INT);
        $rs2->bindValue(':price', $price, PDO::PARAM_INT);
        $rs2->bindValue(':quantity', $quantity*-1, PDO::PARAM_INT);
        $rs2->execute();

        if($row['totalQuantity'] == $quantity){
            $profit = 0;
            $loss = 0;
            if( ($price * $quantity) - ($row['sumBuyMoney'] - $row['sumSellMoney']) > 0 ) {
                $profit = ($price * $quantity) - ($row['sumBuyMoney'] - $row['sumSellMoney']);
            } else {
                $loss = (($price * $quantity) - ($row['sumBuyMoney'] - $row['sumSellMoney'])) * -1;
            }

            $q3 = "UPDATE buy_info SET isSell = 'y', sellPrice = :sellPrice, profit = :profit, loss = :loss  WHERE idx = :idx";
            $rs3 = $con->prepare($q3);
            $rs3->bindValue(':sellPrice', $price, PDO::PARAM_INT);
            $rs3->bindValue(':profit', $profit, PDO::PARAM_INT);
            $rs3->bindValue(':loss', $loss, PDO::PARAM_INT);
            $rs3->bindValue(':idx', $idx, PDO::PARAM_INT);
            $rs3->execute();

            $sellAll = "y";

        }

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0], 'sellAll'=>$sellAll));
        exit;
    } catch (PDOException $e){
        $con->rollBack();
        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
}