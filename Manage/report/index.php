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
        <h1>리포트 조회</h1>
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
                        <?php echo ftnMakeSelectValue('searchKey', 'A,B,C', '분류,제목,발행사','선택','', 'getList()', 'fSelect');?>
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
        <h2>리포트 목록</h2>
    </div>

    <div class="mState">
        <div class="gLeft">
            <p class="total">
                검색결과 <strong id="searchMemCount">0</strong> 건
            </p>
        </div>
        <div class="gRight">
            <?php echo ftnMakeSelectValue('listViewCount', '10, 20, 30, 50, 100', '10개씩보기, 20개씩보기, 30개씩보기, 50개씩보기, 100개씩보기','','10', 'df_sch()', 'fSelect');?>
        </div>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <a href="indexWrite.php" class="btnNormal">
                <span>리포트등록<em class="icoLin"></em></span>
            </a>
        </div>
    </div>

    <div class="mBoard gScroll gCellNarrow typeList">
        <table border="1">
            <colgroup>
                <col style="width:10%">
                <col style="width:10%">
                <col style="">
                <col style="">
                <col style="width:10%">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">분류</th>
                <th scope="col">발행사</th>
                <th scope="col">제목</th>
                <th scope="col">추천주</th>
                <th scope="col">등록일</th>
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/report/index_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
