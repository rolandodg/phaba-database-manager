<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table(
            'user',
            array('id' => false, 'primary_key' => 'id')
        );
        $table->addColumn(
            'id',
            'integer',
            array('identity' => true, 'limit' => 11)
        )
            ->addColumn('firstName', 'string', array('limit' => 45))
            ->addColumn('lastName', 'string', array('limit' => 45, 'null' => true))
            ->addColumn('job', 'string', array('limit' => 45))
            ->addColumn('residence', 'string', array('limit' => 45))
            ->addColumn('money', 'integer', array('limit' => 11))
            ->create();
    }
}
