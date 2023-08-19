<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

if(!$idx){
    cAlertBack(ERRORMESSGE[1]);
}

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";

$q = "SELECT * FROM `unlock` WHERE idx = :idx";
$rs = $con->prepare($q);
$rs->bindValue(':idx', $idx, PDO::PARAM_INT);
$rs->execute();
$row = $rs->fetch();


?>

    <input type="hidden" name="idx" id="idx" value="<?php echo $idx?>">
    <div class="headingArea">
        <div class="mTitle">
            <h1>잠금해제 보기</h1>
        </div>
    </div>

    <div class="section" id="">
        <div class="optionArea">
            <div class="mOption">
                <table border="1">
                    <colgroup>
                        <col style="width:15%">
                        <col style="width:35%">
                        <col style="width:15%">
                        <col style="width:35%">
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row">종목명 </th>
                        <td><?php echo $row['stock']?></td>
                        <th scope="row">담당자 </th>
                        <td><?php echo $row['gubun']?></td>
                    </tr>
                    <tr>
                        <th scope="row">발행일</th>
                        <td colspan="3"><?php echo $row['interViewDate']?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table border="1">
                                <colgroup>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                </colgroup>
                                <tr>
                                    <th scope="row">현재가 </th>
                                    <td><?php echo number_format($row['currentPrice'])?></td>
                                    <th scope="row">목표가 </th>
                                    <td><?php echo number_format($row['targetPrice'])?></td>
                                    <th scope="row">손절가 </th>
                                    <td><?php echo number_format($row['lossCutPrice'])?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">요약 </th>
                        <td colspan="3" style="color: red"><textarea name="summary" id="summary" style="width:90%;height:400px" class="fText"><?php echo $row['summary']?></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">달성여부 </th>
                        <td style="color: red">
                            <?php echo ftnMakeSelectValue('successYN', 'y,n,c', '달성,진행중,손절', '',$row['successYN'], '', 'fSelect')?>
                            <input type="text" name="successDate" id="successDate" class="fText gDate datetime">
                        </td>
                        <th scope="row">매수여부 </th>
                        <td style="color: red">
                            <?php echo ftnMakeSelectValue('buyYN', 'y,n', '매수,매수안함', '',$row['buyYN'], '', 'fSelect')?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="mButton gCenter">
        <a href="javascript:setState()" class="btnSubmit"><span>상태수정</span></a> <a href="indexUpdate.php?idx=<?php echo $idx?>" class="btnSubmit"><span>수정</span></a> <a href="index.php" class="btnEm btnPreview"><span>목록</span></a>
    </div>


<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/unlock/indexView_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>