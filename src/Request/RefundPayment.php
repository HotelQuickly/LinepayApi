<?php
namespace HQ\LinepayApi\Request;

/**
 * Class RefundPayment
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RefundPayment extends RequestAbstract {

	protected $_path = 'payments/[transactionId]/refund';
	protected $_method = self::METHOD_POST;

	protected $_mandatoryParams = [
		'refundAmount',
	];

}