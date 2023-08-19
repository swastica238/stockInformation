<script>

    var TargetUrl = '/controller/buyinfo.php';


    function addBuy(){

        var appendHtml = "<div class='section mLayer gLarge modal-wrapper' id='stock_modal' style=''>";
        appendHtml += "<h2>매수 추가</h2>";
        appendHtml += "<div class='mBoard gSmall'>";
        appendHtml += "<table border='1'>";
        appendHtml += "<colgroup><col style='width: 25%'><col style='width: 25%'><col style='width: 25%'><col style='width: 25%'></colgroup>";
        appendHtml += "<tbody><tr>";
        appendHtml += "<th scope='row'>매수단가 <strong class='icoequired'>필수</strong></th>";
        appendHtml += "<td><input type='text' name='price' id='price' class='fText'></td>";
        appendHtml += "<th scope='row'>매수수량 <strong class='icoequired'>필수</strong></th>";
        appendHtml += "<td><input type='text' name='quantity' id='quantity' class='fText'></td></tr></tbody>";
        appendHtml += "</table>";
        appendHtml += "</div>";
        appendHtml += "<div class='footer'>";
        appendHtml += "<a href='javascript:saveBuy();' class='btnCtrl'><span style='background-color:#667084;'>등록</span></a> ";
        appendHtml += "<a href=\"javascript:$('#stock_modal').remove();\" class='btnNormal eClose'><span>닫기</span></a>";
        appendHtml += "</div>";
        appendHtml += "<button type='button' class='btnClose eClose' onclick=\"javascript:$('#stock_modal').remove();\">닫기</button>";
        appendHtml += "</div>";

        $('.modal-wrapper').remove();
        $('body').append(appendHtml);
        $('.modal-wrapper').css({'position':'absolute'});
        $('.modal-wrapper').css({'left':'50%'});
        $('.modal-wrapper').css({'top':'50%'});
        $('.modal-wrapper').css({'transform':'translate(-50%, -50%)'});
        $('.modal-wrapper').css({'width':'48%'});
        $('.modal-wrapper').css({'height':'20%'});
        $('.modal-wrapper').fadeIn(300);
    }

    function saveBuy(){
        if(!FieldCheckAlert("price", "매수단가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("quantity", "매수수량을 입력하셔야 합니다.", "input", "Y")) return false;

        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var idx = $('#idx').val();

        var allData = {'trace':'saveBuy', 'idx':idx, 'price':price, 'quantity':quantity}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.message){
                        alert(result.message);
                    }
                    if(result.errorCode){
                        console.log(result.errorCode);
                    }
                    if(result.result == "success"){
                        location.reload();
                    }

                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });
    }

    function addSell(){

        var appendHtml = "<div class='section mLayer gLarge modal-wrapper' id='stock_modal' style=''>";
        appendHtml += "<h2>매도 추가</h2>";
        appendHtml += "<div class='mBoard gSmall'>";
        appendHtml += "<table border='1'>";
        appendHtml += "<colgroup><col style='width: 25%'><col style='width: 25%'><col style='width: 25%'><col style='width: 25%'></colgroup>";
        appendHtml += "<tbody><tr>";
        appendHtml += "<th scope='row'>매도단가 <strong class='icoequired'>필수</strong></th>";
        appendHtml += "<td><input type='text' name='price' id='price' class='fText'></td>";
        appendHtml += "<th scope='row'>매도수량 <strong class='icoequired'>필수</strong></th>";
        appendHtml += "<td><input type='text' name='quantity' id='quantity' class='fText'></td></tr></tbody>";
        appendHtml += "</table>";
        appendHtml += "</div>";
        appendHtml += "<div class='footer'>";
        appendHtml += "<a href='javascript:saveSell();' class='btnCtrl'><span style='background-color:#667084;'>등록</span></a> ";
        appendHtml += "<a href=\"javascript:$('#stock_modal').remove();\" class='btnNormal eClose'><span>닫기</span></a>";
        appendHtml += "</div>";
        appendHtml += "<button type='button' class='btnClose eClose' onclick=\"javascript:$('#stock_modal').remove();\">닫기</button>";
        appendHtml += "</div>";

        $('.modal-wrapper').remove();
        $('body').append(appendHtml);
        $('.modal-wrapper').css({'position':'absolute'});
        $('.modal-wrapper').css({'left':'50%'});
        $('.modal-wrapper').css({'top':'50%'});
        $('.modal-wrapper').css({'transform':'translate(-50%, -50%)'});
        $('.modal-wrapper').css({'width':'48%'});
        $('.modal-wrapper').css({'height':'20%'});
        $('.modal-wrapper').fadeIn(300);
    }

    function saveSell(){
        if(!FieldCheckAlert("price", "매도단가를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("quantity", "매도수량을 입력하셔야 합니다.", "input", "Y")) return false;

        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var idx = $('#idx').val();

        var allData = {'trace':'saveSell', 'idx':idx, 'price':price, 'quantity':quantity}

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.message){
                        alert(result.message);
                    }
                    if(result.sellAll == "y"){
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
</script>