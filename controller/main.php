<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

$q0 = "SELECT registerDate FROM stock_info ORDER BY registerDate DESC LIMIT 1";
$rs0 = $con->prepare($q0);
$rs0->execute();
$row0 = $rs0->fetch();

$prevMonth = date("Y-m-d",strtotime ("-1 month", strtotime($row0['registerDate'])));
$prevDay = date("Y-m-d",strtotime ("-1 days", strtotime($row0['registerDate'])));
if($trace == "getList_week_this") {
    $dataResult = array();

    for ($i1 = 1; $i1 <= 4; $i1++) {
        if ($i1 == 1) {
            $prefix = "pf";
        } else if ($i1 == 2) {
            $prefix = "p";
        } else if ($i1 == 3) {
            $prefix = "i";
        } else if ($i1 == 4) {
            $prefix = "f";
        }
        $appendHtml = "";

        $q = "
                SELECT mainAgent, stockName, ROUND(SUM(buyStrength),2) buyStrength	
                FROM stock_info a
                WHERE mainAgent = :mainAgent
                AND registerDate BETWEEN ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 0 ) AND ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 4 )
                GROUP BY stockName 
                ORDER BY SUM(buyStrength) DESC LIMIT 10
            	

            ";
        $rs = $con->prepare($q);
        $rs->bindValue(':mainAgent', $prefix, PDO::PARAM_STR);
        $rs->execute();
        $count = $rs->rowCount();
        $LISTRS = $rs->fetchAll();

        if ($count) {
            foreach ($LISTRS as $row) {

                $appendHtml .= "<tr><td class='center' ><a href='/Manage/stockinfo/indexView.php?stockName=" . $row['stockName'] . "'>" . $row['stockName'] . "</a></td>";
                $appendHtml .= "<td class='center'>" . $row['buyStrength'] . "</td></tr>";
            }
        }
        $dataResult[] = array('mainAgent' => $prefix, 'appendHtml' => $appendHtml);
    }

    echo json_encode(array('data' => $dataResult, 'registerDate' => "(" . $row0['registerDate'] . ")"));
    exit;
} else if($trace == "getList_week") {
    $dataResult = array();

    for ($i1 = 1; $i1 <= 4; $i1++) {
        if ($i1 == 1) {
            $prefix = "pf";
        } else if ($i1 == 2) {
            $prefix = "p";
        } else if ($i1 == 3) {
            $prefix = "i";
        } else if ($i1 == 4) {
            $prefix = "f";
        }
        $appendHtml = "";

        $q = "SELECT *
            , (SELECT COUNT(*) FROM stock_info WHERE gubun = 's' AND registerDate BETWEEN DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 0 ), INTERVAL -7 DAY) AND DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 4 ), INTERVAL -7 DAY) AND stockName = z.stockName) sellCount
            , IFNULL((SELECT ROUND(SUM(buyStrength),2) FROM stock_info WHERE gubun = 'b' AND mainAgent = z.mainAgent AND registerDate BETWEEN DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 0 ), INTERVAL -14 DAY) AND DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 4 ), INTERVAL -14 DAY) AND stockName = z.stockName),0) prevWeek2
            , IFNULL((SELECT ROUND(SUM(buyStrength),2) FROM stock_info WHERE gubun = 'b' AND mainAgent = z.mainAgent AND registerDate BETWEEN ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 0 ) AND ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 4 ) AND stockName = z.stockName),0) nowWeek
            FROM (
                SELECT 'prevWeek' gubun, mainAgent, stockName, ROUND(SUM(buyStrength),2) buyStrength	
                FROM stock_info a
                WHERE gubun='b' AND mainAgent = :mainAgent
                AND registerDate BETWEEN DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 0 ), INTERVAL -7 DAY) AND DATE_ADD(ADDDATE(CURDATE(), - WEEKDAY(CURDATE()) + 4 ), INTERVAL -7 DAY)
                GROUP BY stockName 
                ORDER BY SUM(buyStrength) DESC LIMIT 10
            ) z	

            ";
        $rs = $con->prepare($q);
        $rs->bindValue(':mainAgent', $prefix, PDO::PARAM_STR);
        $rs->execute();
        $count = $rs->rowCount();
        $LISTRS = $rs->fetchAll();

        if ($count) {
            foreach ($LISTRS as $row) {

                $appendHtml .= "<tr><td class='center' ><a href='/Manage/stockinfo/indexView.php?stockName=" . $row['stockName'] . "'>" . $row['stockName'] . "</a></td>";
                $appendHtml .= "<td class='center'>" . $row['nowWeek'] . "</td>";
                $appendHtml .= "<td class='center'>" . $row['buyStrength'] . "</td>";
                $appendHtml .= "<td class='center'>" . $row['prevWeek2'] . "</td>";
                $appendHtml .= "<td class='center' style='color:blue'>" . $row['sellCount'] . "</td></tr>";
            }
        }
        $dataResult[] = array('mainAgent' => $prefix, 'appendHtml' => $appendHtml);
    }

    echo json_encode(array('data' => $dataResult, 'registerDate'=>"(".$row0['registerDate'].")"));
    exit;
} else if($trace == "getList_yesterday") {

    $dataResult = array();

    for ($i1 = 1; $i1 <= 4; $i1++) {
        if ($i1 == 1) {
            $prefix = "pf";
        } else if ($i1 == 2) {
            $prefix = "p";
        } else if ($i1 == 3) {
            $prefix = "i";
        } else if ($i1 == 4) {
            $prefix = "f";
        }
        $appendHtml = "";

        $q = "SELECT a.*
                , CASE WHEN (SELECT count(*) FROM stock_info WHERE registerDate = a.registerDate AND stockName = a.stockName) > 1 THEN (SELECT count(*) FROM stock_info WHERE registerDate = a.registerDate AND stockName = a.stockName)
                   ELSE '' END buyCount
                FROM stock_info a
                WHERE a.gubun = 'b' AND a.mainAgent = :mainAgent AND a.registerDate = :registerDate
                AND a.stockName NOT IN (
                    SELECT stockName FROM stock_info 
                    WHERE mainAgent = a.mainAgent 
                      AND registerDate BETWEEN :prevMonth AND :prevDay
                    )
            ";
        $rs = $con->prepare($q);
        $rs->bindValue(':mainAgent', $prefix, PDO::PARAM_STR);
        $rs->bindValue(':registerDate', $row0['registerDate'], PDO::PARAM_STR);
        $rs->bindValue(':prevMonth', $prevMonth, PDO::PARAM_STR);
        $rs->bindValue(':prevDay', $prevDay, PDO::PARAM_STR);
        $rs->execute();
        $count = $rs->rowCount();
        $LISTRS = $rs->fetchAll();

        if ($count) {
            foreach ($LISTRS as $row) {

                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;color:white'" : "";
                $buyCount = $row['buyCount'] ? " (" . $row['buyCount'] . ")" : "";

                $appendHtml .= "<tr><td class='center' " . $backGround . "><a href='/Manage/stockinfo/indexView.php?stockName=" . $row['stockName'] . "'>" . $row['stockName'] . " " . $buyCount . "</a></td>";
                $appendHtml .= "<td class='center'>" . $row['buyStrength'] . "</td>";
            }
        }
        $dataResult[] = array('mainAgent' => $prefix, 'appendHtml' => $appendHtml);
    }

    echo json_encode(array('data' => $dataResult, 'registerDate'=>"(".$row0['registerDate'].")" , 'thisWeekStartDay'=>$thisWeekStartDay, 'thisWeekEndDay'=>$thisWeekEndDay));
    exit;
} else if($trace == "getList_continue"){

        $dataResult = array();

        for($i1 = 1; $i1 <= 4; $i1++){
            if($i1 == 1){
                $prefix = "pf";
            } else if($i1 == 2){
                $prefix = "p";
            } else if($i1 == 3) {
                $prefix = "i";
            } else if($i1 == 4){
                $prefix = "f";
            }
            $appendHtml = "";

            $q = "SELECT * 
                    , (SELECT registerDate FROM stock_info WHERE mainAgent = :mainAgent AND stockName = z.stockName ORDER BY registerDate DESC LIMIT 1) lastDate
                    , (SELECT isImportant FROM stock_info WHERE mainAgent = :mainAgent1 AND stockName = z.stockName AND registerDate = lastDate) isImportant
                FROM (
                SELECT a.stockName, COUNT(a.stockName) stockCnt
                FROM stock_info a
                WHERE  a.gubun = 'b' AND a.mainAgent = :mainAgent2 AND a.registerDate BETWEEN :prevMonth AND :prevDay
                GROUP BY a.stockName
                HAVING COUNT(a.stockName) > 1
                ) z
                ORDER BY lastDate DESC, z.stockCnt  DESC LIMIT 10
            ";
            $rs = $con->prepare($q);
            $rs->bindValue(':mainAgent', $prefix, PDO::PARAM_STR);
            $rs->bindValue(':mainAgent1', $prefix, PDO::PARAM_STR);
            $rs->bindValue(':mainAgent2', $prefix, PDO::PARAM_STR);
            $rs->bindValue(':prevMonth', $prevMonth, PDO::PARAM_STR);
            $rs->bindValue(':prevDay', $prevDay, PDO::PARAM_STR);
            $rs->execute();
            $count = $rs->rowCount();
            $LISTRS = $rs->fetchAll();

            if($count){
                foreach ($LISTRS as $row){

                    $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;color:white'" : "";

                    $appendHtml .= "<tr><td class='center' ".$backGround."><a href='/Manage/stockinfo/indexView.php?stockName=".$row['stockName']."'>".$row['stockName']." ".$buyCount."</a></td>";
                    $appendHtml .= "<td class='center'>".$row['stockCnt']."</td>";
                }
            }
            $dataResult[] = array('mainAgent'=>$prefix, 'appendHtml'=>$appendHtml);
        }

        echo json_encode(array('data'=>$dataResult));
        exit;

} else if($trace == "getList_dup"){

    $dataResult = array();

    for($i1 = 1; $i1 <= 4; $i1++){
        if($i1 == 1){
            $prefix = "pf";
        } else if($i1 == 2){
            $prefix = "p";
        } else if($i1 == 3) {
            $prefix = "i";
        } else if($i1 == 4){
            $prefix = "f";
        }
        $appendHtml = "";

        $q = "SELECT * 
                FROM (
                    SELECT a.*
                     , (SELECT COUNT(*) FROM stock_info WHERE stockName = a.stockName AND registerDate = a.registerDate) buyCnt
                     FROM stock_info a
                     WHERE  a.gubun = 'b' AND a.mainAgent = :mainAgent AND a.registerDate = :registerDate
                 ) z WHERE z.buyCnt > 1";
        $rs = $con->prepare($q);
        $rs->bindValue(':mainAgent', $prefix, PDO::PARAM_STR);
        $rs->bindValue(':registerDate', $row0['registerDate'], PDO::PARAM_STR);
        $rs->execute();
        $count = $rs->rowCount();
        $LISTRS = $rs->fetchAll();

        if($count){
            foreach ($LISTRS as $row){

                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;color:white'" : "";

                $appendHtml .= "<tr><td class='center' ".$backGround."><a href='/Manage/stockinfo/indexView.php?stockName=".$row['stockName']."'>".$row['stockName']." ".$buyCount."</a></td>";
                $appendHtml .= "<td class='center'>".$row['buyCnt']."</td>";
            }
        }
        $dataResult[] = array('mainAgent'=>$prefix, 'appendHtml'=>$appendHtml);
    }

    echo json_encode(array('data'=>$dataResult));
    exit;
}