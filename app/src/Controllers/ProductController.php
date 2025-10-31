<?php

namespace App\Framework\Controllers;

use App\Framework\Helpers\Curl;
use App\Framework\Helpers\Request;
use App\Framework\Models\ProductModel;

class ProductController extends Controller
{
    public function list(): void
    {

        //chama o model do elemento
        //$produtos = ProductModel::getInstance()::all();
        $countProducts = ProductModel::getInstance()->count();


        $products = ProductModel::getInstance()
            ->getPerPage(Request::getRequest()->get('pagination')['pagination']?? 1);

        render_view(
            viewName: 'produtos/list',
            viewVariables: [
                'produtos' => $products,
                'count'=> ceil($countProducts/10)
            ]
        );
    }

    public function createForm(): void
    {
        render_view(viewName: 'produtos/form');
    }

    public function create(): void
    {
        $lastId = ProductModel::save();
        if (!$lastId) {
            redirect('404');
        }
        redirect('produtos');
    }

    public function editForm(): void
    {
        $produto = ProductModel::getBy('id');

        render_view(viewName: 'produtos/form', viewVariables: [
            'produtos' => $produto
        ]);
    }


    public function edit(): void
    {
        $rows = ProductModel::update();
        redirect('produtos');
    }

    public function destroy(): void
    {
        $row = ProductModel::delete();
        redirect('produtos');
    }

    public function getProdutosApi(): void
    {
        $p = Curl::getInstance()
            ->init()
            ->url('https://www.google.com')
            ->make()
            ->getResponse();
    }
}
