<?php
namespace HQ\LinepayApi\Request;

/**
 * Class ReservePayment
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class ReservePayment extends RequestAbstract {

	protected $_path = 'payments/request';
	protected $_method = self::METHOD_POST;

	protected $_mandatoryParams = [
		'productName',
		'amount',
		'currency',
		'confirmUrl',
		'orderId'
	];

	protected $_optionalParams = [
		'mid',
		'productImageUrl',
		'confirmUrlType', // CLIENT: A user based URL (default), SERVER: A server based URL. Users just need to check the payment information screen in LINE Pay which then notifies the Merchant server that the payment is available.
		'cancelUrl',
		'payType', // NORMAL: Single payment (default), PREAPPROVED: Preapproved payment
		'langCd', // ja: Japanese, ko: Korean, en: English, zh-Hans: Chinese (Simplified), zh-Hant: Chinese (Traditional), th: Thai
		'capture' // (boolean) Whether to capture or not
	];

}