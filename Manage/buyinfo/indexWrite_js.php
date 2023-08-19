<script>

    var TargetUrl = '/controller/buyinfo.php';
    var ListUrl = '/Manage/buyinfo/';

    $(document).ready(readyDoc);

    function readyDoc() {

        
    }

    function saveForm(){        
        if(!FieldCheckAlert("stockName", "종목명을 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("planType", "매수유형을 선택하셔야 합니다.", "select", "Y")) return false;
        if(!FieldCheckAlert("totalBuyMoney", "총예수금을 입력하셔야 합니다.", "input", "Y")) return false;        
        if(!FieldCheckAlert("buyReason", "매수이유를 입력하셔야 합니다.", "textarea", "Y")) return false;
        if(!FieldCheckAlert("price", "매수단가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("quantity", "매수수량을 입력하셔야 합니다.", "input", "Y")) return false;

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
                        var result = $.parseJSON(json);
                        if(result.result){
                            alert(result.message);
                        }
                        if(result.result == "success"){
                            location.href = ListUrl;
                        }
                        if(result.result == "error"){
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
