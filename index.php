<?php
$action = isset($_GET['action']) ? $_GET['action'] : NULL;
$password = 'MyKey';
$method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
$password = substr(hash('sha256', $password, true), 0, 32);
echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
$encrypted = base64_encode(openssl_encrypt($action, $method, $password, OPENSSL_RAW_DATA, $iv));

// My secret message 1234
$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);

echo 'plaintext=' . $action . "\n";
echo 'cipher=' . $method . "\n";
echo 'encrypted to: ' . $encrypted . "\n";
echo 'decrypted to: ' . $decrypted . "\n\n";

?>


<html>
<body>
<div style="text-align: center;">
    <h3>WebView</h3>
    <input type="text" id="textBox" ><?php echo $action ?></br>
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