<?php

namespace Tests;

use HQ\LinepayApi\Request\ConfirmPayment;
use HQ\LinepayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class ConfirmPaymentTest extends BaseTestCase
{
	/** @var  \HQ\LinepayApi\Manager */
	private $linepayManager;

	public function setUp()
	{
		$this->linepayManager = $this->container->getByType('HQ\LinepayApi\Manager');
	}

	public function testConfirmPayment()
	{
		$response = $this->linepayManager->send(RequestFactory::CONFIRM_PAYMENT, function(ConfirmPayment $request) {
			$request->setUrlParam('transactionId', '2015049910000934410')
				->setParam('amount', '1.1')
				->setParam('currency', 'USD');
		});

		Assert::true(in_array($response->returnCode, array(1159, 1106)));
	}
}

$test = new ConfirmPaymentTest($container);
$test->run();