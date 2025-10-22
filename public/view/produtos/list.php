<x-layout title="produtos">
    <a class="btn btn-dark mb-2" href="<?= route('produtos/add') ?>">Criar produto</a>
    <ul class="list-group list-group-flush ">
        <?php foreach ($produtos as $key => $produto): ?>
            <li class="
                list-group-item
                list-group-item-dark
                d-flex
                justify-content-between
                align-items-center
                p-3
                ">
                <div class="w-25">
                    <?= $produto->nome() ?>
                </div>
                <div>
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
</x-layout>