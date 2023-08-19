<script type="text/javascript">

    var TargetUrl = '/controller/main.php';
    var ListUrl = '/Manage/main/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getList_week_this();
        getList_week();
        getList_yesterday();
        getList_continue();
        getList_dup();
    }

    function getList_week_this(){
        var allData = {'trace':'getList_week_this'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                if(json){
                    var result = $.parseJSON(json);
                    $.each(result.data, function(key, value){
                        if(value.mainAgent == "pf"){
                            $('#privateFund_week_this').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension_week_this').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust_week_this').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner_week_this').empty().append(value.appendHtml);
                        }
                    });
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

    function getList_week(){
        var allData = {'trace':'getList_week'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                if(json){
                    var result = $.parseJSON(json);
                    $.each(result.data, function(key, value){
                        if(value.mainAgent == "pf"){
                            $('#privateFund_week').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension_week').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust_week').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner_week').empty().append(value.appendHtml);
                        }
                    });
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

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
                    if(result.registerDate){
                        $('#registerDate').text(result.registerDate);
                        $('#registerDate1').text(result.registerDate);
                    }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

    function getList_continue(){
        var allData = {'trace':'getList_continue'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                //console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    $.each(result.data, function(key, value){
                        if(value.mainAgent == "pf"){
                            $('#privateFund_continue').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension_continue').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust_continue').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner_continue').empty().append(value.appendHtml);
                        }
                    });
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

    function getList_dup(){
        var allData = {'trace':'getList_dup'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                //console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    $.each(result.data, function(key, value){
                        if(value.mainAgent == "pf"){
                            $('#privateFund_dup').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "p"){
                            $('#pension_dup').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "i"){
                            $('#investmemntTrust_dup').empty().append(value.appendHtml);
                        } else if(value.mainAgent == "f"){
                            $('#foreigner_dup').empty().append(value.appendHtml);
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