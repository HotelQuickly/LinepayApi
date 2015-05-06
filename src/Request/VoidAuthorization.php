<?php
namespace HQ\LinepayApi\Request;

/**
 * Class VoidAuthorization
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class VoidAuthorization extends RequestAbstract {

	protected $_path = 'payments/authorizations/[transactionId]/void';
	protected $_method = self::METHOD_POST;

}