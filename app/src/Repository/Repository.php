<?php

namespace App\Framework\Repository;

use App\Framework\Infra\Connection\DB;

class Repository {

    protected static $table;

    
    public function setTable(string $table) {
        self::$table = $table;
    }

    public function getAll(): array|null {
        
        return DB::getInstance()
            ->table(self::$table)
            ->query()
            ->all();
        
    }

    public function getBy(array $by): array|bool {

        return DB::getInstance()
            ->table(self::$table)
            ->get()
            ->where($by)
            ->prepare()
            ->fetch();
    }

    public function save(array $data): int {

        return DB::getInstance()
            ->table(self::$table)
            ->create($data)
            ->getLastInsertId();
    }

    public function update(array $data): int {
         return DB::getInstance()
            ->table(self::$table)
            ->update($data)
            ->rowCount();
    }

    public function delete(array $data): int { 
        return DB::getInstance()
            ->table(self::$table)
            ->delete($data)
            ->rowCount();
    }

    public function count(){
        return DB::getInstance()
            ->table(self::$table)
            ->count();
    }

}