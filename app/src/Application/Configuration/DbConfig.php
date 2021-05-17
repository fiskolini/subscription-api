<?php


namespace Barkyn\Application\Configuration;


class DbConfig extends BaseConfigurationInstance
{
    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->config['DB_USER'] ?? '';
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->config['DB_HOST'] ?? '';
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->config['DB_PASSWORD'] ?? '';
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->config['DB_NAME'] ?? '';
    }
}
