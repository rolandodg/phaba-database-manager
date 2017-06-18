<?php

use Phinx\Migration\AbstractMigration;

class CreateSeveralFieldsTypesTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('several_fields_types');
        $table->addColumn('big_integer_field', 'biginteger')
            ->addColumn('integer_field', 'integer')
            ->addColumn('boolean_field', 'boolean')
            ->addColumn('decimal_field', 'decimal')
            ->addColumn('float_field', 'float')
            ->create();
    }
}
