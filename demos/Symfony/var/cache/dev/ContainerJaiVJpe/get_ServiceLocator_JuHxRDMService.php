<?php

namespace ContainerJaiVJpe;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_JuHxRDMService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.juHxRDM' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.juHxRDM'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
            'eventDispatcher' => ['services', 'event_dispatcher', 'getEventDispatcherService', false],
            'post' => ['privates', '.errored..service_locator.juHxRDM.App\\Entity\\Post', NULL, 'Cannot autowire service ".service_locator.juHxRDM": it references class "App\\Entity\\Post" but no such service exists.'],
        ], [
            'entityManager' => '?',
            'eventDispatcher' => '?',
            'post' => 'App\\Entity\\Post',
        ]);
    }
}
