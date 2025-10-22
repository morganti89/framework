<?php

namespace App\Framework\Repository;

use App\Framework\Infra\Connection\DB;

class Repository {
    
    public function getAll(string $table): array|null {
        
        return DB::getInstance()
            ->table($table)
            ->query()
            ->all();
        
    }

    public function getBy(string $table, array $by): array|bool {
        
        return DB::getInstance()
            ->table($table)
            ->get()
            ->where($by)
            ->prepare()
            ->fetch();
    }

    public function save(string $table, array $data): int {

        return DB::getInstance()
            ->table($table)
            ->create($data)
            ->getLastInsertId();
    }

    public function update(string $table, array $data): int {
         return DB::getInstance()
            ->table($table)
            ->update($data)
            ->rowCount();
    }

    public function delete(string $table, array $data): int { 
        return DB::getInstance()
            ->table($table)
            ->delete($data)
            ->rowCount();
    }

}