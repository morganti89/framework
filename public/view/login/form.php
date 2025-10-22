<x-layout title="Login" notRenderLayout="true">
    <div class="d-flex justify-content-center">
        <form class="p-5 bg-secondary bg-gradient text-white w-50"
            method="post">
            <h2 class="text-white">Login</h2>
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
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            <a href="<?= route('user/form') ?>" type="submit" class="btn btn-primary mt-3">Cadastrar novo</a>
        </form>
    </div>
</x-layout>