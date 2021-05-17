<?php

namespace Barkyn\Persistence\Db;


use Barkyn\Application\Configuration\DbConfig;
use Illuminate\Database\Capsule\Manager;

class DbRegister
{
    /**
     * @var DbConfig
     */
    private DbConfig $dbConfig;

    /**
     * @var Manager
     */
    private Manager $manager;

    /**
     * DbRegister constructor.
     *
     * @param DbConfig $dbConfig
     */
    public function __construct(DbConfig $dbConfig)
    {
        $this->dbConfig = $dbConfig;
        $this->manager = new Manager();
    }

    /**
     * Register DB
     */
    public function register()
    {
        $this->manager->addConnection([
            'driver'   => 'pgsql',
            'host'     => $this->dbConfig->getHost(),
            'database' => $this->dbConfig->getDatabase(),
            'username' => $this->dbConfig->getUser(),
            'password' => $this->dbConfig->getPassword()
        ]);

        $this->manager->setAsGlobal();
        $this->manager->bootEloquent();
    }
}
