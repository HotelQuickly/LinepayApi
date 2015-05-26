<?php

namespace Tests;

use HQ\LinepayApi\Request\RefundPayment;
use HQ\LinepayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class RefundPaymentTest extends BaseTestCase
{
	/** @var  \HQ\LinepayApi\Manager */
	private $linepayManager;

	public function setUp()
	{
		$this->linepayManager = $this->container->getByType('HQ\LinepayApi\Manager');
	}

	public function testRefundPayment()
	{
		$response = $this->linepayManager->send(RequestFactory::REFUND_PAYMENT, function(RefundPayment $request) {
			$request->setUrlParam('transactionId', '2015049910000934410')
				->setParam('refundAmount', '1.1');
		});

		Assert::equal('1150', $response->returnCode);
	}
}

$test = new RefundPaymentTest($container);
$test->run();