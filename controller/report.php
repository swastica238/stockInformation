<?php
include $_SERVER["DOCUMENT_ROOT"]."/common/php/var.php";
include $_SERVER["DOCUMENT_ROOT"]."/common/php/common.php";
include $_SERVER["DOCUMENT_ROOT"]."/Manage/include/adminCheck.php";

$trace = isset($trace) ? $trace : $_REQUEST['trace'];

$con = cConnDB();

if($trace == "saveForm") {

    try {

        $con->beginTransaction();

        $registerDate = isset($_REQUEST['registerDate']) && $_REQUEST['registerDate'] ? $_REQUEST['registerDate'] : DATE("Y-m-d");

        $q = "INSERT INTO report (issue_entity, category, title, recommendStock, contents, registerDate) VALUES (:issue_entity, :category, :title, :recommendStock, :contents, :registerDate)";
        $rs = $con->prepare($q);
        $rs->bindValue(':issue_entity', $issue_entity, PDO::PARAM_STR);
        $rs->bindValue(':category', $category, PDO::PARAM_STR);
        $rs->bindValue(':title', $title, PDO::PARAM_STR);
        $rs->bindValue(':recommendStock', $recommendStock, PDO::PARAM_STR);
        $rs->bindValue(':contents', $contents, PDO::PARAM_STR);
        $rs->bindValue(':registerDate', $registerDate, PDO::PARAM_STR);
        $rs->execute();

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[0]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
} else if($trace == "getList") {
    $nowPage = isset($_REQUEST['nowPage']) && $_REQUEST['nowPage'] ? $_REQUEST['nowPage'] : 1;
    $listViewCount = isset($_REQUEST['listViewCount']) && $_REQUEST['listViewCount'] ? $_REQUEST['listViewCount'] : 10;

    $sWhere = "";

    if ($searchKey && $searchKeyword) {
        if ($searchKey == "A") {
            $sWhere .= " AND a.category LIKE :searchKeyword ";
        } else if ($searchKey == "B") {
            $sWhere .= " AND a.title LIKE :searchKeyword ";
        } else if ($searchKey == "C") {
            $sWhere .= " AND a.issue_entity LIKE :searchKeyword ";
        }

    }

    //검색 숫자
    $q1 = "SELECT count(*) SEARCH_CNT 
            FROM report a
            WHERE 1 = 1 " . $sWhere;
    $rs1 = $con->prepare($q1);
    if ($searchKey && $searchKeyword) {
        $rs1->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }
    $rs1->execute();
    $row1 = $rs1->fetch();
    $SEARCH_CNT = $row1['SEARCH_CNT'];

    $start = ($nowPage - 1) * $listViewCount;
    $totalPage = ceil($SEARCH_CNT / $listViewCount);

    $q2 = "SELECT a.*
            FROM report a
            WHERE 1 = 1 " . $sWhere . " ORDER BY a.registerDate DESC limit " . $start . ", " . $listViewCount;

    $rs2 = $con->prepare($q2);
    if ($searchKey && $searchKeyword) {
        $rs2->bindValue(':searchKeyword', "%" . $searchKeyword . "%", PDO::PARAM_STR);
    }

    $rs2->execute();
    $count2 = $rs2->rowCount();
    $LISTRS2 = $rs2->fetchAll();

    $appendHtml = "";
    $i1 = 0;

    if ($count2) {
        foreach ($LISTRS2 as $row2) {

            $appendHtml .= "<tr>
                                <td class='center'><a href='indexView.php?idx=" . $row2['idx'] . "'>" . $row2['category'] . "</a></td>
                                <td class='center'><a href='indexView.php?idx=" . $row2['idx'] . "'>" . $row2['issue_entity'] . "</a></td>
                                <td style='padding-left: 10px'><a href='indexView.php?idx=" . $row2['idx'] . "'>" . $row2['title'] . "</a></td>
                                <td style='padding-left: 10px;color: red'>" . $row2['recommendStock'] . "</td>
                                <td class='center'>" . $row2['registerDate'] . "</td>
                           </tr>
                            ";

            $i1++;
        }
    }

    echo json_encode(array('SEARCH_CNT' => $SEARCH_CNT, 'nowPage' => $nowPage, 'totalPage' => $totalPage, 'appendHtml' => $appendHtml));
    exit;
} else if($trace == "updateForm") {

    try {

        $con->beginTransaction();

        $registerDate = isset($_REQUEST['registerDate']) && $_REQUEST['registerDate'] ? $_REQUEST['registerDate'] : DATE("Y-m-d");

        $q = "UPDATE report SET issue_entity = :issue_entity, category = :category, title = :title, recommendStock = :recommendStock, contents = :contents
                WHERE idx = :idx";
        $rs = $con->prepare($q);
        $rs->bindValue(':issue_entity', $issue_entity, PDO::PARAM_STR);
        $rs->bindValue(':category', $category, PDO::PARAM_STR);
        $rs->bindValue(':title', $title, PDO::PARAM_STR);
        $rs->bindValue(':recommendStock', $recommendStock, PDO::PARAM_STR);
        $rs->bindValue(':contents', $contents, PDO::PARAM_STR);
        $rs->bindValue(':idx', $idx, PDO::PARAM_INT);
        $rs->execute();

        $con->commit();

        echo json_encode(array('result'=>RESULT[0], 'message'=>SUCCESSMESSGE[1]));
        exit;

    } catch (PDOException $e) {
        $con->rollBack();

        echo json_encode(array('result'=>RESULT[1], 'message'=>ERRORMESSGE[0], 'errorCode'=>$e->getMessage()));
        exit;
    }
}