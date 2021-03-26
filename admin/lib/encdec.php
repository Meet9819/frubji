<?php

namespace Utility;

class EncryptDecrypt
{
    private static $des_encrypt_key = "bnjibCpf";
    private static $des_encrypt_iv = "8wCtf3As";

    public static function encrypt_data($str)
    {
        $encrypted_str = "";

        if (empty($str)) {
            return $encrypted_str;
        }

        try {
            $blocksize = 8;

            $padding = $blocksize - (strlen($str) % $blocksize);

            $str = $str . str_repeat(chr($padding), $padding);

            $str = openssl_encrypt($str, 'DES-CBC', EncryptDecrypt::$des_encrypt_key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, EncryptDecrypt::$des_encrypt_iv);

            $encrypted_str = bin2hex($str);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $encrypted_str;
    }

    public static function decrypt_data($str)
    {
        $decrypted_str = "";

        if (empty($str)) {
            return $decrypted_str;
        }

        try {
            $decrypted_str = hex2bin($str);

            $decrypted_str = openssl_decrypt($decrypted_str, 'DES-CBC', EncryptDecrypt::$des_encrypt_key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING, EncryptDecrypt::$des_encrypt_iv);

            $padding = ord($decrypted_str[strlen($decrypted_str) - 1]);

            $decrypted_str = substr($decrypted_str, 0, -1 * $padding);

            $decrypted_str = rtrim($decrypted_str);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $decrypted_str;
    }
}
