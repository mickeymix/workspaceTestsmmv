<?php


//if(isset($_POST['user'] , $_POST['pass'])){

    echo json_encode(array('status' => '1','message'=> "User Decryption is ".oNatDncryption($_POST['user'])." Pass Decryption is ".oNatDncryption($_POST['user']).""));

//}else{
//    echo json_encode(array('status' => '0','message'=> "Error insert data! "));
//}


function oNatDncryption($action){

    $password = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
    $password = substr(hash('sha256', $password, true), 0, 32);
    echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
//$encrypted = base64_encode(openssl_encrypt($action, $method, $password, OPENSSL_RAW_DATA, $iv));

// My secret message 1234
    return openssl_decrypt(base64_decode($action), $method, $password, OPENSSL_RAW_DATA, $iv);

}

?>



