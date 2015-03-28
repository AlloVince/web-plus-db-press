<?php
namespace Acme\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
   public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('acme_demo');

        $rootNode
            ->children()
                ->arrayNode('business_hours')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('span')
                            ->isRequired()->end()
                        ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}