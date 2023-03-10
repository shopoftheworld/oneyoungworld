<?php

namespace Acquia\Blt\Robo\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Project config.
 */
class ProjectConfiguration implements ConfigurationInterface {

  /**
   * Get config tree builder.
   */
  public function getConfigTreeBuilder() {
    $treeBuilder = new TreeBuilder('recipe');
    $rootNode = $treeBuilder->getRootNode();

    // @codingStandardsIgnoreStart
    $rootNode
      ->children()
        ->scalarNode('human_name')
          ->info('The human readable name of the project.')
          ->cannotBeEmpty()
          ->isRequired()
        ->end()
        ->scalarNode('machine_name')
          ->info('The machine readable name of the project.')
          ->cannotBeEmpty()
          ->isRequired()
        ->end()
        ->scalarNode('prefix')
          ->info('The project prefix, used for commit message validation.')
          ->cannotBeEmpty()
          ->isRequired()
        ->end()
        ->scalarNode('profile')
          ->info('The installation profile.')
          ->cannotBeEmpty()
          ->isRequired()
          ->validate()
            ->ifNotInArray(['standard', 'minimal'])
            ->thenInvalid('Invalid installation profile %s')
          ->end()
        ->end()
        ->booleanNode('vm')
          ->isRequired()
        ->end()
        ->arrayNode('ci')
          ->children()
            ->scalarNode('provider')
              ->isRequired()
              ->cannotBeEmpty()
              ->defaultValue('pipelines')
              ->validate()
                ->ifNotInArray(['pipelines'])
                ->thenInvalid('Invalid continuous integration provider %s')
              ->end()
            ->end()
          ->end()
        ->end()
        ->arrayNode('cm')
          ->children()
            ->scalarNode('strategy')
              ->isRequired()
              ->cannotBeEmpty()
              ->defaultValue('config-split')
              ->validate()
                ->ifNotInArray(['config-split', 'none'])
                ->thenInvalid('Invalid configuration management strategy %s')
              ->end()
            ->end()
          ->end()
        ->end()
        ->arrayNode('ac')
          ->children()
            ->scalarNode('site')
              ->isRequired()
              ->cannotBeEmpty()
            ->end()
            ->scalarNode('env')
              ->isRequired()
              ->cannotBeEmpty()
              ->defaultValue('dev')
            ->end()
          ->end()
        ->end()
        ->arrayNode('ingredients')
          ->info('A flat array of ingredients, e.g. acquia-blog.')
          ->prototype('scalar')
        ->end()
      ->end();
    // @codingStandardsIgnoreEnd

    return $treeBuilder;
  }

}
