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
        <h1>보유종목 조회</h1>
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
        <h2>종목 목록</h2>
    </div>

    <div class="mState">
        <div class="gLeft">
            <p class="total">
                검색결과 <strong id="searchMemCount">0</strong> 건
            </p>
        </div>
        <div class="gRight">
            <?php echo ftnMakeSelectValue('listViewCount', '10, 20, 30, 50, 100', '10개씩보기, 20개씩보기, 30개씩보기, 50개씩보기, 100개씩보기','','30', 'getList()', 'fSelect');?>
        </div>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <a href="indexWrite.php" class="btnNormal">
                <span>종목등록<em class="icoLin"></em></span>
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
                <col style="">
                <col style="">
                <col style="">
                <col style="">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" rowspan="2">종목명</th>
                <th scope="col" rowspan="2">진입일</th>
                <th scope="col">매수총금액</th>
                <th scope="col" rowspan="2">보유주수</th>
                <th scope="col" rowspan="2">평균단가</th>
                <th scope="col" rowspan="2">매수횟수</th>
                <th scope="col" rowspan="2">목표가</th>
                <th scope="col" rowspan="2">손절가</th>
                <th scope="col" rowspan="2">보유여부</th>
            </tr>
            <tr>
                <th scope="col" id="sumTotalMoney"></th>
            </tr>
            </thead>
            <tbody id="resultList">

            </tbody>
        </table>
        <p class="empty">검색된 내역이 없습니다.</p>
    </div>
    <div class="mCtrl typeFooter"></div>
    <div class="mPaginate" id="resultPage">

    </div>

</div>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/buyinfo/index_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
