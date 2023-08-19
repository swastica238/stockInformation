<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

   try {

       $registerDate = isset($_REQUEST['registerDate']) && $_REQUEST['registerDate'] ? $_REQUEST['registerDate'] : DATE("Y-m-d");

       $con->beginTransaction();

       $q = "INSERT INTO stock_info (gubun, stockName, mainAgent, buyStrength, isImportant, registerDate) VALUES ('b', :stockName, :mainAgent, :buyStrength, :isImportant, :registerDate)";
       $rs = $con->prepare($q);

       if(count($pf_stockName)){
           for($i1 = 0; $i1 < count($pf_stockName); $i1++){
               $stockName = $pf_stockName[$i1];
               $mainAgent = "pf";
               $buyStrength = $pf_buyStrength[$i1];
               $isImportant = $pf_isImportant[$i1];


               if($stockName){
                   $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                   $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                   $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs->execute();
               }
           }
       }

       if(count($p_stockName)){

           for($i1 = 0; $i1 < count($p_stockName); $i1++){
               $stockName = $p_stockName[$i1];
               $mainAgent = "p";
               $buyStrength = $p_buyStrength[$i1];
               $isImportant = $p_isImportant[$i1];

               if($stockName){
                   $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                   $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                   $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs->execute();
               }
           }
       }

       if(count($i_stockName)){

           for($i1 = 0; $i1 < count($i_stockName); $i1++){
               $stockName = $i_stockName[$i1];
               $mainAgent = "i";
               $buyStrength = $i_buyStrength[$i1];
               $isImportant = $i_isImportant[$i1];

               if($stockName){
                   $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                   $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                   $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs->execute();
               }
           }
       }

       if(count($f_stockName)){

           for($i1 = 0; $i1 < count($f_stockName); $i1++){
               $stockName = $f_stockName[$i1];
               $mainAgent = "f";
               $buyStrength = $f_buyStrength[$i1];
               $isImportant = $f_isImportant[$i1];

               if($stockName){
                   $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                   $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                   $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs->execute();
               }
           }
       }

       $q1 = "INSERT INTO stock_info (gubun, stockName, mainAgent, buyStrength, isImportant, registerDate) VALUES ('s', :stockName, :mainAgent, :buyStrength, 'n', :registerDate)";
       $rs1 = $con->prepare($q1);

       if(count($pf_sell_stockName)){
           for($i1 = 0; $i1 < count($pf_sell_stockName); $i1++){
               $stockName = $pf_sell_stockName[$i1];
               $mainAgent = "pf";
               $sellStrength = $pf_sell_Strength[$i1];

               if($stockName){
                   $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs1->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                   $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs1->execute();
               }
           }
       }

       if(count($p_sell_stockName)){

           for($i1 = 0; $i1 < count($p_sell_stockName); $i1++){
               $stockName = $p_sell_stockName[$i1];
               $mainAgent = "p";
               $sellStrength = $p_sell_Strength[$i1];

               if($stockName){
                   $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs1->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                   $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs1->execute();
               }
           }
       }

       if(count($i_sell_stockName)){

           for($i1 = 0; $i1 < count($i_sell_stockName); $i1++){
               $stockName = $i_sell_stockName[$i1];
               $mainAgent = "i";
               $sellStrength = $i_sell_Strength[$i1];

               if($stockName){
                   $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs1->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                   $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs1->execute();
               }
           }
       }

       if(count($f_sell_stockName)){

           for($i1 = 0; $i1 < count($f_sell_stockName); $i1++){
               $stockName = $f_sell_stockName[$i1];
               $mainAgent = "f";
               $sellStrength = $f_sell_Strength[$i1];

               if($stockName){
                   $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                   $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                   $rs1->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                   $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                   $rs1->execute();
               }
           }
       }

       $con->commit();

       echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
       exit;

   } catch (PDOException $e) {
       $con->rollBack();

       echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0]));
       exit;
    }
} else if($trace == "getList") {
    $sWhere = "";

    if ($searchKey && $searchKeyword) {
        if ($searchKey == "A") {
            $sWhere .= " AND a.stockName LIKE :searchKeyword ";
        } else if ($searchKey == "B") {
            $sWhere .= " AND a.mainAgent LIKE :searchKeyword ";
        }
    }

    $q = "SELECT registerDate FROM stock_info a WHERE gubun = 'b' AND mainAgent = 'pf' ORDER BY registerDate DESC LIMIT 1";
    $rs = $con->prepare($q);
    $rs->execute();
    $count = $rs->rowCount();
    $row = $rs->fetch();

    $registerDate = isset($_REQUEST['searchDate']) && $_REQUEST['searchDate'] ? $_REQUEST['searchDate'] : $row['registerDate'];
    //ePrint($registerDate);


    $q1 = "SELECT a.* 
            , CASE WHEN (SELECT count(*) FROM stock_info WHERE gubun = 'b' AND registerDate = a.registerDate AND stockName = a.stockName) > 1 THEN (SELECT count(*) FROM stock_info WHERE gubun = 'b' AND registerDate = a.registerDate AND stockName = a.stockName)
                   ELSE '' END buyCount
            , (SELECT COUNT(*) FROM stock_info WHERE gubun = 'b' AND stockName = a.stockName AND mainAgent = a.mainAgent AND registerDate BETWEEN DATE_ADD(a.registerDate,INTERVAL -8 DAY ) AND DATE_ADD(a.registerDate,INTERVAL -1 DAY )) mainAgentCount
            , (SELECT COUNT(*) FROM `unlock` WHERE stock = a.stockName AND interViewDate >= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL -30 DAY ) ) unlockCount
            FROM stock_info a 
            WHERE  a.gubun = 'b' AND a.registerDate = :registerDate ORDER BY a.mainAgent ASC, a.buyStrength DESC, a.isImportant asc";
    $rs1 = $con->prepare($q1);
    $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
    if ($searchKey && $searchKeyword) {
        $rs1->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs1->execute();
    $count1 = $rs1->rowCount();
    $LISTRS1 = $rs1->fetchAll();

    $oldMainAgent = "";
    $appendHtml = "";

    $dataResult = array();

    if ($count1) {
        foreach ($LISTRS1 as $row1) {
            if ($oldMainAgent != $row1['mainAgent']) {
                if ($oldMainAgent) {
                    $dataResult[] = array('mainAgent' => $oldMainAgent, 'appendHtml' => $appendHtml);
                    $appendHtml = "";

                }
            }

            $starMark = $row1['mainAgentCount'] > 0 ? stickerStar($row1['mainAgentCount']) : "";

            $backGround = $row1['isImportant'] == "y" ? " style='background-color:#d6d133;color:white'" : "";
            $buyCount = $row1['buyCount'] ? " (" . $row1['buyCount'] . ")" : "";

            $unlockCount = $row1['unlockCount'] > 0 ? "<span style='color:red'>✪</span> " : "";

            $appendHtml .= "<tr><td class='center' " . $backGround . "><a href='indexView.php?stockName=" . $row1['stockName'] . "'>" . $unlockCount. $row1['stockName'] . " " . $starMark . $buyCount . "</a></td>";
            $appendHtml .= "<td class='center'>" . $row1['buyStrength'] . "</td>";

            $oldMainAgent = $row1['mainAgent'];
        }
        $dataResult[] = array('mainAgent' => $oldMainAgent, 'appendHtml' => $appendHtml);
    }

    $q2 = "SELECT a.* 
            , CASE WHEN (SELECT count(*) FROM stock_info WHERE gubun = 's' AND registerDate = a.registerDate AND stockName = a.stockName) > 1 THEN (SELECT count(*) FROM stock_info WHERE gubun = 's' AND registerDate = a.registerDate AND stockName = a.stockName)
                   ELSE '' END sellCount
            , (SELECT COUNT(*) FROM stock_info WHERE gubun = 's' AND stockName = a.stockName AND mainAgent = a.mainAgent AND registerDate BETWEEN DATE_ADD(a.registerDate,INTERVAL -8 DAY ) AND DATE_ADD(a.registerDate,INTERVAL -1 DAY )) mainAgentCount
            , (SELECT COUNT(*) FROM `unlock` WHERE stock = a.stockName AND interViewDate >= DATE_ADD(DATE_FORMAT(NOW(), '%Y-%m-%d'),INTERVAL -30 DAY ) ) unlockCount
            FROM stock_info a 
            WHERE  a.gubun = 's' AND a.registerDate = :registerDate ORDER BY a.mainAgent ASC, a.buyStrength ASC";
    $rs2 = $con->prepare($q2);
    $rs2->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
    if ($searchKey && $searchKeyword) {
        $rs2->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $oldMainAgent = "";
    $appendHtml = "";

    $sellDataResult = array();

    if ($count2) {
        foreach ($LISTRS2 as $row2) {
            if ($oldMainAgent != $row2['mainAgent']) {
                if ($oldMainAgent) {
                    $sellDataResult[] = array('mainAgent' => $oldMainAgent, 'appendHtml' => $appendHtml);
                    $appendHtml = "";

                }
            }

            $starMark = $row2['mainAgentCount'] > 0 ? stickerStar($row2['mainAgentCount']) : "";

            $backGround = $row2['isImportant'] == "y" ? " style='background-color:#d6d133;color:white'" : "";
            $buyCount = $row2['sellCount'] ? " (" . $row2['sellCount'] . ")" : "";

            $unlockCount = $row1['unlockCount'] > 0 ? "<span style='color:red'>✪</span> " : "";

            $appendHtml .= "<tr><td class='center' " . $backGround . "><a href='indexView.php?stockName=" . $row1['stockName'] . "'>" . $unlockCount. $row2['stockName'] . " " . $starMark . $sellCount . "</a></td>";
            $appendHtml .= "<td class='center'>" . $row2['buyStrength'] . "</td>";

            $oldMainAgent = $row2['mainAgent'];
        }
        $sellDataResult[] = array('mainAgent' => $oldMainAgent, 'appendHtml' => $appendHtml);
    }

    echo json_encode(array('data' => $dataResult, 'registerDate' => $registerDate, 'sellData'=>$sellDataResult));
    exit;
} else if($trace == "updateForm") {

    try {

        $registerDate = isset($_REQUEST['registerDate']) && $_REQUEST['registerDate'] ? $_REQUEST['registerDate'] : DATE("Y-m-d");

        $con->beginTransaction();

        $q = "INSERT INTO stock_info (gubun, stockName, mainAgent, buyStrength, isImportant, registerDate) VALUES ('b', :stockName, :mainAgent, :buyStrength, :isImportant, :registerDate)";
        $rs = $con->prepare($q);

        $q1 = "UPDATE stock_info SET stockName = :stockName, mainAgent = :mainAgent, buyStrength = :buyStrength, isImportant = :isImportant, registerDate = :registerDate WHERE idx = :idx";
        $rs1 = $con->prepare($q1);

        if(count($pf_stockName)){
            for($i1 = 0; $i1 < count($pf_stockName); $i1++){
                $stockName = $pf_stockName[$i1];
                $mainAgent = "pf";
                $buyStrength = $pf_buyStrength[$i1];
                $isImportant = $pf_isImportant[$i1];
                $idx = $pf_idx[$i1];


                if($stockName){
                    if($idx){
                        $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs1->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs1->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs1->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs1->execute();
                    } else {
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs->execute();
                    }

                }
            }
        }

        if(count($p_stockName)){

            for($i1 = 0; $i1 < count($p_stockName); $i1++){
                $stockName = $p_stockName[$i1];
                $mainAgent = "p";
                $buyStrength = $p_buyStrength[$i1];
                $isImportant = $p_isImportant[$i1];
                $idx = $p_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs1->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs1->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs1->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs1->execute();
                    } else {
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs->execute();
                    }

                }
            }
        }

        if(count($i_stockName)){

            for($i1 = 0; $i1 < count($i_stockName); $i1++){
                $stockName = $i_stockName[$i1];
                $mainAgent = "i";
                $buyStrength = $i_buyStrength[$i1];
                $isImportant = $i_isImportant[$i1];
                $idx = $i_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs1->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs1->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs1->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs1->execute();
                    } else {
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs->execute();
                    }

                }
            }
        }

        if(count($f_stockName)){

            for($i1 = 0; $i1 < count($f_stockName); $i1++){
                $stockName = $f_stockName[$i1];
                $mainAgent = "f";
                $buyStrength = $f_buyStrength[$i1];
                $isImportant = $f_isImportant[$i1];
                $idx = $f_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs1->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs1->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs1->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs1->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs1->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs1->execute();
                    } else {
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs->bindValue(':buyStrength', $buyStrength, PDO::PARAM_STR);
                        $rs->bindValue(':isImportant', $isImportant, PDO::PARAM_STR);
                        $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs->execute();
                    }

                }
            }
        }

        $q2 = "INSERT INTO stock_info (gubun, stockName, mainAgent, buyStrength, isImportant, registerDate) VALUES ('s', :stockName, :mainAgent, :buyStrength, 'n', :registerDate)";
        $rs2 = $con->prepare($q2);

        $q3 = "UPDATE stock_info SET stockName = :stockName, mainAgent = :mainAgent, buyStrength = :buyStrength, registerDate = :registerDate WHERE idx = :idx";
        $rs3 = $con->prepare($q3);

        if(count($pf_sell_stockName)){
            for($i1 = 0; $i1 < count($pf_sell_stockName); $i1++){
                $stockName = $pf_sell_stockName[$i1];
                $mainAgent = "pf";
                $sellStrength = $pf_sell_Strength[$i1];
                $idx = $pf_sell_idx[$i1];


                if($stockName){
                    if($idx){
                        $rs3->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs3->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs3->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs3->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs3->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs3->execute();
                    } else {
                        $rs2->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs2->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs2->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs2->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs2->execute();
                    }

                }
            }
        }

        if(count($p_sell_stockName)){

            for($i1 = 0; $i1 < count($p_sell_stockName); $i1++){
                $stockName = $p_sell_stockName[$i1];
                $mainAgent = "p";
                $sellStrength = $p_sell_Strength[$i1];
                $idx = $p_sell_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs3->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs3->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs3->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs3->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs3->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs3->execute();
                    } else {
                        $rs2->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs2->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs2->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs2->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs2->execute();
                    }

                }
            }
        }

        if(count($i_sell_stockName)){

            for($i1 = 0; $i1 < count($i_sell_stockName); $i1++){
                $stockName = $i_sell_stockName[$i1];
                $mainAgent = "i";
                $sellStrength = $i_sell_Strength[$i1];
                $idx = $i_sell_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs3->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs3->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs3->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs3->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs3->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs3->execute();
                    } else {
                        $rs2->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs2->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs2->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs2->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs2->execute();
                    }

                }
            }
        }

        if(count($f_sell_stockName)){

            for($i1 = 0; $i1 < count($f_sell_stockName); $i1++){
                $stockName = $f_sell_stockName[$i1];
                $mainAgent = "f";
                $sellStrength = $f_sell_Strength[$i1];
                $idx = $f_sell_idx[$i1];

                if($stockName){
                    if($idx){
                        $rs3->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs3->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs3->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs3->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs3->bindValue(':idx', $idx, PDO::PARAM_INT);
                        $rs3->execute();
                    } else {
                        $rs2->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs2->bindValue(':mainAgent', $mainAgent, PDO::PARAM_STR);
                        $rs2->bindValue(':buyStrength', $sellStrength, PDO::PARAM_STR);
                        $rs2->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
                        $rs2->execute();
                    }

                }
            }
        }

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0]));
        exit;
    }

}