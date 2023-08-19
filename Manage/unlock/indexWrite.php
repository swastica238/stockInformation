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
            <h1>잠금해제 등록</h1>
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
                        <th scope="row">담당자 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <input type="text" name="gubun" id="gubun" class="fText">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">종목명 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <select name="type" id="type" class="fSelect"></select> <input type="text" name="stock" id="stock" class="fText">
                        </td>
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
                                <tbody>
                                <tr>
                                    <th scope="row">현재가 <strong class='icoequired'>필수</strong></th>
                                    <td >
                                        <input type="text" name="currentPrice" id="currentPrice" class="fText">
                                    </td>
                                    <th scope="row">목표가 <strong class='icoequired'>필수</strong></th>
                                    <td >
                                        <input type="text" name="targetPrice" id="targetPrice" class="fText">
                                    </td>
                                    <th scope="row">손절가 <strong class='icoequired'>필수</strong></th>
                                    <td >
                                        <input type="text" name="lossCutPrice" id="lossCutPrice" class="fText">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">종목 설명 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3"><textarea name="summary" id="summary" style="width:90%;height:400px" class="fText"></textarea></td>
                    </tr>
                    <tr>
                        <th scope="row">일자 <strong class='icoequired'>필수</strong></th>
                        <td colspan="3">
                            <input type="text" name="interViewDate" id="interViewDate" class="fText gDate datetime">
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/unlock/indexWrite_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>