<?php
namespace HQ\LinepayApi\Request;

/**
 * Class ConfirmPayment
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class ConfirmPayment extends RequestAbstract {

	protected $_path = 'payments/[transactionId]/confirm';
	protected $_method = self::METHOD_POST;

	protected $_mandatoryParams = [
		'amount',
		'currency'
	];

}