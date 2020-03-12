<?php

namespace ESMS;

use Exception;
use GuzzleHttp\Client;

class EsmsProvider extends EsmsCore
{
    const defaultUrl = 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?';
    const phone = 'Phone';
    const content = 'Content';
    const apiKey = 'ApiKey';
    const secretKey = 'SecretKey';
    const isUnicode = 'IsUnicode';
    const brandName = 'BrandName';
    const smsType = 'SmsType';
    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';

    public function send($url, $phone, $content, $apiKey, $secretKey, $isUnicode, $brandName = [], $smsType, $httpMethod)
    {
        if (!$url || empty($url)) {
            $url = $this::defaultUrl;
        }

        if ($httpMethod == $this::GET_METHOD) {
            $client = new Client([
                'base_uri' => $url .
                    $this::phone . $phone .
                    $this::content . $content .
                    $this::apiKey . $apiKey .
                    $this::secretKey . $secretKey .
                    $this::isUnicode . $isUnicode .
                    $this::brandName . $brandName .
                    $this::smsType . $smsType,
            ]);
            return $client->request($httpMethod);
        }

        if ($httpMethod == $this::POST_METHOD) {
            // TODO
            return $client->request($httpMethod);
        }

        return new Exception('Send SMS failed');
    }
}
