<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


?>

<input type="hidden" name="registerDate" id="registerDate">
<div class="headingArea">
    <div class="mTitle">
        <h1>수급정보 조회</h1>
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
                    <td>
                        <?php echo ftnMakeSelectValue('searchKey', 'A,B', '매수주체,종목명','선택','', '', 'fSelect');?>
                        <input type="text" name="searchKeyword" id="searchKeyword" style="width:130px" class="fText">
                    </td>
                    <th scope="row">일자</th>
                    <td>
                        <input type="text" name="searchDate" id="searchDate" style="width:130px" class="fText gDate datetime">
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
        <h2>매수 목록 <span id="stockDate"></span></h2>
    </div>

    <div class="mCtrl typeHeader">
        <div class="gRight">
            <a href="indexWrite.php" class="btnNormal">
                <span>종목등록<em class="icoLin"></em></span>
            </a>
            <a href="javascript:goLink()" class="btnNormal">
                <span>종목수정<em class="icoLin"></em></span>
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
            </colgroup>
            <thead>
            <tr>
                <th scope="col">사모펀드</th>
                <th scope="col">연기금</th>
                <th scope="col">투신</th>
                <th scope="col">외국인</th>
            </tr>
            </thead>
            <tbody class='center'>
                <tr>
                    <td>
                        <table border="1">
                            <colgroup>
                                <col style="width: 70%">
                                <col style="">
                            </colgroup>
                            <thead>
                                <th scope="col">종목명</th>
                                <th scope="col">매수강도</th>
                            </thead>
                            <tbody id="privateFund">

                            </tbody>
                        </table>
                    </td>
                    <td id="">
                        <table border="1">
                            <colgroup>
                                <col style="width: 70%">
                                <col style="">
                            </colgroup>
                            <thead>
                            <th scope="col">종목명</th>
                            <th scope="col">매수강도</th>
                            </thead>
                            <tbody id="pension">

                            </tbody>
                        </table>
                    </td>
                    <td id="">
                        <table border="1">
                            <colgroup>
                                <col style="width: 70%">
                                <col style="">
                            </colgroup>
                            <thead>
                            <th scope="col">종목명</th>
                            <th scope="col">매수강도</th>
                            </thead>
                            <tbody id="investmemntTrust">

                            </tbody>
                        </table>
                    </td>
                    <td id="">
                        <table border="1">
                            <colgroup>
                                <col style="width: 70%">
                                <col style="">
                            </colgroup>
                            <thead>
                            <th scope="col">종목명</th>
                            <th scope="col">매수강도</th>
                            </thead>
                            <tbody id="foreigner">

                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mCtrl typeFooter"></div>
</div>


<div class="section" id="">
    <div class="mTitle">
        <h2>매도 목록 </h2>
    </div>

    <div class="mBoard gScroll gCellNarrow typeList">
        <table border="1">
            <colgroup>
                <col style="">
                <col style="">
                <col style="">
                <col style="">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">사모펀드</th>
                <th scope="col">연기금</th>
                <th scope="col">투신</th>
                <th scope="col">외국인</th>
            </tr>
            </thead>
            <tbody class='center'>
            <tr>
                <td>
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매도강도</th>
                        </thead>
                        <tbody id="privateFund_sell">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매도강도</th>
                        </thead>
                        <tbody id="pension_sell">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매도강도</th>
                        </thead>
                        <tbody id="investmemntTrust_sell">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="width: 70%">
                            <col style="">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매도강도</th>
                        </thead>
                        <tbody id="foreigner_sell">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="mCtrl typeFooter"></div>
</div>
<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/stockinfo/index_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
