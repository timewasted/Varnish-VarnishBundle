<?php

namespace Varnish\VarnishBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
	/**
	 * Generates the configuration tree.
	 *
	 * @return TreeBuilder
	 */
	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('varnish');

		$this->addAdminSection($rootNode);

		return $treeBuilder;
	}

	private function addAdminSection(ArrayNodeDefinition $node)
	{
		$node
			->children()
				->arrayNode('admin')
					->children()
						->scalarNode('host')->isRequired()->cannotBeEmpty()->end()
						->scalarNode('port')->isRequired()->cannotBeEmpty()->end()
						->scalarNode('secret')->end()
					->end()
				->end()
			->end();
	}
}
