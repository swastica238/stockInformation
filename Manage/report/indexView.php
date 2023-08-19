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

$q = "SELECT * FROM report WHERE idx = :idx";
$rs = $con->prepare($q);
$rs->bindValue(':idx', $idx, PDO::PARAM_INT);
$rs->execute();
$row = $rs->fetch();

?>


    <div class="headingArea">
        <div class="mTitle">
            <h1>리포트 보기</h1>
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
                        <th scope="row">분류 </th>
                        <td><?php echo $row['category']?></td>
                        <th scope="row">발행사 </th>
                        <td><?php echo $row['issue_entity']?></td>
                    </tr>
                    <tr>
                        <th scope="row">발행일</th>
                        <td colspan="3"><?php echo $row['registerDate']?></td>
                    </tr>
                    <tr>
                        <th scope="row">제목 </th>
                        <td colspan="3"><?php echo $row['title']?></td>
                    </tr>
                    <tr>
                        <th scope="row">추천주 </th>
                        <td colspan="3" style="color: red"><?php echo $row['recommendStock']?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?php echo $row['contents']?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="mButton gCenter">
        <a href="indexUpdate.php?idx=<?php echo $idx?>" class="btnSubmit"><span>수정</span></a> <a href="index.php" class="btnEm btnPreview"><span>목록</span></a>
    </div>


<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/report/indexView_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>