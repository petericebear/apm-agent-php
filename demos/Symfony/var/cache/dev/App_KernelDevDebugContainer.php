<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerJaiVJpe\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerJaiVJpe/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerJaiVJpe.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerJaiVJpe\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerJaiVJpe\App_KernelDevDebugContainer([
    'container.build_hash' => 'JaiVJpe',
    'container.build_id' => '4a7fdf70',
    'container.build_time' => 1658758091,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerJaiVJpe');
