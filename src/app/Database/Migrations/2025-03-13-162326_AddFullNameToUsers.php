<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;
use Config\Auth;

class AddFullNameToUsers extends Migration
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
            'last_name' => ['type' => 'VARCHAR', 'constraint' => '150', 'null' => false],
            'first_name' => ['type' => 'VARCHAR', 'constraint' => '150', 'null' => false],
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down()
    {
        $fields = [
            'last_name',
            'first_name',
        ];
        $this->forge->dropColumn($this->tables['users'], $fields);
    }
}
