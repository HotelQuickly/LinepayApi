<?php

namespace HQ\LinepayApi;
use HQ\LinepayApi\Request\RequestAbstract;

/**
 * Class Sender
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class Sender {

	public function send(RequestAbstract $request)
	{
		$url = $request->getFullRequestUrl();
		$header = $request->getHeader();

		$response = null;
		if ($request->getMethod() === RequestAbstract::METHOD_POST) {
			$response = $this->sendPOST($url, $header, json_encode($request->getParams()));
		} elseif ($request->getMethod() === RequestAbstract::METHOD_GET) {
			$response = $this->sendGET($url, $header, $request->buildParams());
		}

		return $response;
	}

	private function sendPOST($url, array $header, $payload)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);

		if ( $curlError = curl_error($ch) ) {
			throw new \Exception('CURL_ERROR: '. $curlError);
		}

		curl_close($ch);

		return $response;
	}

	private function sendGET($url, array $header, $payload)
	{
		$ch = curl_init($url.'?'.$payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		$response = curl_exec($ch);

		if ( $curlError = curl_error($ch) ) {
			throw new \Exception('CURL_ERROR: '. $curlError);
		}

		curl_close($ch);

		return $response;
	}
}