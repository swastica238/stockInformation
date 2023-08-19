<script>

    var TargetUrl = '/controller/unlock.php';
    var ListUrl = '/Manage/unlock/';

    $(document).ready(readyDoc);

    function readyDoc() {
        getType();
    }

    function getType(){
        var allData = {'trace':'getType'}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                if(json){
                    var result = $.parseJSON(json);
                    if(result.appendHtml){
                        $('#type').append(result.appendHtml);
                    }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });
    }

    function saveForm(){
        if(!FieldCheckAlert("type", "타입을 선택하셔야 합니다.", "select", "Y")) return false;
        if(!FieldCheckAlert("gubun", "담당자를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("stock", "종목을 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("currentPrice", "현재가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("targetPrice", "목표가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("lossCutPrice", "손절가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("summary", "요약을 입력하셔야 합니다.", "textarea", "Y")) return false;
        if(!FieldCheckAlert("interViewDate", "방영일자를 입력하셔야 합니다.", "input", "Y")) return false;

        if(confirm('등록하시겠습니까?')){
            $('#reg_form').append('<input type="hidden" name="trace" value="saveForm" />');
            var params = $("#reg_form").serialize();

            $.ajax({
                url:TargetUrl,
                type:'POST',
                data: params,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType: 'html',
                success:function(json){
                    if(json){
                        resultAlert(json);
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                }
            });
        }
    }
</script>
