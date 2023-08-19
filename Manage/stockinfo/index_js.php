<script type="text/javascript">

    var TargetUrl = '/controller/stockinfo.php';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList();
    }

    function getList(nowPage){
        var searchKey = $('#searchKey').val();
        var searchKeyword = $('#searchKeyword').val();
        var searchDate = $('#searchDate').val();

        var allData = {'searchKey':searchKey, 'searchKeyword':searchKeyword, 'searchDate':searchDate, 'trace':'getList'}
        console.log(allData);

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
                            $('#privateFund').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner').empty().append(value.appendHtml);
                        }
                    });

                    if(result.registerDate){
                        $('#registerDate').val(result.registerDate);
                        $('#stockDate').text(result.registerDate);
                    }

                    if(result.sellData){
                        $.each(result.sellData, function(key, value){
                            if(value.mainAgent == "pf"){
                                $('#privateFund_sell').empty().append(value.appendHtml);
                            } else if(value.mainAgent == "p"){
                                $('#pension_sell').empty().append(value.appendHtml);
                            } else if(value.mainAgent == "i"){
                                $('#investmemntTrust_sell').empty().append(value.appendHtml);
                            } else if(value.mainAgent == "f"){
                                $('#foreigner_sell').empty().append(value.appendHtml);
                            }
                        });
                    }


                } else {
                    $('.empty').show();
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

    function goLink(){
        var registerDate = $('#registerDate').val();

        if(registerDate){
            location.href = 'indexUpdate.php?registerDate='+registerDate;
        }
    }

</script>