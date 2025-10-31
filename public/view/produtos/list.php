<head>
    <link rel="stylesheet" href="<?= DIR_CSS . 'pagination.css' ?>">
</head>
<x-layout title="produtos">
    <a class="btn mb-2 bg-light-green" href="<?= route('produtos/add') ?>">Criar produto</a>
    <ul class="list list-group list-group-flush">
        <li class="
                list-group-item
                d-flex
                align-items-center
                p-3
                list-light">
            <div class="w-25">
                Produto
            </div>
            <div class="w-50">
                Preço
            </div class="">
                <div>
                Ação
            </div>
        </li>


        <?php foreach ($produtos as $key => $produto): ?>
            <li class="
                list-group-item
                d-flex
                align-items-center
                p-3
                list-light
                ">
                <div class="w-25">
                    <?= $produto->nome() ?>
                </div>
                <div class="w-50">
                    <?= $produto->precoFormat() ?>
                </div>
                <div >
                    <form 
                        action="<?= route("produtos/delete") ?>" 
                        class="m-auto"
                        method="post">
                        <input hidden="true"name="id" value="<?= $produto->id()?>"/>
                        <a href="<?= route('produtos/edit/'.$produto->id()) ?>" class="btn btn-dark btn-sm" type="button">Editar</a>
                        <button 
                            class="btn btn-danger btn-sm" type="submit">
                            Excluir
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
    <div class="pagination">
        <?php for($i = 1; $i <= $count; $i++): ?>
            <a href="<?= route('produtos/page/'.$i)?>"><?=$i?></a>
        <?php endfor ?>
    </div>
</x-layout>