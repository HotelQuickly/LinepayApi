<?php

namespace HQ\LinepayApi\Request;

/**
 * Class RequestAbstract
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
abstract class RequestAbstract {

	const METHOD_POST = 'POST';
	const METHOD_GET = 'GET';

	protected $apiBaseUrl;
	protected $channelId;
	protected $channelSecretKey;

	protected $params = [];

	protected $_path;
	protected $_method;
	protected $_mandatoryParams = [];
	protected $_optionalParams = [];

	public function __construct(
		$apiBaseUrl,
		$channelId,
		$channelSecretKey
	) {
		$this->apiBaseUrl = $apiBaseUrl;
		$this->channelId = $channelId;
		$this->channelSecretKey = $channelSecretKey;
	}

	public function getFullRequestUrl()
	{
		return $this->apiBaseUrl .'/'. $this->_path;
	}

	public function getMethod()
	{
		return $this->_method;
	}

	public function getHeader()
	{
		return [
			'Content-Type: application/json; charset=UTF-8',
			'X-LINE-ChannelId: ' . $this->channelId,
			'X-LINE-ChannelSecret: ' . $this->channelSecretKey,
		];
	}

	public function buildParams()
	{
		$string = '';
		foreach ($this->params as $k=>$v) {
			$string .= $k.'='.$v.'&';
		}
		return rtrim($string, '&');
	}

	public function getParams()
	{
		return $this->params;
	}

	public function setUrlParam($name, $value)
	{
		if ( !in_array($name, $this->getRequiredUrlParams()) ) {
			throw new \Exception("Trying to set un-allowed urlParam: {$name}");
		}
		$this->_path = str_replace('['.$name.']', $value, $this->_path);

		return $this;
	}

	public function setParam($name, $value)
	{
		if ( !in_array($name, $this->getKeys($this->_mandatoryParams)) AND !in_array($name, $this->getKeys($this->_optionalParams)) ) {
			throw new \Exception("Trying to set un-allowed param: {$name}");
		}
		$this->params[$name] = $value;

		return $this;
	}

	public function getParam($name)
	{
		if ( !in_array($name, $this->getKeys($this->params)) ) {
			throw new \Exception("Trying to get unknown param: {$name}");
		}
		return $this->params[$name];
	}

	public function validateRequest()
	{
		// validate if required urlParams replaced in $_path
		$requiredUrlParams = $this->getRequiredUrlParams();
		if ( !empty($requiredUrlParams) ) {
			throw new \Exception("Missing parameter in URL: ". $this->_path);
		}

		// validate mandatoryParams
		$missingParamArray = array_diff_key($this->getKeys($this->_mandatoryParams), $this->getKeys($this->params));
		if ( !empty($missingParamArray) ) {
			throw new \Exception("Missing mandatory params: ". implode(',', $missingParamArray));
		}
	}

	public function handleResponse($apiResponse)
	{
		$jsonDecoded = json_decode($apiResponse);
		if ( empty($jsonDecoded) ) {
			throw new \Exception("Cannot decode to JSON format:". $apiResponse);
		}

		return $jsonDecoded;
	}

	private function getKeys(array $data)
	{
		$keys = [];
		foreach($data as $key => $val) {
			$keys[] = is_string($key) ? $key : $val;
		}

		return $keys;
	}

	private function getRequiredUrlParams()
	{
		preg_match_all('/\[([^\]]+)\]/', $this->_path, $matches);
		return $matches[1];
	}
}