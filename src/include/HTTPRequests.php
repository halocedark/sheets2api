<?php  

namespace GoogleSheets2API\HTTPRequest;

class HTTPRequest
{

	public function get($url)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);		
		curl_close($curl);

		return $response;
	}

	public function post($url, $postFields)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postFields));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		//for debug only!
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);		
		curl_close($curl);

		return $response;
	}

}