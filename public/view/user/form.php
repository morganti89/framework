<x-layout title="Login" notRenderLayout="true">
    <div class="d-flex justify-content-center">
    <form 
        class="p-5 bg-secondary bg-gradient text-white w-50"
        action="<?= route('user/create_user')?>"
        method="post">
        <h2 class="text-white">Cadastrar Usuário</h2>
        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email"
                class="form-control"
                id="email"
                aria-describedby="emailHelp"
                name="email">
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input 
                type="password"
                class="form-control"
                id="password"
                name="senha">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
    </form>
     </div>
</x-layout>