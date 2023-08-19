<script type="text/javascript">

    var TargetUrl = '/controller/memo.php';
    var ListUrl = '/Manage/memo/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList();
    }

    function getList(nowPage){
        var searchKeyword = $('#searchKeyword').val();
        var listViewCount = $('#listViewCount').val();
        nowPage = nowPage ? nowPage : 1;

        var allData = {'searchKeyword':searchKeyword, 'nowPage':nowPage, 'listViewCount':listViewCount, 'trace':'getList'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                //console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.appendHtml){
                        $('.empty').hide();
                        $('#searchMemCount').text(result.SEARCH_CNT);
                        $('#resultList').empty().append(result.appendHtml);
                        $('#resultPage').empty().append(makePage(result.nowPage, result.totalPage, listViewCount, ''));
                    } else {
                        $('#resultList').empty();
                        $('#resultPage').empty();
                        $('.empty').show();
                    }
                } else {
                    $('#resultList').empty();
                    $('.empty').show();
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

    function viewMemo(idx){
        var allData = {'idx':idx, 'trace':'viewMemo'}
        console.log(allData);

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.appendHtml){
                        $('body').append(result.appendHtml);
                        $('#memoModal').show();
                    }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });
    }

    function updateMemo(idx){
        location.href = 'indexUpdate.php?idx='+idx;
    }

</script>