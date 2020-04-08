<?php
function oNatDecryption($keyType,$headerKey,$passwordValue){

    if ("0" === $keyType){
        $keyForEncryption = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    }else if ("1" === $keyType){
        $keyForEncryption = 'gv[u:uc=mcvofNgmiflesiy[gfaot0Ut';
    }else{
        return false;
    }

    $method = 'aes-256-cbc';

    $keyForEncryption = substr(hash('sha256', $keyForEncryption, true), 0, 32);
//    echo "Password:" . $keyForEncryption . "\n";

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $keyForDecryption2 =  openssl_decrypt(base64_decode($headerKey), $method, $keyForEncryption, OPENSSL_RAW_DATA, $iv);

    $keyForEncryptionHash2 = substr(hash('sha256', $keyForDecryption2, true), 0, 32);

    return  openssl_decrypt(base64_decode($passwordValue), $method, $keyForEncryptionHash2, OPENSSL_RAW_DATA, $iv);
}

?>
