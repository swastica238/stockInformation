<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


$q = "SELECT * FROM stock_info 
        WHERE stockName = :stockName AND mainAgent = :mainAgent AND DATE(registerDate) > DATE(SUBDATE(NOW(), INTERVAL 6 MONTH)) 
ORDER BY registerDate DESC";

?>
<div class="headingArea">
    <div class="mTitle">
        <h1>종목정보 조회 - <?php echo $stockName?></h1>
    </div>
</div>

<div class="section" id="">
    <div class="mTitle">
        <h2>매수 현황</h2>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <a href="javascript:addMemo()" class="btnNormal">
                <span>메모등록<em class="icoLin"></em></span>
            </a>
        </div>
    </div>

    <div class="mBoard gScroll gCellNarrow typeList">
        <table border="1">
            <colgroup>
                <col style="">
                <col style="">
                <col style="">
                <col style="">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">사모펀드</th>
                <th scope="col">연기금</th>
                <th scope="col">투신</th>
                <th scope="col">외국인</th>
            </tr>
            </thead>
            <tbody class='center'>
            <tr>
                <td>
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">매수일자</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * FROM stock_info 
                                        WHERE stockName = :stockName AND mainAgent = :mainAgent AND DATE(registerDate) > DATE(SUBDATE(NOW(), INTERVAL 6 MONTH)) 
                                ORDER BY registerDate DESC";
                        $rs = $con->prepare($q);
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', "pf", PDO::PARAM_STR);
                        $rs->execute();
                        $count = $rs->rowCount();
                        $LISTRS = $rs->fetchAll();

                        if($count){
                            foreach ($LISTRS as $row){
                                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;'" : "";
                                echo ("<tr><td class='center' ".$backGround.">".$row['registerDate']."</td><td>".$row['buyStrength']."</td> </tr>");
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">매수일자</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * FROM stock_info 
                                        WHERE stockName = :stockName AND mainAgent = :mainAgent AND DATE(registerDate) > DATE(SUBDATE(NOW(), INTERVAL 6 MONTH)) 
                                ORDER BY registerDate DESC";
                        $rs = $con->prepare($q);
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', "p", PDO::PARAM_STR);
                        $rs->execute();
                        $count = $rs->rowCount();
                        $LISTRS = $rs->fetchAll();

                        if($count){
                            foreach ($LISTRS as $row){
                                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;'" : "";
                                echo ("<tr><td class='center' ".$backGround.">".$row['registerDate']."</td><td>".$row['buyStrength']."</td> </tr>");
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">매수일자</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * FROM stock_info 
                                        WHERE stockName = :stockName AND mainAgent = :mainAgent AND DATE(registerDate) > DATE(SUBDATE(NOW(), INTERVAL 6 MONTH)) 
                                ORDER BY registerDate DESC";
                        $rs = $con->prepare($q);
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', "i", PDO::PARAM_STR);
                        $rs->execute();
                        $count = $rs->rowCount();
                        $LISTRS = $rs->fetchAll();

                        if($count){
                            foreach ($LISTRS as $row){
                                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;'" : "";
                                echo ("<tr><td class='center' ".$backGround.">".$row['registerDate']."</td><td>".$row['buyStrength']."</td> </tr>");
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">매수일자</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody>
                        <?php
                        $q = "SELECT * FROM stock_info 
                                        WHERE stockName = :stockName AND mainAgent = :mainAgent AND DATE(registerDate) > DATE(SUBDATE(NOW(), INTERVAL 6 MONTH)) 
                                ORDER BY registerDate DESC";
                        $rs = $con->prepare($q);
                        $rs->bindValue(':stockName', $stockName, PDO::PARAM_STR);
                        $rs->bindValue(':mainAgent', "f", PDO::PARAM_STR);
                        $rs->execute();
                        $count = $rs->rowCount();
                        $LISTRS = $rs->fetchAll();

                        if($count){
                            foreach ($LISTRS as $row){
                                $backGround = $row['isImportant'] == "y" ? " style='background-color:#d6d133;'" : "";
                                echo ("<tr><td class='center' ".$backGround.">".$row['registerDate']."</td><td>".$row['buyStrength']."</td> </tr>");
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="mCtrl typeFooter"></div>


</div>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/stockinfo/indexView_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
