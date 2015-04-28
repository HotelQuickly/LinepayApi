<?php

namespace Tests;

use HQ\LinepayApi\Request\ReservePayment;
use HQ\LinepayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class ReservePaymentTest extends BaseTestCase
{
	/** @var  \HQ\LinepayApi\Manager */
	private $linepayManager;

	public function setUp()
	{
		$this->linepayManager = $this->container->getByType('HQ\LinepayApi\Manager');
	}

	public function testReservePayment()
	{
		$response = $this->linepayManager->send(RequestFactory::RESERVE_PAYMENT, function(ReservePayment $request) {
			$request->setParam('productName', 'Byte test booking #HQ1234567')
				->setParam('amount', '1.1')
				->setParam('currency', 'USD')
				->setParam('confirmUrl', 'hotelquickly://LinePayDone/?something')
				->setParam('orderId', '#HQ1234567');
		});

		Assert::equal('0000', $response->returnCode);
	}
}

$test = new ReservePaymentTest($container);
$test->run();