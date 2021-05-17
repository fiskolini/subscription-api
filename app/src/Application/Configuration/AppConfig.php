<?php


namespace Barkyn\Application\Configuration;


class AppConfig extends BaseConfigurationInstance
{
    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->config['root_directory'] ?? '';
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->config['token'] ?? '';
    }
}
