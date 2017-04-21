<?php

final class CSRF {

    public static function token():string {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        //var_dump($token, $_SERVER['HTTP_REFERER'], ROOTURL."/");
        return $token;
    }
}

?>
