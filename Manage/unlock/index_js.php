<script type="text/javascript">

    var TargetUrl = '/controller/unlock.php';
    var ListUrl = '/Manage/unlock/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList();
    }

    function getList(nowPage){
        var searchKeyword = $('#searchKeyword').val();

        var allData = {'searchKeyword':searchKeyword, 'trace':'getList'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.unlockList1){
                        $('#unlockList1').empty().append(result.unlockList1);
                    }
                    if(result.unlockList2){
                        $('#unlockList2').empty().append(result.unlockList2);
                    }
                    if(result.unlockList3){
                        $('#unlockList3').empty().append(result.unlockList3);
                    }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

</script>