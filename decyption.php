<?php

//echo $_POST["user"];
if(isset($_POST['user'] , $_POST['pass'])){

    echo json_encode(array('status' => '1','User'=> oNatEncryption($_POST['user']),'Pass'=> oNatEncryption($_POST['pass'])));

}else{
    echo json_encode(array('status' => '0','message'=> "Error insert data! mix"));
}



function oNatDncryption($plaintext){

//    $plaintext = 'My secret message 1234';
    $password = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
    $password = substr(hash('sha256', $password, true), 0, 32);
//    echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
//    $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));

// My secret message 1234
    $decrypted = openssl_decrypt(base64_decode($plaintext), $method, $password, OPENSSL_RAW_DATA, $iv);
//
//    echo 'plaintext=' . $plaintext . "\n";
//    echo 'cipher=' . $method . "\n";
//    echo 'encrypted to: ' . $plaintext . "\n";
//    echo 'decrypted to: ' . $decrypted . "\n\n";
    return $decrypted;

}

?>



