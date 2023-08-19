<?php
ini_set('allow_url_fopen', 1);
include $_SERVER['DOCUMENT_ROOT']."/common/php/simple_html_dom.php";

$data = file_get_html('https://search.shopping.naver.com/search/all?query=%ED%95%8D%EC%8A%A4%20%EC%96%B4%EB%B3%B4%EB%B8%8C%20%EB%A9%94%EC%8B%A0%EC%A0%80%EB%B0%B1&frm=NVSHATC&prevQuery=%EC%BF%A0%ED%8C%A1');

/*foreach ($data->find('div.item_issue') as $li){
    $title = $li->plaintext;
    echo "<li>";
    echo $title;

    $img = $li->find('img', 0)->src;
    echo $img;
    echo "</li>";
}*/


$categoryData = count($data->find('div.basicList_depth__SbZWF'));
$categoryDataNot = count($data->find('noResultWithBestResults_no_result__FOoXE'));
//echo "categoryData=".$categoryData[0]->plaintext;
echo "categoryData=".$categoryData;
echo "categoryDataNot=".$categoryDataNot;

// 상품이 없을 때
/*if($data->find('noResultWithBestResults_no_result__FOoXE')){

}

if($data->find('div.basicList_depth__SbZWF')){

}*/
?>