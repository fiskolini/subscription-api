<?php


namespace Barkyn\Application;


use Barkyn\Infrastructure\Http\WebApiKernel;
use Barkyn\Persistence\PersistenceLoader;

class WebApp
{
    /**
     * @var WebApiKernel $kernel
     */
    private WebApiKernel $kernel;

    /**
     * @var PersistenceLoader $persistenceLoader
     */
    private PersistenceLoader $persistenceLoader;

    /**
     * WebApp constructor.
     *
     * @param WebApiKernel      $kernel
     * @param PersistenceLoader $persistenceLoader
     */
    public function __construct(WebApiKernel $kernel, PersistenceLoader $persistenceLoader)
    {
        $this->kernel = $kernel;
        $this->persistenceLoader = $persistenceLoader;
    }

    /**
     * Serve application
     */
    public function serve()
    {
        $this->persistenceLoader->load();
        $this->kernel->run();
    }
}
