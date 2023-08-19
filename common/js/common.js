// 필드에 입력된 값을 반환한다.
function ReturnFieldValue(FieldName, FieldType){
    if(FieldName == null)
    {
        alert("필드 정보를 입력하세요.");
    }
    else if(FieldType == "input" || FieldType == "textarea" || FieldType == "select")
    {
        return $.trim($(FieldType + "[name=" + FieldName+ "]").val());
    }
    else if(FieldType == "radio" || FieldType == "checkbox")
    {
        return $.trim($(":input:" + FieldType + "[name=" + FieldName + "]:checked").val());
    }
}

// 필드에 값이 입력됬는지 체크
function FieldCheckAlert(FieldName, AlertMent, FieldType, FocusYN){
    var ReturnValue = false;

    if(FieldName == null){
        alert("필드 정보를 입력하세요.");
    }else if(!ReturnFieldValue(FieldName, FieldType)){
        alert(AlertMent);

        if(FocusYN == "Y"){
            if(FieldType == "input" || FieldType == "textarea" || FieldType == "select"){
                $(FieldType + "[name=" + FieldName + "]").focus();
            }else if(FieldType == "radio" || FieldType == "checkbox"){
                $(":input:" + FieldType + "[name=" + FieldName + "]").focus();
            }
        }

        ReturnValue = false;
    }else{
        ReturnValue = true;
    }

    return ReturnValue;
}

// 필드에 값 확인
function GlobalFieldCheck(FieldName, FieldType)
{
    if(FieldType == "input" || FieldType == "textarea" || FieldType == "select")
    {
        return $.trim($(FieldType + "[name=" + FieldName+ "]").val());
    }
    else if(FieldType == "radio" || FieldType == "checkbox")
    {
        return $.trim($(":input:" + FieldType + "[name=" + FieldName + "]:checked").val());
    }
}

function nvl(str, defaultVal) {
    var defaultValue = "";

    if (typeof defaultVal != 'undefined') {
        defaultValue = defaultVal;
    }

    if (typeof str == "undefined" || str == null || str == '' || str == "undefined") {
        return defaultValue;
    } else {
        return encodeURIComponent(str);
    }

}

function uploadFileCheck(filename, filetype){
    var ext = filename.split('.').pop().toLowerCase();
    if(filetype == "excel"){
        if($.inArray(ext, ['xls','xlsx']) == -1){
            alert('엑셀 파일만 업로드 하실 수 있습니다.');
            return false;
        }
    }
    return true;
}


function byteCheck(el){
    var codeByte = 0;
    for (var idx = 0; idx < el.val().length; idx++) {
        var oneChar = escape(el.val().charAt(idx));
        if ( oneChar.length == 1 ) {
            codeByte ++;
        } else if (oneChar.indexOf("%u") != -1) {
            codeByte += 2;
        } else if (oneChar.indexOf("%") != -1) {
            codeByte ++;
        }
    }
    return codeByte;
}

function getByteLength(s){
    var len = 0;
    if ( s == null ) return 0;
    for(var i=0;i<s.length;i++){
        var c = escape(s.charAt(i));
        if ( c.length == 1 ) len ++;
        else if ( c.indexOf("%u") != -1 ) len += 2;
        else if ( c.indexOf("%") != -1 ) len += c.length/3;
    }
    return len;
}

function logout(){
    var allData = {'trace':'logout'}
    $.ajax({
        url:'/Controller/Login.php',
        type:'GET',
        data: allData,
        success:function(json){

            var result = $.parseJSON($.trim(json));

            if(result.result == 'error'){
                alert('오류가 발생하였습니다.');
            } else {
                alert('로그아웃 하였습니다.');
                location.href='/';
            }
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
        }
    });
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function getCookie(cname){
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
};

function setCookie(cname, cvalue, exdays){
    var expires = '';
    if(exdays !== null){
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        expires = "expires="+ d.toUTCString();
    }
    document.cookie = cname + "=" + cvalue + "; path=/;" + expires;
};

function resetForm(){
    $('input').each(function(){
        this.value = "";
    });

    $('select').each(function(){
        $('#'+this.id+' option:eq(0)').prop('selected', true);
    });

    $('textarea').each(function(){
        this.value = "";
    });
};

function validateEmail(email) {
    email = $.trim(email);
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
};

function validateInput(){
    $('input').each(function(){
        if($(this).hasClass('engonly')){
            var reValue = this.value.replace(/[^a-zA-Z]/gi,'');
            if(reValue != this.value){
                alert('영문만 입력이 가능합니다.');
                ret = false;
                this.focus();
                return false;
            }
        }
        if($(this).hasClass('engnumonly')){
            var reValue = this.value.replace(/[^a-zA-Z0-9]/gi,'');
            if(reValue != this.value){
                alert('영문 또는 숫자만 입력이 가능합니다.');
                ret = false;
                this.focus();
                return false;
            }
        }
        if($(this).hasClass('numonly')){
            var reValue = this.value.replace(/[^0-9]/gi,'');
            if(reValue != this.value){
                alert('숫자만 입력이 가능합니다.');
                ret = false;
                this.focus();
                return false;
            }
        }
    });
}

function engOnInput(e)  {
    e.value = e.value.replace(/[^A-Za-z]/ig, '');
}
function numOnInput(e)  {
    e.value = e.value.replace(/[^0-9]/ig, '');
}
function engnumOnInput(e)  {
    e.value = e.value.replace(/[^a-zA-Z0-9]/ig, '');
}

function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

/* -------------------------------------------
	 *
	 *   Daum Get Postcode
	 *
	 ------------------------------------------- */

function popPostCode(callback) {
    if (typeof daum === "undefined" || typeof daum.postcode === "undefined") {
        var el = document.createElement('script');
        el.type = 'text/javascript';
        el.src = '//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js';
        document.head.appendChild(el);
    }
    popDaumPostCode(callback);

};

function popDaumPostCode(callback) {
    if ($('#DaumPostCode').length) return;
    $('body').append('<div id="DaumPostCode"><div id="DaumPostCodeWrap"></div></div>');
    $('#DaumPostCode').css({
        'position': 'fixed',
        'z-index': '9998',
        'top': '0',
        'left': '0',
        'width': '100%',
        'height': '100%',
        'background': 'none',
        'background': 'rgba(0,0,0,0.4)',
        'cursor' : 'pointer'
    });

    $('#DaumPostCode').on('click', function (e) {
        $(this).remove();
    });

    if(isMobile()){
        var w = 800;
        var h = 500;
    } else {
        var w = 500;
        var h = 500;
        if(w > $('body').width()){
            w = 320;
            h = 410;
        }
    }


    $('#DaumPostCodeWrap').css({
        'position': 'fixed',
        'z-index': '9999',
        'top': '30%',
        'left': '50%',
        'width': w + 'px',
        'height': h + 'px',
        'max-height' : '90%',
        'box-sizing': 'border-box',
        'background': 'white',
        'border': '1px solid #eee',
        'transform' : 'translate(-50%, -50%)',
        '-webkit-transform' : 'translate(-50%, -50%)',
        '-moz-transform' : 'translate(-50%, -50%)',
        '-ms-transform' : 'translate(-50%, -50%)',
    });

    daum.postcode.load(function () {
        new daum.Postcode({
            oncomplete: function (data) {
                $('#DaumPostCode').remove();
                if(callback) callback(data);
            },
            width: (w - 10) + 'px',
            height: (h - 10) + 'px'
        }).embed($('#DaumPostCodeWrap')[0]);
    });
};

function FindDaumAddress(e){
    e.preventDefault();
    var area = $(this).closest('.daumAddress');
    _this.popPostCode(function(data) {
        area.find('input.zipcode').val(data.zonecode);
        area.find('input.address1').val(data.address);
        var sido = area.find('input.address_sido');
        var sigungu = area.find('input.address_sigungu');
        var bname = area.find('input.address_bname');
        var code = area.find('input.address_bcode');
        if(sido.length) sido.val(data.sido);
        if(sigungu.length) sigungu.val(data.sigungu);
        if(bname.length) bname.val(data.bname);
        if(code.length) code.val(data.bcode.substr(0, 8));
    });
};


var daumMap = {
    key : '',
    obj : null,
    map : null,
    actions : [],
    zoom : 3,
    markers : [],
    scriptUrl : 'https://dapi.kakao.com/v2/maps/sdk.js?autoload=false',
    Init : function(kakaoKey, elementId){
        if(typeof(elementId) !== 'undefined') this.obj = document.getElementById(elementId);
        if(!this.obj) console.log('Not Find Map Element');
        this.key = kakaoKey;
        return this;
    },

    SetKey : function(kakaoKey){
        this.key = kakaoKey;
        return this;
    },

    SetZoom : function(z){
        this.zoom = z;
        return this;
    },

    GetScript : function(type, ur, callback){
        if(typeof(window._daumMapJSLoaded) === 'undefined') window._daumMapJSLoaded = {};

        if(typeof(daum) !== 'undefined' && typeof(daum.maps) !== 'undefined'){
            return true;
        }
        else if(typeof(window._daumMapJSLoaded[type]) === 'undefined'){
            window._daumMapJSLoaded[type] = true;
            $.getScript(ur + '&appkey=' + this.key, function(){
                daum.maps.load(function() {
                    window._daumMapJSAllLoaded = true;
                    callback();
                });
            });
        }
        else{
            setTimeout(function(){
                callback();
            }, 50);
        }
    },

    Map : function(lat, lng, loadedfunc){
        if(!daumMap.GetScript('map', daumMap.scriptUrl,  function(){
            daumMap.Map(lat, lng, loadedfunc);
        })) return;

        var options = {
            center: new daum.maps.LatLng(lat, lng),
            level: daumMap.zoom
        };
        daumMap.map = new daum.maps.Map(daumMap.obj, options);
        if(typeof(loadedfunc) === 'function') loadedfunc();
        for(var i = 0; i < daumMap.actions.length; i++){
            daumMap.actions[i]();
        }
    },

    Marker : function(lat, lng, title, content, paramOpt){
        var mapCenter = new daum.maps.LatLng(lat, lng);
        var opt = {
            title : title,
            map: daumMap.map,
            position: mapCenter
        };
        if(typeof(paramOpt) === 'object'){
            $.each(paramOpt, function(idx, val){
                opt[idx] = val;
            });
        }

        var marker = new daum.maps.Marker(opt);

        if(typeof(content) !== 'undefined' && content !== ''){
            var mLabel = new daum.maps.InfoWindow({
                position: mapCenter,
                content: content
            });
            mLabel.open(daumMap.map, marker);
        }

        marker.setMap(daumMap.map);
        daumMap.markers.push(marker);
        return marker;
    },

    AddAction : function(callback){
        if(typeof window._daumMapJSAllLoaded === 'undefined'){
            this.actions.push(callback);
        }
        else{
            callback();
        }
    },

    GetAddrToLatLng : function(addr1, addr2, callback){
        if(!daumMap.GetScript('services', daumMap.scriptUrl + '&libraries=services',  function(){
            daumMap.GetAddrToLatLng(addr1, addr2, callback);
        })) return;

        var geocoder = new daum.maps.services.Geocoder();
        geocoder.addressSearch(addr1 + ' ' + addr2, function(result, status) {
            if (status === daum.maps.services.Status.OK) {
                //console.log('<< GetAddrToLatLng');
                //console.log(result);
                var res = (result[0].road_address === null) ? result[0].address : result[0].road_address;
                //console.log(res);
                //console.log('GetAddrToLatLng >>');
                callback(result[0].y, result[0].x, res);
            }
            else{
                //console.log('Not Find Geocode');
                callback(false, false);
            }
        });
    },

    GetPositionToAddr : function(lat, lng, callback){
        if(!daumMap.GetScript('services', daumMap.scriptUrl + '&libraries=services',  function(){
            daumMap.GetPositionToAddr(lat, lng, callback);
        })) return;

        // 주소-좌표 변환 객체를 생성합니다
        var geocoder = new daum.maps.services.Geocoder();

        geocoder.coord2Address(lng, lat, callback);
    },

    GetPositionToRegionCode : function(lat, lng, callback){
        if(!daumMap.GetScript('services', daumMap.scriptUrl + '&libraries=services',  function(){
            daumMap.GetPositionToRegionCode(lat, lng, callback);
        })) return;

        // 주소-좌표 변환 객체를 생성합니다
        var geocoder = new daum.maps.services.Geocoder();

        geocoder.coord2RegionCode(lng, lat, callback);
    },
};


function alertLocation(message, loc_value){
    alert(message);
    location.href=loc_value;
}

function setComma(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
};

function maxLengthCheck(object){
    if (object.value.length > object.maxLength){
        alert('연락처는 한번에 4자리까지 입력 가능합니다.');
        object.value = object.value.slice(0, object.maxLength);
    }
}

function addComma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

function unComma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function inputNumberFormat(obj) {
    obj.value = addComma(unComma(obj.value));
}

function set_close(type, idx){
    setCookie('popup_'+idx, 'y', 1);
    if(type == 't'){
        $('#popupModal').remove();
    } else {
        self.close();
    }
}

function bizNoFormatter(companyNum) {

    companyNum = companyNum.replace(/[^0-9]/g, '');
    var tempNum = '';

    if(companyNum.length < 4){
        return companyNum;
    }
    else if(companyNum.length < 6){
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        return tempNum;
    }
    else if(companyNum.length < 11){
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        tempNum += '-';
        tempNum += companyNum.substr(5);
        return tempNum;
    }
    else{
        tempNum += companyNum.substr(0,3);
        tempNum += '-';
        tempNum += companyNum.substr(3,2);
        tempNum += '-';
        tempNum += companyNum.substr(5);
        return tempNum;
    }
}

function phoneNumber(value) {
    value = value.replace(/[^0-9]/g, "");
    if(value.length > 11){
        return value.replace(
            /(^02.{0}|^01.{1}|[0-9]{4})([0-9]+)([0-9]{4})/,
            "$1-$2-$3"
        );
    } else {
        return value.replace(
            /(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/,
            "$1-$2-$3"
        );
    }
}

function fileSpecialCharacterCheck(fileName){
    var fileVal = $("#"+fileName).val();
    var pattern = /[\{\}\/?,;:|*~`!^\+<>@\#$%&\\\=\'\"]/gi;
    var uploadFileName = fileVal.split('\\').pop().toLowerCase();
    if(pattern.test(uploadFileName) ){
        alert('파일명에 특수문자가 포함되어 있습니다.');
        return false;
    } else {
        return true;
    }
}

function fileUploadSizeCheck(fileName) {
    var maxSize = 10 * 1024 * 1024; // 10MB
    var fileSize = $("#"+fileName)[0].files[0].size;
    if(fileSize > maxSize){
        alert("첨부파일 사이즈는 10MB 이내로 등록 가능합니다.");
        return false;
    } else {
        return true;
    }
}

function fileExtCheck(fileName){
    var fileVal = $("#"+fileName).val();
    if( fileVal != "" ){
        var ext = fileVal.split('.').pop().toLowerCase(); //확장자분리

        if($.inArray(ext, ['jpg','jpeg','gif','png','doc','docx','xls','xlsx','pdf','ppt','pptx','mp4','hwp','webm']) == -1) {
            alert(ext+'는 업로드 할 수 없는 파일입니다.');
            return false;
        } else {
            return true;
        }
    }
}

function fileExtCheckImage(fileName){
    var fileVal = $("#"+fileName).val();
    if( fileVal != "" ){
        var ext = fileVal.split('.').pop().toLowerCase(); //확장자분리

        if($.inArray(ext, ['jpg','jpeg','gif','png']) == -1) {
            alert(ext+'는 업로드 할 수 없는 파일입니다.');
            return false;
        } else {
            return true;
        }
    }
}


function resultAlert(json){
    if(json){
        var result = $.parseJSON(json);

        if(result.message){
            alert(result.message);
        }
        if(result.errorCode){
            console.log(result.errorCode);
        }
        if(result.goLink){
            location.href = result.goLink;
        }
        if(result.list){
            getList();
        }
        if(result.reload){
            location.reload();
        }
    }
}

function resultList(json){
    if(json){
        var result = $.parseJSON(json);
        if(result.appendHtml){
            $('.empty').hide();
            $('#searchMemCount').text(result.SEARCH_CNT);
            $('#resultList').empty().append(result.appendHtml);
            $('#resultPage').empty().append(makePage(result.nowPage, result.totalPage, result.listViewCount, ''));
        } else {
            $('#searchMemCount').text(0);
            $('#resultList').empty();
            $('.empty').show();
        }
    } else {
        $('#searchMemCount').text(0);
        $('#resultList').empty();
        $('.empty').show();
    }
}