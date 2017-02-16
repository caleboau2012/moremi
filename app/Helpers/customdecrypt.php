<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 1/20/2017
 * Time: 10:17 PM
 * helper class to check for permission and role
 */
if (!function_exists('customdecrypt')) {
    /**
     *
     * @param \Datetime $value
     * @param string    $format
     * @param string    $timezone
     * @return string
     */
    function customdecrypt($decrypted){
        ///This function  encrypt sensitive information like passwords and  other in the database
        $password = config('settings.encryption_key');
        $salt = config('settings.encryption_salt');
        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
        $key = hash('SHA256', $salt . $password, true);
        // Build $iv and $iv_base64.  We use a block size of 128 bits (AES compliant) and CBC mode.  (Note: ECB mode is inadequate as IV is not used.)
        srand();
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
        if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
        // Encrypt $decrypted and an MD5 of $decrypted using $key.  MD5 is fine to use here because it's just to verify successful decryption.
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
// We're done!
        return $iv_base64 . $encrypted;
    }
}