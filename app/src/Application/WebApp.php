<?php


namespace Barkyn\Application;


use Barkyn\Infrastructure\Http\WebKernel;
use Barkyn\Persistence\PersistenceLoader;

class WebApp
{
    /**
     * @var WebKernel $kernel
     */
    private WebKernel $kernel;

    /**
     * @var PersistenceLoader $persistenceLoader
     */
    private PersistenceLoader $persistenceLoader;

    /**
     * WebApp constructor.
     *
     * @param WebKernel         $kernel
     * @param PersistenceLoader $persistenceLoader
     */
    public function __construct(WebKernel $kernel, PersistenceLoader $persistenceLoader)
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
