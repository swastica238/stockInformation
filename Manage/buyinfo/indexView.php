<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";

$q = "SELECT a.*
        , (SELECT COUNT(*) FROM buy_info_list WHERE buyIdx = a.idx) buyCount
        , (SELECT SUM(price*quantity) FROM buy_info_list WHERE buyIdx = a.idx) buyTotalMoney
        , (SELECT SUM(price*quantity) / SUM(quantity) FROM buy_info_list WHERE buyIdx = a.idx) avgPrice
        , (SELECT SUM(quantity) FROM buy_info_list WHERE buyIdx = a.idx) totalQuantity
        , (SELECT registerDate FROM buy_info_list WHERE buyIdx = a.idx order by registerDate DESC limit 1) lastDay
        FROM buy_info a WHERE a.idx = :idx";
$rs = $con->prepare($q);
$rs->bindValue(':idx', $idx, PDO::PARAM_INT);
$rs->execute();
$row = $rs->fetch();

$isSell = $row['isSell'] == "n" ? "보유" : "매도";

$targetRate = 1.1 + ($row['buyCount']/100);
$loseRate = 0.9 + ($row['buyCount']/100);

$diffDay = date_diff(new DateTime($row['registerDate']), new DateTime($row['lastDay']))->days;

$avgPrice = number_format($row['avgPrice']);
$totalQuantity = number_format($row['totalQuantity']);
$buyTotalMoney = $row['totalQuantity'] == 0 ? 0 : number_format($row['buyTotalMoney']);

$q2 = "SELECT * FROM `unlock` WHERE stock = :stock AND successYN = 'n' ORDER BY idx DESC limit 1";
$rs2 = $con->prepare($q2);
$rs2->bindValue(':stock', $row['stockName'], PDO::PARAM_STR);
$rs2->execute();
$count2 = $rs2->rowCount();
$row2 = $rs2->fetch();

$appendHtml = "";

if($count2){
    $appendHtml = "<table border='1'>
                    <colgroup>
                    <col><col><col><col><col>
                    </colgroup>
                    <tr>
                        <th scope='row' style='text-align: center'>전문가</th><th scope='row' style='text-align: center'>매수가</th><th scope='row' style='text-align: center'>목표가</th><th scope='row' style='text-align: center'>손절가</th><th scope='row' style='text-align: center'>방영일</th>
                    </tr>
                    <tr>
                        <td style='text-align: center'>".$row2['gubun']."</td>
                        <td style='text-align: center'>".number_format($row2['currentPrice'])."</td>
                        <td style='text-align: center'><span style='color:orange;font-weight: bold'>".number_format($row2['targetPrice'])."</span></td>
                        <td style='text-align: center'>".number_format($row2['lossCutPrice'])."</td>
                        <td style='text-align: center'>".$row2['interViewDate']."</td>
                    </tr>     
                    <tr>
                    <td colspan='5'>".nl2br($row2['summary'])."</td>   
                    </tr>
                    </table>";
}

?>
    <input type="hidden" name="idx" id="idx" value="<?php echo $idx?>">

    <div class="headingArea">
        <div class="mTitle">
            <h1><?php echo $row['stockName']." (".$isSell.")"?></h1>

            <span style="float: right;margin-right: 10px"><a href="javascript:addSell()" class="btnNormal"><span style="color: blue">매도등록<em class="icoLin"></em></span></a></span>
            <span style="float: right;margin-right: 10px"><a href="javascript:addBuy()" class="btnNormal"><span>매수등록<em class="icoLin"></em></span></a></span>
        </div>
    </div>

    <div class="section" id="">
        <div class="optionArea">
            <div class="mOption">
                <table border="1">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">매수이유</th>
                        <td colspan="3"><?php echo nl2br($row['buyReason'])?></td>
                    </tr>
                    <tr>
                        <th scope="row">평균단가 (보유수량) / 총 매수금 / 총 예수금 / 매수비율</th>
                        <td><?php echo "<span style='color:orange;font-weight: bold'>".$avgPrice."원 (".$totalQuantity.")</span> / ".$buyTotalMoney."원 / ".number_format($row['totalBuyMoney'])."원 / <span style='color:green'>".number_format(($buyTotalMoney / $row['totalBuyMoney']) * 100,2)." %</span>"?>  </td>
                        <th scope="row">목표가 : 수익금액 / 손절가 : 손실금액</th>
                        <td><?php echo "<span style='color:red'>".number_format($row['avgPrice'] * $targetRate)."원 : ".number_format((($row['avgPrice'] * $row['totalQuantity'] * $targetRate * 0.998) - $row['buyTotalMoney']))."원</span> / <span style='color:blue'>".number_format($row['avgPrice'] * $loseRate)." : ".number_format(($row['buyTotalMoney'] - (($row['avgPrice'] * $row['totalQuantity'] * $loseRate))))."원</span>"?></td>
                    </tr>
                    <tr>
                        <th scope="row">진일입 / 경과일</th>
                        <td colspan="3"><?php echo $row['registerDate']." / ".$diffDay."일"?></td>
                    </tr>
                    </tbody>
                </table>
                <?php echo $appendHtml?>
            </div>
        </div>
    </div>

    <div class="section" id="">
        <div class="optionArea">
            <div class="mOption">
                <table border="1">
                    <colgroup>
                        <col style="width:50%">
                        <col style="width:50%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row" style="text-align: center">매수 플랜</th>
                        <th scope="row" style="text-align: center">매수 실행</th>
                    </tr>
                    <tr>
                        <td>
                            <table border="1">
                                <colgroup>
                                    <col style="width:80px">
                                    <col style="">
                                    <col style="">
                                    <col style="">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th scope="row" style='text-align: center'>No</th>
                                        <th scope="row" style='text-align: center'>매수금액</th>
                                        <th scope="row" style='text-align: center'>매수수량</th>
                                        <th scope="row" style='text-align: center'>총금액</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    calBuyPlan($row['planType'], $row['startPrice'], $row['totalBuyMoney']);
                                ?>
                                </tbody>
                            </table>
                        </td>
                        <td style="vertical-align: top">
                            <table border="1">
                                <colgroup>
                                    <col style="width:80px">
                                    <col style="">
                                    <col style="">
                                    <col style="">
                                    <col style="">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th scope="row" style='text-align: center'>No</th>
                                    <th scope="row" style='text-align: center'>매수일자</th>
                                    <th scope="row" style='text-align: center'>매수금액</th>
                                    <th scope="row" style='text-align: center'>매수수량</th>
                                    <th scope="row" style='text-align: center'>총금액</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $q1 = "SELECT * FROM buy_info_list WHERE buyIdx = :buyIdx ORDER BY registerDate ASC";
                                    $rs1 = $con->prepare($q1);
                                    $rs1->bindValue(':buyIdx', $idx, PDO::PARAM_INT);
                                    $rs1->execute();
                                    $count1 = $rs1->rowCount();
                                    $LISTRS1 = $rs1->fetchAll();

                                    if($count1){
                                        $i1 = 1;
                                        foreach ($LISTRS1 as $row1){
                                            echo ("<tr>
                                                <td style='text-align: center'>".$i1."</td>
                                                 <td style='text-align: center'>".$row1['registerDate']."</td>
                                                 <td style='text-align: center'>".number_format($row1['price'])."</td>
                                                 <td style='text-align: center'>".number_format($row1['quantity'])."</td>
                                                 <td style='text-align: center'>".number_format($row1['price'] * $row1['quantity'])."</td>
                                                </tr>");
                                            $i1++;
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
        </div>
    </div>


<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/buyinfo/indexView_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>