<?php


namespace Barkyn\Application;

use DI\Container;
use DI\ContainerBuilder;
use Exception;

class DiContainer
{
    /**
     * @var ContainerBuilder DI Builder Instance
     */
    private ContainerBuilder $containerBuilder;

    /**
     * DiContainer constructor.
     */
    public function __construct()
    {
        $this->containerBuilder = new ContainerBuilder();
    }

    /**
     * @return Container
     * @throws Exception
     */
    public function build(): Container
    {
        return $this->containerBuilder
            ->addDefinitions(__DIR__ . '/Bootstrap/container.php')
            ->build();
    }
}
