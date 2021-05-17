<?php

namespace Barkyn\Infrastructure\Config;

use Dotenv\Dotenv;

final class ConfigLoader
{
    /**
     * @var string $rootDir Path to .env file
     */
    private string $rootDir;

    /**
     * @var Dotenv $dotenv Dotenv instance
     */
    private Dotenv $dotenv;

    /**
     * @var array $config .env config
     */
    private static array $config = [];

    /**
     * ConfigLoader constructor.
     *
     * @param string $rootDir
     */
    public function __construct(string $rootDir)
    {
        $this->dotenv = Dotenv::createUnsafeImmutable(
            $this->rootDir = $rootDir
        );
    }

    /**
     * Load .env config
     */
    public function loadConfig(): array
    {
        if (!empty(self::$config))
            return self::$config;

        return self::$config = array_merge(
            $this->dotenv->load(),
            $this->initialConfiguration()
        );
    }

    /**
     * Return the initial configuration. Usually, some configuration that does not
     * exists under .env file
     *
     * @return string[]
     */
    private function initialConfiguration(): array
    {
        return [
            'ROOT_DIR' => $this->rootDir
        ];
    }
}
