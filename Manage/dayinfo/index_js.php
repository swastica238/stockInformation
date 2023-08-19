<script type="text/javascript">

    var TargetUrl = '/controller/dayinfo.php';
    var ListUrl = '/Manage/dayinfo/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList();
    }

    function getList(nowPage){
        var searchYear = $('#searchYear').val();
        var searchMonth = $('#searchMonth').val();

        var allData = {'searchYear':searchYear, 'searchMonth':searchMonth, 'trace':'getList'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                if(json){
                    var result = $.parseJSON(json);
                    if(result.appendHtml){
                        $('.empty').hide();
                        $('#resultList').empty().append(result.appendHtml);
                    } else {
                        $('#resultList').empty();
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

    function saveForm(){
        if(!FieldCheckAlert("makeDay", "생성할 년-월을 입력하셔야 합니다.", "input", "Y")) return false;
        var makeDay = $('#makeDay').val();

        var allData = {'makeDay':makeDay, 'trace':'saveForm'}

        if(confirm('등록하시겠습니까?')){
            $.ajax({
                url:TargetUrl,
                type:'POST',
                data: allData
                , success : function(json){
                    if(json){
                        var result = $.parseJSON(json);
                        if(result.message){
                            alert(result.message);
                        }
                        if(result.result == "success"){
                            location.reload();
                        }
                        if(result.errorCode){
                            console.log(result.errorCode);
                        }
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                }
            });
        }
    }

    function minusForm(){
        if(!FieldCheckAlert("exceptDay", "제외할 일자를 입력하셔야 합니다.", "input", "Y")) return false;
        var exceptDay = $('#exceptDay').val();

        var allData = {'exceptDay':exceptDay, 'trace':'minusForm'}

        if(confirm('제외하시겠습니까?')){
            $.ajax({
                url:TargetUrl,
                type:'POST',
                data: allData
                , success : function(json){
                    if(json){
                        var result = $.parseJSON(json);
                        if(result.message){
                            alert(result.message);
                        }
                        if(result.result == "success"){
                            location.reload();
                        }
                        if(result.errorCode){
                            console.log(result.errorCode);
                        }
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                }
            });
        }
        
    }



</script>