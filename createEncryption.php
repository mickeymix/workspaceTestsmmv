<?php

//echo $_POST["user"];
if(isset($_POST['user'] , $_POST['pass'],$_POST['keytype'])){

    echo json_encode(array('status' => '1','User'=> oNatEncryption($_POST['user'],$_POST['keytype']),'Pass'=> oNatEncryption($_POST['pass'],$_POST['keytype'])));

}else{
    echo json_encode(array('status' => '0','message'=> "Error insert data! "));
}




function oNatEncryption($plaintext,$keyType){

    if (0 === $keyType){
        $password = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    }else{
        $password = 'gv[u:uc=mcvofNgmiflesiy[gfaot0Ut';
    }
    $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
    $password = substr(hash('sha256', $password, true), 0, 32);
//    echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
    return base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));

}

?>



