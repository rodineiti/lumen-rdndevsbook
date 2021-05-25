<?php

namespace App\Support;

class SupportCurl
{
    private static $curl;

    public static function curl_get(string $url)
    {
        self::$curl = curl_init();

        curl_setopt_array(self::$curl, [
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec(self::$curl);

        if($response === false)
        {
            return json_encode(['status' => false, 'message' => curl_error(self::$curl)]);            
        }
        
        return $response;
        curl_close(self::$curl);
    }
}