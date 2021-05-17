<?php


namespace Barkyn\Application\Configuration;


class Environment extends BaseConfigurationInstance
{
    /**
     * @return bool
     */
    public function isDev(): bool
    {
        return (
            array_key_exists('ENV', $this->config) &&
            $this->config['ENV'] === 'development'
        );
    }
}
