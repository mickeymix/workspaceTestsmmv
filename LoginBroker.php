<?php
include('phpseclib1/Crypt/RSA.php');
if (isset($_POST['deviceId'], $_POST['Broker'], $_POST['Username'], $_POST['Password'])) {

    createLoginBroker($_POST['deviceId'], $_POST['Broker'], $_POST['Username'], $_POST['Password']);
} else {
    echo json_encode(array('status' => '0', 'message' => "Error insert data! "));
}
function createLoginBroker($deviceId, $Broker, $Username, $Password)
{


    $rsa = new Crypt_RSA();
    $rsa->loadKey('-----BEGIN RSA PUBLIC KEY-----
MIIBCgKCAQEA8QycDIwBuKAHz38LHO7HUtnpsD4jDqaNtxbIDOYLYBDIRyjlrLGY
Dquc/qUTNuEL9AnWc896MQTez/9Sk4PeglNtL4OBbh1+noqLMPCfRPbyKElJP67B
+6u9VvSEjDLfgPr5ODzPvAFp1FgmNqWL/xQhWK2Rw/u8jKGNUd7mR9PXP0IgRNj5
hTMyhdRDe4eJDv6QT8+l3UO8+hiXx5+uRLWlnlzHJ4t7mGC9vYcLGxNhg12x/dHn
sgIEz3vlorE5WelKtjDQutyqe7kWSzmmDYwje/CbpuPoSTFLxb4M2P4DDyVwAmf1
GkIyZeP6/duexzENXE4iTnGuEIcKOo8c8QIDAQAB
-----END RSA PUBLIC KEY-----'); // public key
    $broker = urlencode($Broker);
    $mUserName = urlencode($Username);
    $mPassword = urlencode($Password);
    $today = date("YmdHms");
    $LoginTime = URLEncode($today);
    $plaintext = "Broker=$broker&Username=$mUserName&Password=$mPassword&LoginTime=$LoginTime";

// without the following line PSS mode will be used, which is more secure but less interoperable
    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    $ciphertext = $rsa->encrypt($plaintext);
    $loginToken = bin2hex($ciphertext);

    $ch = curl_init();
    $post = [
        'loginToken' => $loginToken
    ];
    $ch = curl_init('https://afosstest01.angstrom.co.th/iAuth/login');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $headers = [
        'Content-Type:application/x-www-form -urlencoded',
        'Content-Length:157',
        "deviceId:$deviceId",
        'protocolVersion:3'
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// execute!
    $response = curl_exec($ch);
// close the connection, release resources used
    curl_close($ch);
    echo $response;

}