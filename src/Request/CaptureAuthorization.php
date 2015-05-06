<?php
namespace HQ\LinepayApi\Request;

/**
 * Class CaptureAuthorization
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class CaptureAuthorization extends RequestAbstract {

	protected $_path = 'payments/authorizations/[transactionId]/capture';
	protected $_method = self::METHOD_POST;

	protected $_mandatoryParams = [
		'amount',
		'currency'
	];

}