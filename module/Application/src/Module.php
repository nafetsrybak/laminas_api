<?php

declare(strict_types=1);

namespace Application;

use Laminas\Http\PhpEnvironment\Request;
use Laminas\Mvc\MvcEvent;

class Module
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }


    /**
     * @param MvcEvent $e The MvcEvent instance
     * @return void
     */
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getParam('application');
        $app->getEventManager()->attach('dispatch', [$this, 'attachFakeIdToPatchMethod'], 100);
    }

    public function attachFakeIdToPatchMethod(MvcEvent $e)
    {
        $matches = $e->getRouteMatch();
        /** @var Request $request */
        $request = $e->getRequest();

        if (
            $request->isPatch() ||
            $request->isPut() ||
            $request->isDelete()
        ) {
            $matches->setParam(
                'id',
                0
            );
        }
    }
}
