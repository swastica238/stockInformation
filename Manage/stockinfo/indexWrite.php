<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


?>
    <style>
        .mOption th, .mOption td {

            text-align: center;
        }
    </style>

    <div class="headingArea">
        <div class="mTitle">
            <h1>매수종목등록</h1>
        </div>
    </div>

    <div class="section" id="">
        <div class="optionArea">
            <div class="mOption">
                <table border="1">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="row" class="center">등록일</th>
                        <td colspan="3" style="text-align: left"><input type="text" name="registerDate" id="registerDate" value="<?php echo DATE("Y-m-d")?>" class="fText gDate datetime"> </td>

                    </tr>
                    <tr>
                        <th scope="row" class="center">사모펀드</th>
                        <th scope="row" class="center">연기금</th>
                        <th scope="row" class="center">투신</th>
                        <th scope="row" class="center">외국인</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            for($j1 = 1; $j1 <= 4; $j1++){
                                if($j1 == 1){
                                    $prefix = "pf";
                                } else if($j1 == 2){
                                    $prefix = "p";
                                } else if($j1 == 3){
                                    $prefix = "i";
                                } else if($j1 == 4){
                                    $prefix = "f";
                                }

                                echo ("<td>
                                    <table border='1'>
                                        <colgroup>
                                            <col style='width: 10%'>
                                            <col style='width: 50%'>
                                            <col style=''>
                                            <col style=''>
                                        </colgroup>
                                        <thead>
                                        <th scope='col' class='center'>No</th>
                                        <th scope='col' class='center'>종목명</th>
                                        <th scope='col' class='center'>매수강도</th>
                                        <th scope='col' class='center'>체크</th>
                                        </thead>
                                        <tbody>");
                                for($i1 = 1; $i1 <= 30; $i1++){
                                    echo ("<tr>
                                                <td class='center'>".$i1."</td>
                                                <td class='center'><input type='text' name='".$prefix."_stockName[]' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_buyStrength[]' class='fText'></td>
                                                <td class='center'><input type='checkbox' name='".$prefix."_isImportant[]' value='".($i1-1)."'></td>                                                
                                                </tr>");
                                }
                                echo ("</tbody>
                                            </table>
                                        </td>");
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="headingArea">
        <div class="mTitle">
            <h1>매도종목등록</h1>
        </div>
    </div>

    <div class="section" id="">
        <div class="optionArea">
            <div class="mOption">
                <table border="1">
                    <colgroup>
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                        <col style="width:25%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="row" class="center">사모펀드</th>
                        <th scope="row" class="center">연기금</th>
                        <th scope="row" class="center">투신</th>
                        <th scope="row" class="center">외국인</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                        for($j1 = 1; $j1 <= 4; $j1++){
                            if($j1 == 1){
                                $prefix = "pf";
                            } else if($j1 == 2){
                                $prefix = "p";
                            } else if($j1 == 3){
                                $prefix = "i";
                            } else if($j1 == 4){
                                $prefix = "f";
                            }

                            echo ("<td>
                                    <table border='1'>
                                        <colgroup>
                                            <col style='width: 10%'>
                                            <col style='width: 50%'>
                                            <col style=''>                                        
                                        </colgroup>
                                        <thead>
                                        <th scope='col' class='center'>No</th>
                                        <th scope='col' class='center'>종목명</th>
                                        <th scope='col' class='center'>매도강도</th>
                                        
                                        </thead>
                                        <tbody>");
                            for($i1 = 1; $i1 <= 30; $i1++){
                                echo ("<tr>
                                                <td class='center'>".$i1."</td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_stockName[]' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_Strength[]' class='fText'></td>                                                                                                
                                                </tr>");
                            }
                            echo ("</tbody>
                                            </table>
                                        </td>");
                        }
                        ?>
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/stockinfo/indexWrite_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>