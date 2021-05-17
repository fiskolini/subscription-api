<?php

namespace Barkyn\Persistence;

use Barkyn\Persistence\Db\DbRegister;

class PersistenceLoader
{
    /**
     * @var DbRegister
     */
    private DbRegister $dbRegister;

    /**
     * PersistenceLoader constructor.
     *
     * @param DbRegister $dbRegister
     */
    public function __construct(DbRegister $dbRegister)
    {
        $this->dbRegister = $dbRegister;
    }

    /**
     * Load all persistence layer
     */
    public function load()
    {
        $this->dbRegister->register();
    }
}
