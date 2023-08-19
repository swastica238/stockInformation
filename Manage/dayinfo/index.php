<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


?>
<div class="headingArea">
    <div class="mTitle">
        <h1>시장 오픈 일</h1>
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
                    <th scope="row">년월</th>
                    <td colspan="3">
                        <?php echo ftnMakeSelectValue('searchYear', $yearRange, $yearRange, '년도선택','','','fSelect')?> 년
                        <?php echo ftnMakeSelectValue('searchMonth', $monthRange, $monthRange, '월선택','','','fSelect')?> 월
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
        <h2>월별 일자 목록</h2>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <input type="text" name="exceptDay" id="exceptDay" class="fText w350">
            <a href="javascript:minusForm()" class="btnNormal">
                <span>일자제외<em class="icoLin"></em></span>
            </a>
            <input type="text" name="makeDay" id="makeDay" class="fText w150">
            <a href="javascript:saveForm()" class="btnNormal">
                <span>일자생성<em class="icoLin"></em></span>
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
                <col style="">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">일자</th>
                <th scope="col">일자</th>
                <th scope="col">일자</th>
                <th scope="col">일자</th>
                <th scope="col">일자</th>
            </tr>
            </thead>
            <tbody id="resultList">

            </tbody>
        </table>
        <p class="empty">검색된 내역이 없습니다.</p>
    </div>
    <div class="mCtrl typeFooter"></div>

</div>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/dayinfo/index_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
