<?php

namespace App\Framework\Repository;

use App\Framework\Infra\Connection\DB;

class UserRepository extends Repository{

    public function __construct(){
    }

    public function save(string $table, array $data): int {

        $data['senha'] = password_hash($data['senha'], PASSWORD_ARGON2ID);

        return DB::getInstance()
            ->table($table)
            ->create($data)
            ->getLastInsertId();
    }
}