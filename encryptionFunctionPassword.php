<?php

function generateKeyDynamic(){

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
    if ("0" === $keyType) {
        $password = 'gv[u:ugvHogvmuF,[kpcvr]bg8=yjo20';
    } else if ("1" === $keyType) {
        $password = 'gv[u:uc=mcvofNgmiflesiy[gfaot0Ut';
    } else {
        return array('invalid Keytype', 'Cannot Encryption');
    }
    $method = 'aes-256-cbc';

    $hashKeyOne = substr(hash('sha256', $password, true), 0, 32);

    $hashKeyTwo = substr(hash('sha256', $genKeyDynamic, true), 0, 32);

// IV must be exact 16 chars (128 bit)
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encryptValue = base64_encode(openssl_encrypt($passwordPlaneText, $method, $hashKeyTwo, OPENSSL_RAW_DATA, $iv));

    $encryptKeyTwo = base64_encode(openssl_encrypt($genKeyDynamic, $method, $hashKeyOne, OPENSSL_RAW_DATA, $iv));

    return array($encryptValue, $encryptKeyTwo);

}
?>
