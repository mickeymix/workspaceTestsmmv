<?php
$action = isset($_GET['action']) ? $_GET['action'] : NULL;

?>


<html>
<body>
<div style="text-align: center;">
    <h3>WebView</h3>
    <input type="text" id="textBox" ><?php echo $action?></br>
    <button onclick="showMessage()">Show Message</button>
</div>
<script>

    function setTextField(text) {
        var text = text;

        document.getElementById("textBox").value = text;
    }

    function showMessage() {
        WebViewJS.onHeight();
    }
</script>
</body>
</html>