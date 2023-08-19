<script>

    var TargetUrl = '/controller/report.php';
    var ListUrl = '/Manage/report/';

    var aDetail_text_str;
    var bDetail_text_disabled = false;

    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "contents",
        sSkinURI: "/common/js/smeditor/SmartEditor2Skin.html",
        htParams : {
            bUseToolbar : true,
            bUseVerticalResizer : true,
            bUseModeChanger : true,
            fOnBeforeUnload : function(){
            }
        },
        fOnAppLoad : function(){
            if (aDetail_text_str){
                oEditors.getById["contents"].exec("PASTE_HTML", aDetail_text_str);
                aDetail_text_str = null;
            }
            if (bDetail_text_disabled){
                oEditors.getById["contents"].exec("DISABLE_WYSIWYG");
                bDetail_text_disabled = false;
            }
        },
        fCreator: "createSEditor2"
    });

    function detail_text_set(paValue) {
        try{
            oEditors.getById["contents"].exec("PASTE_HTML", paValue);
        } catch(e) {
            aDetail_text_str = paValue;
        }
    }

    $(document).ready(readyDoc);

    function readyDoc() {

    }

    function saveForm(){
        oEditors.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);

        if(!FieldCheckAlert("category", "분류를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("issue_entity", "발행사를 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("title", "제목을 입력하셔야 합니다.", "input", "Y")) return false;
        if(!FieldCheckAlert("recommendStock", "추천주를 입력하셔야 합니다.", "input", "Y")) return false;
        $('#contents').val($('#contents').val().replace('<p>&nbsp;</p>',''));
        if(!FieldCheckAlert("contents", "내용을 입력해주세요.", "textarea", "Y")) return false;

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
