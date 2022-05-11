<?php

namespace Ineph\NotificationBundle;

use Ineph\NotificationBundle\DependencyInjection\Compiler\ResolveTargetEntitiesPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

/**
 * InephNotificationBundle
 *
 * A simple Symfony 5 bundle for user notifications
 *
 * @author    Nephtali Nlandu <nephtalinlandu@gmail.com>
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/Nephtali53/notification-bundle Repo for this bundle
 */
class InephNotificationBundle extends Bundle
{
    public function build(ContainerBuilder $container){
        parent::build($container);
        $container->addCompilerPass(new ResolveTargetEntitiesPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
    }


    /*public function getPath(): string
    {
        return \dirname(__DIR__);
    }*/
}
