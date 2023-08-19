<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    function aa(){
        window.opener.postMessage({code:'1234'}, '*')
    }



</script>

<button onclick="aa()">dddd</button>