<script type="text/javascript">

    var TargetUrl = '/controller/adminLogin.php';

    $(document).ready(readyDoc);

    function readyDoc() {

        $("input").keypress(function(event) {

            if (event.which == 13) {
                event.preventDefault();
                loginCheck();
            }
        });

        $('.ePasswordClick').on('click', function(){
            if($('.ePasswordClick').hasClass('off') == true){
                $('#adminPassword').prop("type", "text");
                $('.ePasswordClick').removeClass('off').addClass('on');
            } else {
                $('#adminPassword').prop("type", "password");
                $('.ePasswordClick').removeClass('on').addClass('off');
            }
        });

        $('#adminId').focus();
    }

    function loginCheck(){
        if(!FieldCheckAlert("adminId", "아이디를 입력해주세요.", "input", "Y")) return false;
        if(!FieldCheckAlert("adminPassword", "비밀번호를 입력해주세요.", "input", "Y")) return false;

        var adminId = $('#adminId').val();
        var adminPassword = $('#adminPassword').val();

        var allData = {'adminId':adminId, 'adminPassword':adminPassword, 'trace':'adminLogin'}

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
                        location.href = result.locationUrl;
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


</script>