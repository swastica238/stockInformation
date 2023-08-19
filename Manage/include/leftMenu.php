<?php
$sHome = $sStockInfo = $sBuyInfo = $sDayInfo = $sMemo = $sReport = $sExchange = $sUnlock = "";

$boardId = isset($_REQUEST['boardId']) && $_REQUEST['boardId'] ? $_REQUEST['boardId'] : "";

if($depth1_name == "Manage"){
    if($this_dir == "stockinfo"){
        $sStockInfo = "selected";
    } else if($this_dir == "buyinfo") {
        $sBuyInfo = "selected";
    } else if($this_dir == "dayinfo") {
        $sDayInfo = "selected";
    } else if($this_dir == "memo") {
        $sMemo = "selected";
    } else if($this_dir == "report") {
        $sReport = "selected";
    } else if($this_dir == "exchange") {
        $sExchange = "selected";
    } else if($this_dir == "unlock") {
        $sUnlock = "selected";
    }
}

?>

<style>
    .depth2 {background: #2D3A58}
    .depth2 li {padding:10px 26px}
    .depth2 li.selected { background: #84a1eb}
    .depth2 a {color:#fff}
</style>
<div id="sidebar">
    <div class="logo">
        <h1>
            <a href="#"><img src="/common/images/logo_white.png" style="width:50%" alt=""></a>
        </h1>
    </div>
    <div class="snbArea">
        <div id="menuList" class="">
            <div id="mCSB_2" class="" style="max-height:895px">
                <div id="mCSB_2_container" style="position:relative;top:0;left:0;">
                    <ul class="menu">
                        <?php
                        echo ("<li class='".$sHome."'><a href='/Manage/main.php' class='link home'>홈</a></li>");
                        echo ("<li class='".$sExchange."'><a href='/Manage/exchange/' class='link recipe'>환전정보</a></li>");
                        echo ("<li class='".$sReport."'><a href='/Manage/report/' class='link market'>리포트</a></li>");
                        echo ("<li class='".$sStockInfo."'><a href='/Manage/stockinfo/' class='link setting'>주식정보</a></li>");
                        echo ("<li class='".$sBuyInfo."'><a href='/Manage/buyinfo/' class='link excel'>매매정보</a></li>");
                        echo ("<li class='".$sDayInfo."'><a href='/Manage/dayinfo/' class='link calculate'>일자정보</a></li>");
                        echo ("<li class='".$sMemo."'><a href='/Manage/memo/' class='link board'>메모</a></li>");
                        echo ("<li class='".$sUnlock."'><a href='/Manage/unlock/' class='link recipe'>잠금해제</a></li>");

                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
