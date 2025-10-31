<?php

namespace App\Framework\Models;

use App\Framework\Repository\Repository;
use App\Framework\Helpers\Request;


class Model
{

    protected static ?Repository $repository;
    private static $class;

    private static $namespace;
    private static $instance;
    
    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        self::$namespace = get_called_class();
        
        return self::$instance;
    }

    protected function setRepository(Repository $repository, string $tableName): void
    {
        self::getInstance()::$repository = $repository;
        self::$repository->setTable($tableName);
    }
    public static function all(): array|null
    {
        $data = self::getInstance()::$repository->getAll();
        $dataList = [];
        $class = self::$namespace;
        
        foreach ($data as $_data) {
            $classToHydrate = new $class();
            $dataList[] = self::getInstance()->hydrateData($classToHydrate, $_data);
        }

        return $dataList;
    }

    public static function save(): int
    {
        $dataRequest = Request::getRequest()->post();
        self::$class = new $namespace();
        $table = self::$class::TABLE;
        return self::getInstance()::$repository->save( $dataRequest);
    }

    public static function update(): int
    {
        $namespace = get_called_class();
        $dataRequest = Request::getRequest()->post();
        self::$class = new $namespace();
        $table = self::$class::TABLE;
        return self::getInstance()::$repository->update($table, $dataRequest);
    }

    public static function getBy(string $by): object
    {

        $namespace = get_called_class();
        $getRequest = Request::getRequest()->get($by);
        self::$class = new $namespace();
        $classToHydrate = new $namespace();
        $data = self::getInstance()::$repository->getBy( $getRequest);
        return self::getInstance()->hydrateData($classToHydrate, $data);
    }

    public static function delete(): int
    {
        $namespace = get_called_class();
        $postRequest = Request::getRequest()->post();
        self::$class = new $namespace();
        $table = self::$class::TABLE;
        return self::getInstance()::$repository->delete( $postRequest);
    }

    public static function count():int {
        return self::getInstance()::$repository->count();
    }

    protected function hydrateData(Model $model, array $data)
    {
        foreach ($data as $key => $value) {
            $functionName = 'set' . ucfirst($key);
            $model->$functionName($value);
        }
        return $model;
    }
    
}
