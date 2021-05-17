<?php


namespace Barkyn\Application\Configuration;


use Barkyn\Infrastructure\Config\ConfigLoader;

abstract class BaseConfigurationInstance
{
    /**
     * @var array $config Global config
     */
    protected array $config;

    /**
     * EnvConfig constructor.
     *
     * @param ConfigLoader $config
     */
    public function __construct(ConfigLoader $config)
    {
        $this->config = $config->loadConfig();
    }
}
