<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use Config\Auth;

class AddAttributesToUsers extends Migration
{
    /** @var string[] */
    private array $tables;

    public function __construct(?Forge $forge = null)
    {
        parent::__construct($forge);

        /** @var Auth $authConfig */
        $authConfig = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        $fields = [
            'phone' => ['type' => 'VARCHAR', 'constraint' => '10', 'null' => true],
            'last_name' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
            'name' => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
            'address' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => false],
            'city' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => false],
            'postal_code' => ['type' => 'VARCHAR', 'constraint' => '5', 'null' => false],
            'birth_date' => ['type' => 'DATE', 'null' => false],
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
        $this->forge->addUniqueKey('phone');
    }

    public function down()
    {
        $fields = [
            'phone',
            'last_name',
            'name',
            'address',
            'city',
            'postal_code',
            'birth_date',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
