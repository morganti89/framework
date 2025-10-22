<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="<?= DIR_CSS .'styles.css' ?>"rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container" id="layout">
        <nav class="
            navbar
            navbar-expand-lg
            bg-secondary
            bg-gradient mb-5
            _layout_content">
            <div class="container-fluid">
                <a class="navbar-brand" href='<?= route('') ?>'>Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= route('produtos') ?>">Produtos</a>
                        </li>
                    </ul>
                </div>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <a href="<?= route('login/logout')?>" class="btn btn-primary mr-2" type="submit">Logout</a>
            </form>
        </nav>
        <h1 class="mt-4 text-center" id="main_header"></h1>
        <slot name="<?= isset($slot) ? $slot : '' ?>"></slot>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>