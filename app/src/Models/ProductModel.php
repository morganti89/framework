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
    private ?int $id;
    private string $nome;
    private float $preco;
    
    

    public function __construct() {
        $productRepository = new ProductRepository();
        parent::getInstance()->setRepository($productRepository);
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
}
