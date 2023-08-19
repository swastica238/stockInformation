<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


?>

<div class="section" id="">
    <div class="mTitle">
        <h2>금주 매수 순위 </h2>
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
                            <col style="">
                            <col style="">

                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody id="privateFund_week_this">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="">

                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody id="pension_week_this">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="">

                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody id="investmemntTrust_week_this">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="">

                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">매수강도</th>
                        </thead>
                        <tbody id="foreigner_week_this">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<div class="section" id="">
    <div class="mTitle">
        <h2>주간 매수 순위(지난주 기준) </h2>
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
                            <col style="">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 10%">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">0W</th>
                        <th scope="col">-1W</th>
                        <th scope="col">-2W</th>
                        <th scope="col">매도</th>
                        </thead>
                        <tbody id="privateFund_week">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 10%">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">0W</th>
                        <th scope="col">-1W</th>
                        <th scope="col">-2W</th>
                        <th scope="col">매도</th>
                        </thead>
                        <tbody id="pension_week">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 10%">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">0W</th>
                        <th scope="col">-1W</th>
                        <th scope="col">-2W</th>
                        <th scope="col">매도</th>
                        </thead>
                        <tbody id="investmemntTrust_week">

                        </tbody>
                    </table>
                </td>
                <td id="">
                    <table border="1">
                        <colgroup>
                            <col style="">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 15%">
                            <col style="width: 10%">
                        </colgroup>
                        <thead>
                        <th scope="col">종목명</th>
                        <th scope="col">0W</th>
                        <th scope="col">-1W</th>
                        <th scope="col">-2W</th>
                        <th scope="col">매도</th>
                        </thead>
                        <tbody id="foreigner_week">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section" id="">
    <div class="mTitle">
        <h2>신규 매수 <span id="registerDate"></span></h2>
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
                        <tbody id="privateFund_yesterday">

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
                        <tbody id="pension_yesterday">

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
                        <tbody id="investmemntTrust_yesterday">

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
                        <tbody id="foreigner_yesterday">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section" id="">
    <div class="mTitle">
        <h2>연속 매수</h2>
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
                        <th scope="col">매수회수</th>
                        </thead>
                        <tbody id="privateFund_continue">

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
                        <th scope="col">매수회수</th>
                        </thead>
                        <tbody id="pension_continue">

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
                        <th scope="col">매수회수</th>
                        </thead>
                        <tbody id="investmemntTrust_continue">

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
                        <th scope="col">매수회수</th>
                        </thead>
                        <tbody id="foreigner_continue">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="section" id="">
    <div class="mTitle">
        <h2>중복 매수</h2
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
                        <th scope="col">중복회수</th>
                        </thead>
                        <tbody id="privateFund_dup">

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
                        <th scope="col">중복회수</th>
                        </thead>
                        <tbody id="pension_dup">

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
                        <th scope="col">중복회수</th>
                        </thead>
                        <tbody id="investmemntTrust_dup">

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
                        <th scope="col">중복회수</th>
                        </thead>
                        <tbody id="foreigner_dup">

                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
include $_SERVER["DOCUMENT_ROOT"]."/Manage/main_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>
