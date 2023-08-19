<script type="text/javascript">

    var TargetUrl = '/controller/unlock.php';
    var ListUrl = '/Manage/unlock/';

    $(document).ready(readyDoc);

    function readyDoc() {
    }

    function setState(){
        var idx = $('#idx').val();
        var successYN = $('#successYN').val();
        var successDate = $('#successDate').val();
        var summary = $('#summary').val();
        var buyYN = $('#buyYN').val();

        var allData = {'idx':idx, 'successYN':successYN, 'successDate':successDate, 'buyYN':buyYN, 'summary':summary,  'trace':'setState'}
        console.log(allData);

        $.ajax({
            url:TargetUrl,
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    resultAlert(json);
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            }
        });

    }

</script>