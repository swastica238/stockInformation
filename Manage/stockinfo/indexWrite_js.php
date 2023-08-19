<script>

    var TargetUrl = '/controller/stockinfo.php';
    var ListUrl = '/Manage/stockinfo/';

    $(document).ready(readyDoc);

    function readyDoc() {

    }

    function saveForm(){

        var pf_stockName = [];
        $("input[name='pf_stockName[]']").each(function(){
            pf_stockName.push(this.value);
        });

        var pf_buyStrength = [];
        $("input[name='pf_buyStrength[]']").each(function(){
            pf_buyStrength.push(this.value);
        });

        var pf_isImportant = [];
        $("input[name='pf_isImportant[]']").each(function(){
            if(this.checked == true){
                pf_isImportant.push('y');
            } else {
                pf_isImportant.push('n');
            }
        });

        var p_stockName = [];
        $("input[name='p_stockName[]']").each(function(){
            p_stockName.push(this.value);
        });

        var p_buyStrength = [];
        $("input[name='p_buyStrength[]']").each(function(){
            p_buyStrength.push(this.value);
        });

        var p_isImportant = [];
        $("input[name='p_isImportant[]']").each(function(){
            if(this.checked == true){
                p_isImportant.push('y');
            } else {
                p_isImportant.push('n');
            }
        });

        var i_stockName = [];
        $("input[name='i_stockName[]']").each(function(){
            i_stockName.push(this.value);
        });

        var i_buyStrength = [];
        $("input[name='i_buyStrength[]']").each(function(){
            i_buyStrength.push(this.value);
        });

        var i_isImportant = [];
        $("input[name='i_isImportant[]']").each(function(){
            if(this.checked == true){
                i_isImportant.push('y');
            } else {
                i_isImportant.push('n');
            }
        });

        var f_stockName = [];
        $("input[name='f_stockName[]']").each(function(){
            f_stockName.push(this.value);
        });

        var f_buyStrength = [];
        $("input[name='f_buyStrength[]']").each(function(){
            f_buyStrength.push(this.value);
        });

        var f_isImportant = [];
        $("input[name='f_isImportant[]']").each(function(){
            if(this.checked == true){
                f_isImportant.push('y');
            } else {
                f_isImportant.push('n');
            }
        });

        var registerDate = $('#registerDate').val();

        var pf_sell_stockName = [];
        $("input[name='pf_sell_stockName[]']").each(function(){
            pf_sell_stockName.push(this.value);
        });

        var pf_sell_Strength = [];
        $("input[name='pf_sell_Strength[]']").each(function(){
            pf_sell_Strength.push(this.value);
        });

        var p_sell_stockName = [];
        $("input[name='p_sell_stockName[]']").each(function(){
            p_sell_stockName.push(this.value);
        });

        var p_sell_Strength = [];
        $("input[name='p_sell_Strength[]']").each(function(){
            p_sell_Strength.push(this.value);
        });

        var i_sell_stockName = [];
        $("input[name='i_sell_stockName[]']").each(function(){
            i_sell_stockName.push(this.value);
        });

        var i_sell_Strength = [];
        $("input[name='i_sell_Strength[]']").each(function(){
            i_sell_Strength.push(this.value);
        });

        var f_sell_stockName = [];
        $("input[name='f_sell_stockName[]']").each(function(){
            f_sell_stockName.push(this.value);
        });

        var f_sell_Strength = [];
        $("input[name='f_sell_Strength[]']").each(function(){
            f_sell_Strength.push(this.value);
        });

        var allData = {'trace':'saveForm', 'registerDate':registerDate
            , 'pf_stockName':pf_stockName, 'pf_buyStrength':pf_buyStrength, 'pf_isImportant':pf_isImportant
            , 'p_stockName':p_stockName, 'p_buyStrength':p_buyStrength, 'p_isImportant':p_isImportant
            , 'f_stockName':f_stockName, 'f_buyStrength':f_buyStrength, 'f_isImportant':f_isImportant
            , 'i_stockName':i_stockName, 'i_buyStrength':i_buyStrength, 'i_isImportant':i_isImportant
            , 'pf_sell_stockName':pf_sell_stockName, 'pf_sell_Strength':pf_sell_Strength
            , 'p_sell_stockName':p_sell_stockName, 'p_sell_Strength':p_sell_Strength
            , 'f_sell_stockName':f_sell_stockName, 'f_sell_Strength':f_sell_Strength
            , 'i_sell_stockName':i_sell_stockName, 'i_sell_Strength':i_sell_Strength
        }

        if(confirm('등록하시겠습니까?')){

            $.ajax({
                url:TargetUrl,
                type:'POST',
                data: allData,
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
