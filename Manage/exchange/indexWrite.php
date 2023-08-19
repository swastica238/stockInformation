<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";

?>


    <div class="headingArea">
        <div class="mTitle">
            <h1>환전 등록</h1>
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
                        <th scope="row">타입 <strong class='icoRequired'>필수</strong></th>
                        <td >
                            <?php echo ftnMakeSelectValue('exchangeType', 'b,s','원->달러,달러->원','타입','','','fSelect')?>
                        </td>
                        <th scope="row">적용환율 <strong class='icoequired'>필수</strong></th>
                        <td>
                            <input type="text" name="exchangeRate" id="exchangeRate" class="fText">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">원 <strong class='icoRequired'>필수</strong></th>
                        <td >
                            <input type="text" name="koreaMoney" id="koreaMoney" class="fText">
                        </td>
                        <th scope="row">달러 <strong class='icoRequired'>필수</strong></th>
                        <td >
                            <input type="text" name="dollarMoney" id="dollarMoney" class="fText">
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/exchange/indexWrite_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>