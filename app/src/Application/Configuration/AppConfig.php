<?php


namespace Barkyn\Application\Configuration;


class AppConfig extends BaseConfigurationInstance
{
    /**
     * @return string
     */
    public function getRootDir(): string
    {
        return $this->config['ROOT_DIR'] ?? '';
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->config['BEARER_TOKEN'] ?? '';
    }
}
