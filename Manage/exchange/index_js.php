<script type="text/javascript">

    var TargetUrl = '/controller/exchange.php';
    var ListUrl = '/Manage/exchange/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList();
    }

    function getList(nowPage){
        var searchKey = $('#searchKey').val();
        var listViewCount = $('#listViewCount').val();
        nowPage = nowPage ? nowPage : 1;

        var allData = {'searchKey':searchKey, 'nowPage':nowPage, 'listViewCount':listViewCount, 'trace':'getList'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    resultList(json);
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

</script>