<?php

namespace Varnish\VarnishBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class VarnishExtension extends Extension
{
	public function load(array $configs, ContainerBuilder $container)
	{
		$processor = new Processor();
		$configuration = new Configuration();

		$config = $processor->processConfiguration($configuration, $configs);

		$loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

		$loader->load('varnishadm.xml');

		if( isset($config['admin']) ) {
			$container->setParameter('varnish.admin.host', $config['admin']['host']);
			$container->setParameter('varnish.admin.port', $config['admin']['port']);
			$container->setParameter('varnish.admin.secret', $config['admin']['secret']);
		}
	}
}
