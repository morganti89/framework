<?php

namespace App\Framework\Models;

use App\Framework\Repository\Repository;
use App\Framework\Helpers\Request;


class Model
{

    protected static ?Repository $repository;
    private static $class;

    private static $instance;
    public function __construct() {}
    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    protected function setRepository(Repository $repository): void
    {
        self::$repository = $repository;
    }
    public static function all(): array|null
    {
        $namespace = get_called_class();

        self::$class = new $namespace();
        $table = self::$class::TABLE;

        $data = self::getInstance()::$repository->getAll($table);

        $dataList = [];
        foreach ($data as $_data) {
            $classToHydrate = new $namespace();
            $dataList[] = self::getInstance()->hydrateData($classToHydrate, $_data);
        }

        return $dataList;
    }

    public static function save(): int
    {
        $namespace = get_called_class();

        $dataRequest = Request::getRequest()->post();

        self::$class = new $namespace();
        $table = self::$class::TABLE;
        return self::getInstance()::$repository->save($table, $dataRequest);
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
        $table = self::$class::TABLE;
        $classToHydrate = new $namespace();
        $data = self::getInstance()::$repository->getBy($table, $getRequest);
        return self::getInstance()->hydrateData($classToHydrate, $data);
    }

    public static function delete(): int
    {
        $namespace = get_called_class();
        $postRequest = Request::getRequest()->post();
        self::$class = new $namespace();
        $table = self::$class::TABLE;
        return self::getInstance()::$repository->delete($table, $postRequest);
    }

    private function hydrateData(Model $model, array $data)
    {
        foreach ($data as $key => $value) {
            $functionName = 'set' . ucfirst($key);
            $model->$functionName($value);
        }
        return $model;
    }
}
