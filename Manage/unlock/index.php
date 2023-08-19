<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


?>
<style>
    tbody > tr.checked > td {background:#03c75a;color:#fff}
    tbody > tr.checked > td > a {background:#03c75a;color:#fff}
</style>
<div class="headingArea">
    <div class="mTitle">
        <h1>잠금해제 조회</h1>
    </div>
</div>

<div class="section" id="">
    <div class="optionArea">
        <div class="mOption">
            <table border="1">
                <colgroup>
                    <col style="width:145px;">
                    <col style="width:auto;">
                    <col style="width:145px;">
                    <col style="width:auto;">
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row">검색</th>
                    <td colspan="3">
                        <input type="text" name="searchKeyword" id="searchKeyword" style="width:130px" class="fText">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="mButton gCenter">
            <a href="javascript:getList();" class="btnSearch"><span>검색</span></a>
        </div>
    </div>
</div>

<div class="section" id="">
    <div class="mTitle">
        <h2>잠금해제 목록</h2>
    </div>

    <div class="mState">
        <div class="gLeft">
            <p class="total">
                검색결과 <strong id="searchMemCount">0</strong> 건
            </p>
        </div>
        <div class="gRight">
            <?php echo ftnMakeSelectValue('listViewCount', '10, 20, 30, 50, 100', '10개씩보기, 20개씩보기, 30개씩보기, 50개씩보기, 100개씩보기','','20', 'getList()', 'fSelect');?>
        </div>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <a href="indexWrite.php" class="btnNormal">
                <span>잠금해제 등록<em class="icoLin"></em></span>
            </a>
        </div>
    </div>

    <div class="mBoard gScroll gCellNarrow typeList">
        <table border="1">
            <colgroup>
                <col><col><col>
            </colgroup>
            <thead>
            <tr>
                <th scope="col">잠금해제</th>
                <th scope="col">KB유망주</th>
                <th scope="col">KB추천주</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <table border="1">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                            <th scope="col">일자</th>
                            <th scope="col">전문가</th>
                            <th scope="col">종목</th>
                            <th scope="col">현재가</th>
                            <th scope="col">목표가</th>
                            <th scope="col">손절가</th>
                        </thead>
                        <tbody id='unlockList1'></tbody>
                    </table>
                </td>
                <td>
                    <table border="1">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <th scope="col">일자</th>
                        <th scope="col">전문가</th>
                        <th scope="col">종목</th>
                        <th scope="col">현재가</th>
                        <th scope="col">목표가</th>
                        <th scope="col">손절가</th>
                        </thead>
                        <tbody id='unlockList2'></tbody>
                    </table>
                </td>
                <td>
                    <table border="1">
                        <colgroup>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                            <col>
                        </colgroup>
                        <thead>
                        <th scope="col">일자</th>
                        <th scope="col">전문가</th>
                        <th scope="col">종목</th>
                        <th scope="col">현재가</th>
                        <th scope="col">목표가</th>
                        <th scope="col">손절가</th>
                        </thead>
                        <tbody id='unlockList3'></tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
    <div class="mCtrl typeFooter"></div>
</div>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/unlock/index_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
