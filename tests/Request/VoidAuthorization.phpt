<?php

namespace Tests;

use HQ\LinepayApi\Request\VoidAuthorization;
use HQ\LinepayApi\RequestFactory;
use Nette;
use Tester;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../BaseTestCase.php';
/**
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class VoidAuthorizationTest extends BaseTestCase
{
	/** @var  \HQ\LinepayApi\Manager */
	private $linepayManager;

	public function setUp()
	{
		$this->linepayManager = $this->container->getByType('HQ\LinepayApi\Manager');
	}

	public function testVoidAuthorization()
	{
		$response = $this->linepayManager->send(RequestFactory::VOID_AUTHORIZATION, function(VoidAuthorization $request) {
			$request->setUrlParam('transactionId', '2015049910000934410');
		});

		Assert::equal('1169', $response->returnCode);
	}
}

$test = new VoidAuthorizationTest($container);
$test->run();