$(document).ready(readyDoc);

function readyDoc() {
    $('.eClick').on('click', function(){
        console.log('dddd');
        if($('.utilDown').hasClass('show')){
            $('.utilDown').removeClass('show');
            $('.utilDown').hide();
        } else {
            $('.utilDown').addClass('show');
            $('.utilDown').show();
        }
    });

    $('.datetime').datetimepicker({
        lang:'kr',
        format:	'Y-m-d',
        timepicker:false,
        readonly:false,
    }).on('change', function(){
        $('.xdsoft_datetimepicker').hide();
    });

    $(document).on('click', '#se2_add_img', function(e){
        e.preventDefault();
        $('#fileupinp').click();
    });

    $(document).on('change', '#fileupinp', function(e){
        e.preventDefault();
        imageContentUpload();
    });

    $(document).on('click', '#fileUpload', function(e){
        e.preventDefault();
        $('#addFileup').click();
    });

    $(document).on('change', '#addFileup', function(e){
        e.preventDefault();
        boardFileUpload();
    });

    $(document).on('click', '#se2_add_youtube', function(e){
        e.preventDefault();
        if($('#youtubeLinkModal').length) return;

        var html = "<div id='youtubeLinkModal' class='mLayer gSmall' style='top:"+(e.clientY + 18)+"px; left:"+(e.clientX - 350)+"px;margin-left:0px;display: none'>";
            html += "<h2>코멘트</h2>";
            html += "<div class='wrap'>";
            html += "<div class='mTitle'><h3>링크주소와 크기를 입력해주세요.</h3></div>";
            html += "<ul class='mForm typeHor gIndent'>";
            html += "<li style='width:100%'><label class='gLabel w100'>링크주소 <input type='text' id='youtubeText' name='youtubeText' class='w250' style='outline: none'></label></li>";
            html += "<li><label class='gLabel w100'>넓이 <input type='text' id='youtubeWidthInp' name='youtubeWidthInp' class='w80' style='outline: none'></label></li>";
            html += "<li><label class='gLabel w100'>높이 <input type='text' id='youtubeHeightInp' name='youtubeHeightInp' class='w80' style='outline: none'></label></li>";
            html += "</ul>";
            html += "</div>";
            html += "<div class='footer'><a href='javascript:;' id='youtubeSubmitBtn' class='btnCtrl'><span>등록</span></a> <a href=\"javascript:$('#youtubeLinkModal').remove();\" class='btnNormal eClose'><span>닫기</span></a></div>";
            html += "<button type='button' class='btnClose eClose' onclick=\"javascript:$('#youtubeLinkModal').remove();\">닫기</button>";
            html += "</div>";

        $('body').append(html);
        $('#youtubeLinkModal').show();
        $('#youtubeSubmitBtn').on('click', function(){
            if(!FieldCheckAlert("youtubeText", "링크주소를 입력하셔야 합니다.", "input", "Y")) return false;
            if(!FieldCheckAlert("youtubeWidthInp", "넓이를 입력하셔야 합니다.", "input", "Y")) return false;
            if(!FieldCheckAlert("youtubeHeightInp", "높이를 입력하셔야 합니다.", "input", "Y")) return false;
            var w = $('#youtubeWidthInp').val();
            var h = $('#youtubeHeightInp').val();
            if(!w.match(/[^0-9]/)) w = w + 'px';
            if(!h.match(/[^0-9]/)) h = h + 'px';
            var html = Youtube($('#youtubeText').val(), w, h);
            oEditors.getById['contents'].exec('PASTE_HTML', [html]);
            $('#youtubeLinkModal').remove();
        });
    });

    $(document).on("keyup", "input:text[businumberOnly]", function() {
        $(this).val( bizNoFormatter($(this).val()));
    });

    $(document).on("keyup", "input:text[phonenumberOnly]", function() {
        $(this).val( phoneNumber($(this).val()) );
    });

    $(document).on("keyup", "input:text[numberComma]", function() {
        $(this).val($(this).val().replace(/\,/g, '').replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,'));
    });

    $(document).on("keyup", "input:text[numberOnly]", function() {
        $(this).val($(this).val().replace(/[^0-9]/g,""));
    });

}



function openSpinner(){
    var appendHtml = "<div id='my-spinner'>";
        appendHtml += "<div>";
        appendHtml += "<span>";
        appendHtml += "<img src='/Common/images/loader_spinner.gif'>";
        appendHtml += "</span>";
        appendHtml += "</div>";
        appendHtml += "</div>";
    $('body').append(appendHtml);
}

function closeSpinner(){
    $('#my-spinner').remove();
}

function imageContentUpload(){
    var datas = new FormData();
    datas.append( 'trace', 'editorUpload' );
    datas.append( 'file_name', $( '#fileupinp')[0].files[0] );

    $.ajax({
        url: '/controller/fileupload.php',
        type: 'POST',
        data: datas,
        dataType: 'html',
        mimeType: 'multipart/form-data',
        contentType: 'multipart/form-data',
        success : function(json){
            if(json){
                var result = $.parseJSON(json);

                if(result.result == "success"){
                    $('#fileupinp').val('');
                }
                if(result.viewFileName){
                    var html = '<img src="' + result.viewFileName + '" class="editorImage">';
                    oEditors.getById['contents'].exec('PASTE_HTML', [html]);
                }
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~" + textStatus + " : " + errorThrown);
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

function Youtube(urlOrId, width, height){
    urlOrId = GetYoutubeId(urlOrId);
    if(typeof(height) !== 'undefined') height = 'height : ' + height + ';';
    if(typeof(width) !== 'undefined') width = 'width : ' + width + ';';
    if(urlOrId !== false) return '<iframe src="https://www.youtube.com/embed/' + urlOrId + '?rel=0&amp;showinfo=0&amp;autohide=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="' + width + height + '" autohide="1"></iframe>';
    return '';
}

function GetYoutubeId(urlOrId){
    urlOrId = $.trim(urlOrId);
    var find = urlOrId.match(/youtu\.be\/([a-zA-Z0-9\-\_]+)/);
    if(find !== null && find.length > 1){
        return find[1];
    }

    var find = urlOrId.match(/youtube\.com\/embed\/([a-zA-Z0-9\-\_]+)/);
    if(find !== null && find.length > 1){
        return find[1];
    }

    var find = urlOrId.match(/youtube\.com\/watch.*?v=([a-zA-Z0-9\-\_]+)/);
    if(find !== null && find.length > 1){
        return find[1];
    }
    return false;
}

function makePage(nowPage, totalPage, pageCount, link){
    var returnPage = "";
    var startPage = ((Math.ceil(nowPage /  pageCount) - 1) * pageCount) + 1;
    var endPage = startPage + pageCount - 1;

    if(endPage >= totalPage) { endPage = totalPage; }

    if(nowPage > 1){
        returnPage += "<a href='javascript:getList(1);' class='first'><span>첫 페이지</span></a>";
    } else {
        returnPage += "<a href='javascript:;' class='first'><span>첫 페이지</span></a>";
    }
    if(nowPage > 10){
        returnPage += "<a href='javascript:getList("+(nowPage-10)+");' class='prev'><span>이전 10 페이지</span></a>";
    } else {
        returnPage += "<a href='javascript:;' class='prev'><span>이전 10 페이지</span></a>";
    }

    returnPage += "<ol>";
    for(var i1 = startPage; i1 <= endPage; i1++){
        if(i1 == nowPage){
            returnPage += "<li><strong title='현재페이지'>"+i1+"</strong></li>";
        } else {
            returnPage += "<li><a href='javascript:getList("+i1+");'>"+i1+"</a></li>";
        }
    }
    returnPage += "</ol>";

    if((totalPage - nowPage) > 10){
        returnPage += "<a href='javascript:getList("+(nowPage+10)+");' class='next'><span>다음 10 페이지</span></a>";
    } else {
        returnPage += "<a href='javascript:;' class='next'><span>다음 10 페이지</span></a>";
    }

    if(totalPage > endPage){
        returnPage += "<a href='javascript:getList("+totalPage+")' class='last'><span>마지막 페이지</span></a>";
    } else {
        returnPage += "<a href='javascript:;' class='last'><span>마지막 페이지</span></a>";
    }

    return returnPage;
}

function check_all(){
    var chk = $("input[id='chk_all']:checkbox").is(":checked");

    if(chk){
        $("input[name='sel_chk[]']:checkbox").prop('checked', true);
    } else {
        $("input[name='sel_chk[]']:checkbox").prop('checked', false);
    }
}

function logout(){
    if(confirm('로그아웃 하시겠습니까?')){
        var allData = {'trace':'logout'}
        $.ajax({
            url:'/Controller/adminLogin.php',
            type:'POST',
            data: allData
            , success : function(json){
                console.log(json);
                if(json){
                    var result = $.parseJSON(json);
                    if(result.result){
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
}


function setDate(num){
    var today = new Date();

    var year = today.getFullYear();
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    var day = ('0' + today.getDate()).slice(-2);

    var todayDateString = year + '-' + month  + '-' + day;

    if(num == 0){
        var targetday = today;
    } else {
        var targetday = new Date(today.setDate(today.getDate() - num));
    }

    var targetyear = targetday.getFullYear();
    var targetmonth = ('0' + (targetday.getMonth() + 1)).slice(-2);
    var targetday = ('0' + targetday.getDate()).slice(-2);

    var targetDateString = targetyear + '-' + targetmonth  + '-' + targetday;

    $('#endDate').val(todayDateString);
    $('#startDate').val(targetDateString);
}

function fileDownLoad(fileRoot, fileUploadName, fileRealName){
    $('#reg_form').append('<input type="hidden" name="fileRoot" value="'+fileRoot+'" />');
    $('#reg_form').append('<input type="hidden" name="fileUploadName" value="'+fileUploadName+'" />');
    $('#reg_form').append('<input type="hidden" name="fileRealName" value="'+fileRealName+'" />');

    document.reg_form.method='post';
    document.reg_form.action='/Controller/fileDownload.php';
    document.reg_form.target='_blank';
    document.reg_form.submit();
}

function excelDown(gubun){
    var sel_chk = document.getElementsByName('sel_chk[]');
    var chkCount = 0;
    for(var i1 = 0; i1 < sel_chk.length; i1++){
        if(sel_chk[i1].checked == true){
            chkCount++;
        }
    }

    if(chkCount == 0){
        alert('엑셀다운 받을 항목을 선택하셔야 합니다.');
    } else {
        $('#reg_form').append('<input type="hidden" name="trace" value="'+gubun+'" />');

        document.reg_form.method='post';
        document.reg_form.action='/Controller/ExcelDownload.php';
        document.reg_form.target='_blank';
        document.reg_form.submit();
    }
}

function setToggle(sectionid){
    var e = document.getElementById(sectionid);
    e.style.display = ((e.style.display!='none') ? 'none' : 'block');
}