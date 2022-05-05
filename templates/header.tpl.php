<header>
    <?php
    $theme = $_COOKIE['theme'];
    ?>
    <nav class="navbar navbar-expand-lg <?=$theme?>">
        <div class="container">
            <a class="navbar-brand" href="/">Новости Осетии</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Новости</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">О проекте</a>
                    </li>
                </ul>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="swicthTheme">
                    <label class="form-check-label" for="swicthTheme">Сменить тему</label>
                </div>
                <form class="d-flex px-3" action="" method="post">
                    <input class="form-control me-2" name="search_phrase" type="search" placeholder="Введите запрос" aria-label="Найти">
                    <button class="btn btn-outline-success" name="submit" type="submit">Найти</button>
                </form>
                <form class="d-flex" action="" method="post">
                    <button class="btn btn-outline-info" name="logout" type="submit">Выход</button>
                </form>
            </div>
        </div>
    </nav>
</header>
