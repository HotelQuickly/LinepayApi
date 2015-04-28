<?php

namespace HQ\LinepayApi;

/**
 * Class RequestFactory
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RequestFactory
{
	// These const are Request Names
	const RESERVE_PAYMENT = 'ReservePayment';
	const CONFIRM_PAYMENT = 'ConfirmPayment';

	private $apiBaseUrl;
	private $channelId;
	private $channelSecretKey;

	/**
	 * @param $apiBaseUrl
	 * @param $channelId
	 * @param $channelSecretKey
	 */
	public function __construct(
		$apiBaseUrl,
		$channelId,
		$channelSecretKey
	) {
		$this->apiBaseUrl = $apiBaseUrl;
		$this->channelId = $channelId;
		$this->channelSecretKey = $channelSecretKey;
	}

	/**
	 * @return string
	 */
	public function getVerifyKey()
	{
		return $this->channelSecretKey;
	}

	/**
	 * @param $requestName
	 * @return mixed
	 */
	public function create($requestName)
	{
		$class = __NAMESPACE__ . '\Request\\' . $requestName;
		return new $class(
			$this->apiBaseUrl,
			$this->channelId,
			$this->channelSecretKey
		);
	}
}