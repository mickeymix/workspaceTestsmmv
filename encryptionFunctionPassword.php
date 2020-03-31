<?php
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
