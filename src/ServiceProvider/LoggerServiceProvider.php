<?php

namespace Application\ServiceProvider;

use Respect\Validation\Validator as v;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Pimple\Container;
use Psr\Log\LoggerInterface;

class LoggerServiceProvider extends AbstractServiceProvider
{

    final public function register(Container $container)
    {
        $settings = $this->settings();
        $container[LoggerInterface::class] = new Logger('main', [
                new RotatingFileHandler("{$settings['path']}/error.log")
            ]
        );
    }

    protected function configurationKey(): string
    {
        return 'logger';
    }

    protected function validate(array $settings): void
    {
        v::key('path', v::stringType()->notEmpty()->directory()->exists())
            ->check($settings);
    }
}