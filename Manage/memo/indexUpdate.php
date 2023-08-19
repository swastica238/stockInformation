<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";

$q = "SELECT * FROM memo WHERE idx = :idx";
$rs = $con->prepare($q);
$rs->bindValue(':idx', $idx, PDO::PARAM_INT);
$rs->execute();
$row = $rs->fetch();

?>

    <input type="hidden" id="idx" name="idx" value="<?php echo $idx?>">
    <div class="headingArea">
        <div class="mTitle">
            <h1>메모 수정</h1>
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
                        <th scope="row">제목 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <input type="text" name="title" id="title" value="<?php echo $row['title']?>" class="fText w350">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">내용 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <div class="gIcoShop">
                                <div class="overlapTip" style="width:100%">
                                    <div class="se2_addi_btns">
                                        <div class="se2_add_img">
                                            <span><button type="button" class="upbtn" id="se2_add_img"><i></i><span>이미지</span></button></span>
                                            <input type="file" name="Filedata" value="" accept="image/*;capture=camera" id="fileupinp" style="display: none">
                                        </div>
                                    </div>
                                    <textarea name='contents' id='contents' style="width:100%;height:350px"><?php echo $row['contents']?></textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="mButton gCenter">
        <a href="javascript:saveForm()" class="btnSubmit"><span>등록</span></a>
        <a href="index.php" class="btnEm btnPreview"><span>취소</span></a>
    </div>


<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/memo/indexUpdate_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>