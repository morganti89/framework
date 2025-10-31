<?php

namespace App\Framework\Repository;

use App\Framework\Infra\Connection\DB;
class ProductRepository extends Repository{

    public function __construct(){
        
    }

    public function getPerPage(int $page = 1, int $limit = 10){

        $init = $page > 1 ? (($page - 1) * $limit) + 1 : 1;
        $final = $limit * $page;

        return DB::getInstance()
            ->table(parent::$table)
            ->sql('SELECT * from '. parent::$table . ' WHERE id BETWEEN :init and :final')
            ->parameters(['init'=>$init,'final'=>$final])
            ->make()
            ->all();
    }
}