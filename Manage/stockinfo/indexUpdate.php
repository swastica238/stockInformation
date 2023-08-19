<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$con = cConnDB();

include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/header.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/leftMenu.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/contentHeader.php";


$q = "SELECT * FROM stock_info WHERE gubun = 'b' AND registerDate = :registerDate ORDER BY 
    FIELD(mainAgent, 'pf', 'p', 'i', 'f'), buyStrength DESC, idx ASC";
$rs = $con->prepare($q);
$rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
$rs->execute();
$count = $rs->rowCount();
$LISTRS = $rs->fetchAll();

$dataSet = array();
$dataStock = array();
$oldMainAgent = "";

if($count){
    foreach ($LISTRS as $row){

        if($oldMainAgent != "" && $oldMainAgent != $row['mainAgent']){
            $dataSet[$oldMainAgent] = $dataStock;
            $dataStock = array();
        }

        $dataStock[] = array('idx'=>$row['idx'], 'stockName'=>$row['stockName'], 'buyStrength'=>$row['buyStrength'], 'isImportant'=>$row['isImportant']);
        $oldMainAgent = $row['mainAgent'];
    }
    $dataSet[$row['mainAgent']] = $dataStock;
}

$q1 = "SELECT * FROM stock_info WHERE gubun = 's' AND registerDate = :registerDate ORDER BY 
    FIELD(mainAgent, 'pf', 'p', 'i', 'f'), buyStrength DESC, idx ASC";
$rs1 = $con->prepare($q1);
$rs1->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
$rs1->execute();
$count1 = $rs1->rowCount();
$LISTRS1 = $rs1->fetchAll();

$dataSellSet = array();
$dataSellStock = array();
$oldMainAgent = "";

if($count1){
    foreach ($LISTRS1 as $row1){

        if($oldMainAgent != "" && $oldMainAgent != $row1['mainAgent']){
            $dataSellSet[$oldMainAgent] = $dataSellStock;
            $dataSellStock = array();
        }

        $dataSellStock[] = array('idx'=>$row1['idx'], 'stockName'=>$row1['stockName'], 'buyStrength'=>$row1['buyStrength'], 'isImportant'=>$row1['isImportant']);
        $oldMainAgent = $row1['mainAgent'];
    }
    $dataSellSet[$row1['mainAgent']] = $dataSellStock;
}

?>
    <style>
        .mOption th, .mOption td {

            text-align: center;
        }
    </style>

    <div class="headingArea">
        <div class="mTitle">
            <h1>매수수정</h1>
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
                        <td colspan="3" style="text-align: left"><input type="text" name="registerDate" id="registerDate" value="<?php echo $registerDate?>" class="fText gDate datetime"> </td>

                    </tr>
                    <tr>
                        <th scope="row" class="center">사모펀드(pf)</th>
                        <th scope="row" class="center">연기금(p)</th>
                        <th scope="row" class="center">투신(i)</th>
                        <th scope="row" class="center">외국인(f)</th>
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
                            $useData = $dataSet[$prefix];

                            echo ("<td style='vertical-align: top'>
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
                            if(count($useData) > 0){
                                for($i1 = 0; $i1 < count($useData); $i1++){
                                    $checked = $useData[$i1]['isImportant'] == "y" ? "checked" : "";
                                    echo ("<tr>
                                                <td class='center'>".($i1+1)."<input type='hidden' name='".$prefix."_idx[]' value='".$useData[$i1]['idx']."'></td>
                                                <td class='center'><input type='text' name='".$prefix."_stockName[]' value='".$useData[$i1]['stockName']."' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_buyStrength[]' value='".$useData[$i1]['buyStrength']."' class='fText'></td>
                                                <td class='center'><input type='checkbox' name='".$prefix."_isImportant[]' value='".$i1."' ".$checked."></td>                                                
                                                </tr>");
                                }

                            } else {
                                for($i1 = 1; $i1 <= 30; $i1++){
                                    echo ("<tr>
                                                <td class='center'>".$i1."<input type='hidden' name='".$prefix."_idx[]' value=''></td>
                                                <td class='center'><input type='text' name='".$prefix."_stockName[]' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_buyStrength[]' class='fText'></td>
                                                <td class='center'><input type='checkbox' name='".$prefix."_isImportant[]' value='".($i1-1)."'></td>                                                
                                                </tr>");
                                }
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


    <div class="headingArea">
        <div class="mTitle">
            <h1>매도수정</h1>
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
                        <th scope="row" class="center">사모펀드(pf)</th>
                        <th scope="row" class="center">연기금(p)</th>
                        <th scope="row" class="center">투신(i)</th>
                        <th scope="row" class="center">외국인(f)</th>
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
                            $useData = $dataSellSet[$prefix];

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
                            if(count($useData) > 0){
                                for($i1 = 0; $i1 < count($useData); $i1++){
                                    echo ("<tr>
                                                <td class='center'>".($i1+1)."<input type='hidden' name='".$prefix."_sell_idx[]' value='".$useData[$i1]['idx']."'></td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_stockName[]' value='".$useData[$i1]['stockName']."' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_Strength[]' value='".$useData[$i1]['buyStrength']."' class='fText'></td>
                                                </tr>");
                                }

                            } else {
                                for($i1 = 1; $i1 <= 20; $i1++){
                                    echo ("<tr>
                                                <td class='center'>".$i1."<input type='hidden' name='".$prefix."_sell_idx[]' value=''></td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_stockName[]' class='fText'></td>
                                                <td class='center'><input type='text' name='".$prefix."_sell_Strength[]' class='fText'></td>                                                                                                
                                                </tr>");
                                }
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
include $_SERVER["DOCUMENT_ROOT"]."/Manage/stockinfo/indexUpdate_js.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/footer.php";
?>