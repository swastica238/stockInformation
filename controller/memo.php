<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $q = "INSERT INTO memo (title, contents, registerDate) VALUES (:title, :contents, NOW())";
        $rs = $con->prepare($q);
        $rs->bindValue(':title', $title, PDO::PARAM_STR);
        $rs->bindValue(':contents', $contents, PDO::PARAM_INT);
        $rs->execute();

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
} else if($trace == "getList"){
    $nowPage = isset($_REQUEST['nowPage']) && $_REQUEST['nowPage'] ? $_REQUEST['nowPage'] : 1;
    $listViewCount = isset($_REQUEST['listViewCount']) && $_REQUEST['listViewCount'] ? $_REQUEST['listViewCount'] : 10;

    $sWhere = "";

    if($searchKeyword){
        $sWhere .= " AND a.title LIKE :searchKeyword or a.contents LIKE :searchKeyword";
    }

    //검색 숫자
    $q1 = "SELECT count(*) SEARCH_CNT 
            FROM memo a
            WHERE 1 = 1 ".$sWhere;
    $rs1 = $con->prepare($q1);
    if($searchKeyword){
        $rs1->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs1->execute();
    $row1 = $rs1->fetch();
    $SEARCH_CNT = $row1['SEARCH_CNT'];

    $start = ($nowPage - 1) * $listViewCount;
    $totalPage = ceil($SEARCH_CNT / $listViewCount);

    $q2 = "SELECT a.*            
            FROM memo a
            WHERE 1 = 1 ".$sWhere." ORDER BY a.registerDate DESC limit ".$start.", ".$listViewCount;

    $rs2 = $con->prepare($q2);
    if($searchKeyword){
        $rs2->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }

    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml = "";
    $i1 = 0;

    if($count2){
        foreach ($LISTRS2 as $row2){

            $appendHtml .= "<tr >
                                <td class='center'><a href=\"javascript:viewMemo('".$row2['idx']."')\">".substr($row2['registerDate'],0,10)."</a></td>
                                <td class='center'><a href=\"javascript:viewMemo('".$row2['idx']."')\">".$row2['title']."</a></td>
                                <td>".mb_substr(strip_tags($row2['contents']),0,200)."</td>   
                           </tr>
                            ";

            $i1++;
        }
    }

    echo json_encode(array('SEARCH_CNT'=>$SEARCH_CNT, 'nowPage'=>$nowPage, 'totalPage'=>$totalPage, 'appendHtml'=>$appendHtml));
    exit;

} else if($trace == "viewMemo"){
    $q = "SELECT * FROM memo WHERE idx = :idx";
    $rs = $con->prepare($q);
    $rs->bindValue(':idx', $idx, PDO::PARAM_INT);
    $rs->execute();
    $row = $rs->fetch();

    $appendHtml = "";

    $appendHtml .= "<div id='memoModal' class='section mLayer gMedium' style='top:215px; left:1359px;margin-left:0px;'>";
    $appendHtml .= "<h2>메모</h2>";
    $appendHtml .= "<div class='mBoard gSmall'>";
    $appendHtml .= "<table border='1'>";
    $appendHtml .= "<colgroup><col></colgroup>";
    $appendHtml .= "<tbody>";
    $appendHtml .= "<tr><td>".nl2br($row['contents'])."</td></tr>";
    $appendHtml .= "</tbody>";
    $appendHtml .= "</table>";

    $appendHtml .= "</div>";
    $appendHtml .= "<div class='footer'><a href=\"javascript:updateMemo('".$idx."');\" class='btnNormal eClose'><span>수정</span></a> <a href=\"javascript:$('#memoModal').remove();\" class='btnNormal eClose'><span>닫기</span></a></div>";
    $appendHtml .= "<button type='button' class='btnClose eClose' onclick=\"javascript:$('#memoModal').remove();\">닫기</button>";
    $appendHtml .= "</div>";

    echo json_encode(array('appendHtml'=>$appendHtml));
    exit;
} else if($trace == "updateForm"){
    try {
        $q = "UPDATE memo SET title = :title, contents = :contents WHERE idx = :idx";
        $rs = $con->prepare($q);
        $rs->bindValue(':title', $title, PDO::PARAM_STR);
        $rs->bindValue(':contents', $contents, PDO::PARAM_STR);
        $rs->bindValue(':idx', $idx, PDO::PARAM_INT);
        $rs->execute();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[1]));
        exit;
    } catch (PDOException $e){
        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
}