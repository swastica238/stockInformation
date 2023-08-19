<script>

    var TargetUrl = '/controller/exchange.php';
    var ListUrl = '/Manage/exchange/';

    $(document).ready(readyDoc);

    function readyDoc() {


    }

    function saveForm(){
        if(!FieldCheckAlert("exchangeType", "타입을 선택하셔야 합니다.", "select", "Y")) return false;
        if(!FieldCheckAlert("exchangeRate", "환율을 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("koreaMoney", "원을 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("dollarMoney", "달러를 입력하셔야 합니다.", "input", "Y")) return false;

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
