<?php

abstract class MultimediaUtils {

	public static function fetchMIME($url) {
		$client = new GuzzleHttp\Client;

		$response = $client->request('HEAD', $url);

		if($response->getStatusCode() !== 200) {
			throw new Exception(sprintf(
				'Unexpected status code "%s %s" for request',
				$response->getStatusCode(),
				$response->getReasonPhrase()
			), 1);
		}

		$mime = $response->getHeaderLine('content-type');
		list($mime) = explode(';', $mime, 2);

		return $mime ? $mime : 'application/octet-stream';
	}

}
