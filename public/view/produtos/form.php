<x-layout title="produtos" id="layout_form_product">
    <form 
        action= "<?= (isset($produtos) ? DIR_PAGE.'produtos/update' : '') ?>"
        method="post"
        class="form__input">
        <div>
            <input hidden name="id" value="<?= isset($produtos) ? $produtos->id() : 0?>"/>
        </div>
        <div class="form-group">
            <label for="product_name">Nome do produto</label>
            <input 
                type="text"
                name="nome"
                class="form-control"
                id="product_name"
                value="<?=isset($produtos) ? $produtos->nome() : ''?>"
        </div>
        <div class="form-group">
            <label for="product_price">Preço</label>
            <input 
                type="text"
                name="preco"
                class="form-control"
                id="product_price"
                value="<?= isset($produtos) ? $produtos->precoFormat() : '' ?>"
                >
        </div>
        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
</x-layout>