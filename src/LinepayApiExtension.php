<?php
namespace HQ\LinepayApi;
use Nette;
// compatibility for nette 2.0.x and 2.1.x
if (!class_exists('Nette\DI\CompilerExtension')) {
	class_alias('Nette\Config\CompilerExtension', 'Nette\DI\CompilerExtension');
}

/**
 * Class LinepayApiExtension
 *
 * @author Jakapun Kehachindawat <jakapun.kehachindawat@hotelquickly.com>
 */
class LinepayApiExtension extends Nette\DI\CompilerExtension
{
	public $defaults = array(
		'apiBaseUrl' => '',
		'channelId' => '',
		'channelSecretKey' => ''
	);

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		// add service linepayRequestFactory
		$builder->addDefinition('linepayRequestFactory')
			->setClass('\HQ\LinepayApi\RequestFactory', array($config['apiBaseUrl'], $config['channelId'], $config['channelSecretKey']));

		// add service linepayManager
		$builder->addDefinition('linepayManager')
			->setClass('\HQ\LinepayApi\Manager', array('@linepayRequestFactory'));
	}
}