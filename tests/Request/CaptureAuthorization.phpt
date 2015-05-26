<?php

namespace Tests;

use HQ\LinepayApi\Request\CaptureAuthorization;
use HQ\LinepayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class CaptureAuthorizationTest extends BaseTestCase
{
	/** @var  \HQ\LinepayApi\Manager */
	private $linepayManager;

	public function setUp()
	{
		$this->linepayManager = $this->container->getByType('HQ\LinepayApi\Manager');
	}

	public function testCaptureAuthorization()
	{
		$response = $this->linepayManager->send(RequestFactory::CAPTURE_AUTHORIZATION, function(CaptureAuthorization$request) {
			$request->setUrlParam('transactionId', '2015049910000934410')
				->setParam('amount', '1.1')
				->setParam('currency', 'USD');
		});

		Assert::true(in_array($response->returnCode, array(1150, 1106)));
	}
}

$test = new CaptureAuthorizationTest($container);
$test->run();