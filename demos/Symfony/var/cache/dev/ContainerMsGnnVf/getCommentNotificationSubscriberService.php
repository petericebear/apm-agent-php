<?php

namespace ContainerMsGnnVf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCommentNotificationSubscriberService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\EventSubscriber\CommentNotificationSubscriber' shared autowired service.
     *
     * @return \App\EventSubscriber\CommentNotificationSubscriber
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/EventSubscriber/CommentNotificationSubscriber.php';

        return $container->privates['App\\EventSubscriber\\CommentNotificationSubscriber'] = new \App\EventSubscriber\CommentNotificationSubscriber(($container->privates['mailer.mailer'] ?? $container->load('getMailer_MailerService')), ($container->services['router'] ?? $container->getRouterService()), ($container->services['translator'] ?? $container->getTranslatorService()), 'anonymous@example.com');
    }
}
