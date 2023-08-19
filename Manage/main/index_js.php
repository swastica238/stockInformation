<script type="text/javascript">

    var TargetUrl = '/controller/main.php';
    var ListUrl = '/Manage/main/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList_yesterday();
    }

    function getList_yesterday(){
        var allData = {'trace':'getList_yesterday'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    $.each(result.data, function(key, value){
                        if(value.mainAgent == "pf"){
                            $('#privateFund_yesterday').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension_yesterday').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust_yesterday').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner_yesterday').empty().append(value.appendHtml);
                        }
                    });
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

</script>