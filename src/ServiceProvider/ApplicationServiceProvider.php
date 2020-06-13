<?php

namespace Application\ServiceProvider;

use Application\Http\Controller\MovieController;
use Application\MovieCatalog\Application\Service;
use Application\MovieCatalog\Infrastructure\Hydrator;
use Application\MovieCatalog\Infrastructure\Repository;
use Respect\Validation\Validator as v;
use Pimple\Container;

class ApplicationServiceProvider extends AbstractServiceProvider
{

    final public function register(Container $container)
    {
        $settings = $this->settings();
        $pdo = new \PDO("sqlite:{$settings['path']}", $settings['username'], $settings['password']);
        $repository = new Repository(new Hydrator(), $pdo, $settings['per-page']);
        $service = new Service($repository);

        $container[\PDO::class] = $pdo;
        $container[Repository::class] = $repository;
        $container[Service::class] = $service;
        $container[MovieController::class] = new MovieController($service);
    }

    protected function configurationKey(): string
    {
        return 'database';
    }

    protected function validate(array $settings): void
    {
        v::key('path', v::stringType()->notEmpty()->file()->exists())
            ->key('username', v::stringType())
            ->key('password', v::stringType())
            ->key('per-page', v::intType())
            ->check($settings);
    }
}