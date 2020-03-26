<?php

//echo $_POST["user"];
if(isset($_POST['valuePlainText'],$_POST['key2'])){

    echo json_encode(array('status' => '1','valueAfterEncryption'=> oNatEncryptionPassword($_POST['key2'],$_POST['valuePlainText'])));

}else{
    echo json_encode(array('status' => '0','message'=> "Error insert data! "));
}



function oNatEncryptionPassword($keyEncryption2, $passwordPlaneText)
{
    $password = $keyEncryption2;

    $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
    $password = substr(hash('sha256', $password, true), 0, 32);
//    echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    return base64_encode(openssl_encrypt($passwordPlaneText, $method, $password, OPENSSL_RAW_DATA, $iv));

}

?>



