<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAx9Ryns\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAx9Ryns/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerAx9Ryns.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerAx9Ryns\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerAx9Ryns\App_KernelDevDebugContainer([
    'container.build_hash' => 'Ax9Ryns',
    'container.build_id' => '2044aafe',
    'container.build_time' => 1583691755,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAx9Ryns');
