<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change(): void
    {
        // create the table
        $this->table('users')
            ->addColumn('email', 'string', ['limit' => 191])
            ->addColumn('firstname', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('lastName', 'string', ['limit' => 50, 'null' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}
