<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $makeDay = $makeDay."-01";
        $endDay = strtotime("+1 months", strtotime($makeDay));

        $q = "REPLACE INTO trade_day (dayValue) VALUES (:dayValue)";
        $rs = $con->prepare($q);

        for($i1 = 0; $i1 < 32; $i1++){
            $timeValue = strtotime("+".$i1." days", strtotime($makeDay));
            if($endDay === $timeValue){
                break;
            }
            if(DATE("w", $timeValue) > 0 && DATE("w", $timeValue) < 6){
                $rs->bindValue(':dayValue', DATE("Y-m-d", $timeValue), PDO::PARAM_STR);
                $rs->execute();
            }

        }

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
} else if($trace == "getList"){

    $sWhere = "";

    $searchYear = isset($_REQUEST['searchYear']) && $_REQUEST['searchYear'] ? $_REQUEST['searchYear'] : DATE("Y");
    $searchMonth = isset($_REQUEST['searchMonth']) && $_REQUEST['searchMonth'] ? $_REQUEST['searchMonth'] : DATE("m");

    if($searchYear){
        $sWhere .= " AND DATE_FORMAT(dayValue, '%Y') = :searchYear ";
    }
    if($searchMonth){
        $sWhere .= " AND DATE_FORMAT(dayValue, '%m') = :searchMonth ";
    }

    $q2 = "SELECT *, DAYOFWEEK(dayValue) weekValue           
            FROM trade_day
            WHERE 1 = 1 ".$sWhere." ORDER BY dayValue ASC";

    $rs2 = $con->prepare($q2);
    if($searchYear){
        $rs2->bindValue(':searchYear', $searchYear, PDO::PARAM_STR);
    }
    if($searchMonth){
        $rs2->bindValue(':searchMonth', $searchMonth, PDO::PARAM_STR);
    }
    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml = "";
    $i1 = 0;

    if($count2){
        foreach ($LISTRS2 as $row2){
            if($i1 == 0){
                $appendHtml .= "<tr>";
                if($row2['weekValue'] > 2){
                    for($i1 = 0; $j1 < $row2['weekValue'] - 2; $j1++){
                        $appendHtml .= "<td></td>";
                    }

                }
            } else {
                if($row2['weekValue'] == 2){
                    $appendHtml .= "</tr><tr>";
                }
            }

            $appendHtml .= "<td class='center'>".$row2['dayValue']."</td>";

            $i1++;
        }
        if($row2['weekValue'] < 6){
            for($i1 = 0; $j1 < 6 - $row2['weekValue']; $j1++){
                $appendHtml .= "<td></td>";
            }
        }
        $appendHtml .= "</tr>";
    }

    echo json_encode(array('appendHtml'=>$appendHtml));
    exit;

} else if($trace == "minusForm"){
    try {

        $con->beginTransaction();

        $exceptDays = explode(",", $exceptDay);

        $q = "DELETE FROM trade_day WHERE dayValue = :dayValue";
        $rs = $con->prepare($q);

        for($i1 = 0; $i1 < count($exceptDays); $i1++){
            $rs->bindValue(':dayValue', $exceptDays[$i1], PDO::PARAM_STR);
            $rs->execute();
        }

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[2]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
}