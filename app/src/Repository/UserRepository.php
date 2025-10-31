<?php

namespace App\Framework\Repository;

use App\Framework\Infra\Connection\DB;

class UserRepository extends Repository{

    public function __construct(){
    }

    public function save(array $data): int {

        $data['senha'] = password_hash($data['senha'], PASSWORD_ARGON2ID);

        return DB::getInstance()
            ->table(parent::$table)
            ->create($data)
            ->getLastInsertId();
    }
}