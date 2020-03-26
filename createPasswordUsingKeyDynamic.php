<?php

//echo $_POST["user"];
if(isset($_POST['valuePlainText'],$_POST['keytype'])){

    $genKeyDynamic = generateKeyDynamic();

    echo json_encode(array('status' => '1','resultGeneratedKey'=>$genKeyDynamic,'valueAfterEncryption'=> oNatEncryptionPassword($_POST['keytype'],$_POST['valuePlainText'],$genKeyDynamic)[0],'valueKeyEncryption'=> oNatEncryptionPassword($_POST['keytype'],$_POST['valuePlainText'],$genKeyDynamic)[1]));

}else{
    echo json_encode(array('status' => '0','message'=> "Error insert data! "));
}

function generateKeyDynamic(){
    $myDateTime =  DateTime::createFromFormat('yyyyMMddhhmmss', Date());
    return "abc".date('YmdHis')."".generateRandomString(12)."nat";

}
function generateRandomString($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function oNatEncryptionPassword($keyType, $passwordPlaneText,$genKeyDynamic)
{
//    $password = $keyEncryption2;
    if (0 === $keyType){
        $password = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    }else{
        $password = 'gv[u:uc=mcvofNgmiflesiy[gfaot0Ut';
    }
    $method = 'aes-256-cbc';

    $hashKeyOne = substr(hash('sha256', $password, true), 0, 32);

    $hashKeyTwo = substr(hash('sha256', $genKeyDynamic, true), 0, 32);

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encryptValue = base64_encode(openssl_encrypt($passwordPlaneText, $method, $hashKeyTwo, OPENSSL_RAW_DATA, $iv));

    $encryptKeyTwo = base64_encode(openssl_encrypt($genKeyDynamic, $method, $hashKeyOne, OPENSSL_RAW_DATA, $iv));

    return array($encryptValue,$encryptKeyTwo);

}

?>



