<?php

namespace ContainerJaiVJpe;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getListUsersCommand_LazyService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.App\Command\ListUsersCommand.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/LazyCommand.php';

        return $container->privates['.App\\Command\\ListUsersCommand.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('app:list-users', [0 => 'app:users'], 'Lists all the existing users', false, #[\Closure(name: 'App\\Command\\ListUsersCommand')] function () use ($container): \App\Command\ListUsersCommand {
            return ($container->privates['App\\Command\\ListUsersCommand'] ?? $container->load('getListUsersCommandService'));
        });
    }
}
