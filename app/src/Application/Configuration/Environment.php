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
            array_key_exists('env', $this->config) &&
            $this->config['env'] === 'development'
        );
    }
}
