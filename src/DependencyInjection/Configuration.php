<?php
/**
 * Project: notification-bundle
 * User: Nephtali Nlandu <nephtalinlandu@gmail.com>
 */

namespace Ineph\NotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Ineph\NotificationBundle\Entity\NotificationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('ineph_notification');

        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $rootNode = $treeBuilder->root('ineph_notification');
        }

        $rootNode->children()
            ->scalarNode('notification_class')
                ->cannotBeEmpty()
                ->defaultValue(NotificationInterface::DEFAULT_NOTIFICATION_ENTITY_CLASS)
            ->end()
        ->end();

        return $treeBuilder;
    }
}