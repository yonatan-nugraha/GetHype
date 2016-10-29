<?php

namespace App\Veritrans;
use App\Exceptions\VeritransException;

Class Veritrans
{

	/**
   	* Your merchant's server key
   	* @static
   	*/
	public static $serverKey;

    /**
    * Your merchant's client key
    * @static
    */
    public static $clientKey;
	
	/**
   	* true for production
   	* false for sandbox mode
   	* @static
   	*/
	public static $isProduction = false;

   	/**
   	* Default options for every request
   	* @static
   	*/
  	public static $curlOptions = array();	

  	const SANDBOX_BASE_URL = 'https://api.sandbox.veritrans.co.id/v2';
  	const PRODUCTION_BASE_URL = 'https://api.veritrans.co.id/v2';

    const SNAP_SANDBOX_BASE_URL = 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    const SNAP_PRODUCTION_BASE_URL = 'https://app.midtrans.com/snap/v1/transactions';
    const SNAP_SANDBOX_JS_URL = 'https://app.sandbox.midtrans.com/snap/snap.js';
    const SNAP_PRODUCTION_JS_URL = 'https://app.midtrans.com/snap/snap.js';

    public function config($params)
    {
        Veritrans::$serverKey = $params['server_key'];
        Veritrans::$clientKey = $params['client_key'];
        Veritrans::$isProduction = $params['production'];
    }

    /**
    * @return string Veritrans API URL, depends on $isProduction
    */
  	public static function getBaseUrl()
  	{
    	return Veritrans::$isProduction ?
        	Veritrans::PRODUCTION_BASE_URL : Veritrans::SANDBOX_BASE_URL;
  	}

    /**
    * @return string Snap API URL, depends on $isProduction
    */
    public static function getSnapBaseUrl()
    {
        return Veritrans::$isProduction ?
            Veritrans::SNAP_PRODUCTION_BASE_URL : Veritrans::SNAP_SANDBOX_BASE_URL;
    }

    /**
    * @return string Snap Js URL, depends on $isProduction
    */
    public static function getSnapJsUrl()
    {
        return Veritrans::$isProduction ?
            Veritrans::SNAP_PRODUCTION_JS_URL : Veritrans::SNAP_SANDBOX_JS_URL;
    }

  	/**
	 * Send GET request
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 */
	public static function get($url, $server_key, $data_hash)
	{
	  return self::remoteCall($url, $server_key, $data_hash, false);
	}

	/**
	 * Send POST request
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 */
	public static function post($url, $server_key, $data_hash)
	{
	    return self::remoteCall($url, $server_key, $data_hash, true);
	}

  	/**
	 * Actually send request to API server
	 * @param string  $url
	 * @param string  $server_key
	 * @param mixed[] $data_hash
	 * @param bool    $post
	 */
    public static function remoteCall($url, $server_key, $data_hash, $post = true)
    {	
	    $ch = curl_init();

	    $curl_options = array(
	        CURLOPT_URL => $url,
	        CURLOPT_HTTPHEADER => array(
	           'Content-Type: application/json',
	           'Accept: application/json',
	           'Authorization: Basic ' . base64_encode($server_key . ':')
	        ),
	        CURLOPT_RETURNTRANSFER => 1,
	        CURLOPT_CAINFO => dirname(__FILE__) . "/data/cacert.pem"
	    );

	    // merging with Veritrans_Config::$curlOptions
	    if (count(Veritrans::$curlOptions)) {
	        // We need to combine headers manually, because it's array and it will no be merged
	        if (Veritrans::$curlOptions[CURLOPT_HTTPHEADER]) {
	            $mergedHeders = array_merge($curl_options[CURLOPT_HTTPHEADER], Veritrans::$curlOptions[CURLOPT_HTTPHEADER]);
	            $headerOptions = array( CURLOPT_HTTPHEADER => $mergedHeders );
	        } else {
	            $mergedHeders = array();
	        }

	        $curl_options = array_replace_recursive($curl_options, Veritrans::$curlOptions, $headerOptions);
	    }

	    if ($post) {
	        $curl_options[CURLOPT_POST] = 1;

	        if ($data_hash) {
	            $body = json_encode($data_hash);
	            $curl_options[CURLOPT_POSTFIELDS] = $body;
	        } else {
	            $curl_options[CURLOPT_POSTFIELDS] = '';
	        }
	    }

	    curl_setopt_array($ch, $curl_options);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	    $result = curl_exec($ch);
        $info = curl_getinfo($ch);

	    // curl_close($ch);
	   
	    if ($result === FALSE) {
	        throw new VeritransException('CURL Error: ' . curl_error($ch), curl_errno($ch));
	    }
	    else {
	        $result_array = json_decode($result);
          // dd($result_array);

	        // if (isset($result_array->status_code) && !in_array($result_array->status_code, array(200, 201, 202, 407))) {
	        //     $message = 'Veritrans Error (' . $result_array->status_code . '): '. $result_array->status_message;
         //        throw new VeritransException($message, $result_array->status_code);
	        // }
            if (!in_array($info['http_code'], array(200, 201, 202, 407))) {
                $message = 'Veritrans Error (' . $info['http_code'] . '): '. implode(',', $result_array->error_messages);
                throw new VeritransException($message, $info['http_code']);
            } 
            else {
	            return $result_array;
	        }
	    }
    }

    /**
    * Create VTWeb payment page
    *
    * @param array $payloads Veritrans payloads
    * @return string VTWeb redirect url.
    */
    public function vtweb_charge($payloads)
    {	
    	$result = Veritrans::post(
            Veritrans::getBaseUrl() . '/charge',
            Veritrans::$serverKey,
            $payloads);

        return $result->redirect_url;
    }

    /**
    * Create VTDirect payment page
    *
    * @param array $payloads Veritrans payloads
    * @return string VTDirect result.
    */
    public function vtdirect_charge($payloads)
    { 
        return Veritrans::post(
            Veritrans::getBaseUrl() . '/charge',
            Veritrans::$serverKey,
            $payloads);
    }

    /**
   	* Retrieve transaction status
   	* @param string $id Order ID or transaction ID
    * @return mixed[]
    */
	public static function status($id)
 	{
    	return Veritrans::get(
        	Veritrans::getBaseUrl() . '/' . $id . '/status',
        	Veritrans::$serverKey,
        	false);
  	}

  	/**
   	* Appove challenge transaction
   	* @param string $id Order ID or transaction ID
   	* @return string
   	*/
  	public static function approve($id)
  	{
    	return Veritrans::post(
        	Veritrans::getBaseUrl() . '/' . $id . '/approve',
        	Veritrans::$serverKey,
        	false)->status_code;
  	}

  	/**
   	* Cancel transaction before it's setteled
   	* @param string $id Order ID or transaction ID
   	* @return string
   	*/
  	public static function cancel($id)
  	{
    	return Veritrans::post(
        	Veritrans::getBaseUrl() . '/' . $id . '/cancel',
        	Veritrans::$serverKey,
        	false)->status_code;
  	}

   /**
    * Expire transaction before it's setteled
    * @param string $id Order ID or transaction ID
    * @return mixed[]
    */
  	public static function expire($id)
  	{
    	return Veritrans::post(
        	Veritrans::getBaseUrl() . '/' . $id . '/expire',
        	Veritrans::$serverKey,
        	false);
  	}

    /**
    * Create Snap payment page
    *
    * @param array $payloads Midtrans payloads
    * @return string Snap token.
    * @throws Exception curl error or veritrans error
    */
    public static function getSnapToken($payloads)
    {
        $result = Veritrans::post(
            Veritrans::getSnapBaseUrl(),
            Veritrans::$serverKey, 
            $payloads);

        return $result->token;
    }

}