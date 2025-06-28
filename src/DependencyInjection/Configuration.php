<?php

namespace Pixel\PlausibleBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('plausible');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('domain')
                    ->defaultValue('')
                    ->info('Le domaine à analyser dans Plausible')
                ->end()
                ->scalarNode('base_url')
                    ->defaultValue('https://plausible.io')
                    ->info('URL de base de l\'instance Plausible')
                ->end()
                ->scalarNode('auth_key')
                    ->defaultValue('')
                    ->info('Clé d\'authentification pour l\'iframe partagée Plausible')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}