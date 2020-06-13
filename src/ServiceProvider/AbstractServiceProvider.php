<?php

namespace Application\ServiceProvider;

use Pimple\ServiceProviderInterface;
use Respect\Validation\Exceptions\AllOfException;
use Slim\Collection;

abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    private $settings;

    public function __construct(Collection $settings)
    {
        try{
            $settings = $settings->get($this->configurationKey());
            $settings = $settings ?? [];
            $this->validate($settings);
            $this->settings = $settings;
        }catch (AllOfException $e){
            throw new \RuntimeException("Configuration is invalid. Reason : {$e->getFullMessage()}");
        }
    }

    protected function settings(): array
    {
        return $this->settings;
    }

    abstract protected function configurationKey(): string;

    abstract protected function validate(array $settings):void;
}