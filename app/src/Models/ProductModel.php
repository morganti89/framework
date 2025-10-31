<?php

namespace App\Framework\Models;

use App\Framework\Repository\ProductRepository;


class ProductModel extends Model
{

    /**
     * @TABLE
     * Necessário inserir a tabela que será feito as buscas
     * */
    const TABLE = 'produtos';
    private static $instance;
    private ?int $id;
    private string $nome;
    private float $preco;


    public function __construct() {
        $productRepository = new ProductRepository();
        parent::getInstance()->setRepository($productRepository, self::TABLE);
    }

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function setNome(string $nome):void {
        $this->nome = $nome;
    }
    public function setPreco(float $preco):void{
        $this->preco = $preco;
    }
    
    public function id():int {
        return $this->id;
    }

    public function nome():string {
        return $this->nome;
    }
    public function preco():float{
        return $this->preco;
    }

    public function precoFormat():string {
        return number_format($this->preco,2,'.','');
    }

    public function getPerPage(?int $page): array {
        $dataList = [];
        $data = parent::getInstance()::$repository->getPerPage($page);
        foreach ($data as $key => $value) {
            $classToHydrate = new ProductModel();
            $dataList[] = parent::getInstance()->hydrateData($classToHydrate, $value);
        }

        return $dataList;
    }
    
}
