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
            <h1>매수 종목 등록</h1>
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
                        <th scope="row">종목명 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <input type="text" name="stockName" id="stockName" class="fText">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">총예수금 <strong class='icoRequired'>필수</strong></th>
                        <td >
                            <input type="text" name="totalBuyMoney" id="totalBuyMoney" class="fText">
                        </td>
                        <th scope="row">매수타입 <strong class='icoRequired'>필수</strong></th>
                        <td >
                            <?php echo ftnMakeSelectValue('planType', 'A,B,C','A,B,C','매수유형','','','fSelect')?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">매수 이유 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3"><textarea name="buyReason" id="buyReason" style="width:90%;height:400px" class="fText"></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">매수단가 <strong class='icoequired'>필수</strong></th>
                        <td><input type="text" name="price" id="price" class="fText"></td>
                        <th scope="row">매수수량 <strong class='icoequired'>필수</strong></th>
                        <td><input type="text" name="quantity" id="quantity" class="fText"></td>
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/buyinfo/indexWrite_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>