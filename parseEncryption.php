<?php

//echo $_POST["user"];
if(isset($_POST['user'] , $_POST['pass'],$_POST['keytype'])){

    echo json_encode(array('status' => '1','User'=> oNatEncryption($_POST['user'],$_POST['keytype']),'Pass'=> oNatEncryption($_POST['pass'],$_POST['keytype'])));

}else{
    echo json_encode(array('status' => '0','message'=> "Error insert data! "));
}




function oNatEncryption($plaintext,$keyType){

    if (0 === $keyType){
        $keyForEncryption = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    }else{
        $keyForEncryption = 'gv[u:uc=mcvofNgmiflesiy[gfaot0Ut';
    }
    $method = 'aes-256-cbc';

    $keyForEncryption = substr(hash('sha256', $keyForEncryption, true), 0, 32);
//    echo "Password:" . $keyForEncryption . "\n";

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $decrypted = openssl_decrypt(base64_decode($plaintext), $method, $keyForEncryption, OPENSSL_RAW_DATA, $iv);

    return $decrypted;

}

?>



