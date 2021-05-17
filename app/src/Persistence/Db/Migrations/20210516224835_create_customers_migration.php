<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateCustomersMigration extends AbstractMigration
{
    /**
     * Change Method.
     */
    public function change(): void
    {
        // create the table
        $this->table('customers')
            ->addColumn('user_id', 'integer', ['null' => true])
            ->addForeignKey('user_id', 'users', 'id',
                ['delete' => 'SET_NULL', 'update' => 'NO_ACTION']
            )
            ->addColumn('discount', 'integer', ['default' => 0])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addColumn('deleted_at', 'datetime', ['null' => true])
            ->create();
    }
}
