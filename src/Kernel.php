<?php


namespace Application;

use Slim\App;
use Slim\Collection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;

class Kernel
{
    const KERNEL_MODES = ["prod", "dev"];

    /** @var App */
    private $application;
    /** @var string */
    private $resourceFolder;
    /** @var string */
    private $kernelMode;
    /** @var string */
    private $configFilePath;

    public function __construct(string $kernelMode, string $resourceFolder)
    {
        if (!in_array($kernelMode, self::KERNEL_MODES)) {
            throw new \RuntimeException("Kernel boot failed. Mode '$kernelMode' is not supported. Only " . implode(", ", self::KERNEL_MODES));
        }
        if (!is_dir($resourceFolder)) {
            throw new \RuntimeException("Kernel boot failed. Folder '$resourceFolder' does not exist.");
        }

        $filePath = "{$resourceFolder}/config.yaml";
        if (!file_exists($filePath)) {
            throw new \RuntimeException("Kernel boot failed. Configuration file '$filePath' does not exist.");
        }

        $this->application = new \Slim\App();

        $this->configFilePath = $filePath;
        $this->resourceFolder = $resourceFolder;
        $this->kernelMode = $kernelMode;
    }

    final public function loadRouting(): self
    {
        $app = $this->application; /* used in routes.php */
        require "{$this->resourceFolder}/routes.php";
        return $this;
    }

    final public function loadConfigurations(): self
    {
        $encoder = new YamlEncoder();
        $yaml = file_get_contents($this->configFilePath);
        $config = $encoder->decode($yaml, YamlEncoder::FORMAT);

        /** @var Collection $settings */
        $settings = $this->application->getContainer()->get('settings');
        $settings->replace($config);
        return $this;
    }

    private function isInDevelopmentMode(): bool
    {
        return $this->kernelMode === 'dev';
    }

    private function loadServiceProviders(): self
    {
        $container = $this->application->getContainer();

        $providers = (new Finder())
            ->in("{$this->getRootFolder()}/src/ServiceProvider")
            ->name("*ServiceProvider.php")
            ->notName("Abstract*")
            ->getIterator();

        foreach ($providers as $provider){
            $className = __NAMESPACE__ . "\\ServiceProvider\\{$provider->getFilenameWithoutExtension()}";
            $container->register(new $className($container['settings']));
        }
        return $this;
    }

    public function run(): void
    {
        $this
            ->loadConfigurations()
            ->loadServiceProviders()
            ->loadRouting();

        $this->application->run();
    }

    /**
     * @return string
     */
    private function getRootFolder(): string
    {
        return dirname(__DIR__);
    }

}