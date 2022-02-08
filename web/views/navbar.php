<nav id="navbar-default" class="navbar navbar-dark navbar-expand-lg w-100 navbar-default" style="z-index: 900;">
    <div class="container-fluid">
        <div class="mx-lg-auto order-0">
            <a class="navbar-brand mx-auto abs" href="index.php">Square-two</a>
            <button class="navbar-toggler flex-grow-sm-1 flex-grow-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target=".hamburguer">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse hamburguer">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./../controllers/new.php">Lançamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./../controllers/category.php?c=1">2x2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./../controllers/category.php?c=2">3x3</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Big Cubes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../controllers/category.php?c=5">4x4</a></li>
                        <li><a class="dropdown-item" href="../controllers/category.php?c=6">5x5</a></li>
                        <li><a class="dropdown-item" href="../controllers/category.php?c=7">6x6</a></li>
                        <li><a class="dropdown-item" href="../controllers/category.php?c=8">7x7</a></li>
                        <li><a class="dropdown-item" href="../controllers/category.php?c=14">8x8</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Variados
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./../controllers/category.php?c=4">Pyraminx</a></li>
                        <li><a class="dropdown-item" href="./../controllers/category.php?c=3">Megaminx</a></li>
                        <li><a class="dropdown-item" href="./../controllers/category.php?c=15">Mirror</a></li>
                        <li><a class="dropdown-item" href="./../controllers/category.php?c=10">Square-1</a></li>
                        <li><a class="dropdown-item" href="./../controllers/category.php?c=9">Skewb</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-lg-2" method="get" action="../controllers/index.php">
                <input class="form-control me-2" name="search" type="text" type="search" placeholder="O que você procura?" aria-label="search">
                <button class="btn btn-outline-success" type="submit">
                    <span class="bi bi-search" role="img" aria-label="search-icon"></span>
                </button>
            </form>
            <ul class="navbar-nav">

                <?php if (empty($_SESSION['id_user'])) : ?>
                    <!-- if (nenhum usuário está logado) -->

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../controllers/login.php">
                            <span class="bi bi-person-fill" role="img" aria-label="person-icon"></span>
                            Login
                        </a>
                    </li>

                <?php elseif ($_SESSION['level_user'] == 0) : ?>
                    <!-- elseif (o usuário logado é um cliente) -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="login-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Boas-vindas, <?= $_SESSION['name_user'] ?>!
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="login-dropdown">
                            <li>
                                <a class="dropdown-item" href="../controllers/cart.php">
                                    <span class="bi bi-cart-fill"></span>
                                    Carrinho
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../controllers/user_area.php">
                                    <span class="bi bi-person-circle"></span>
                                    Área do usuário
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../controllers/contact.php">
                                    <span class="bi bi-chat"></span>
                                    Contato
                                </a>
                            </li>

                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item" href="../handlers/exit.php">
                                    <span class="bi bi-box-arrow-right"></span>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php else : ?>
                    <!-- else (o usuário logado é um admin) -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="login-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrador
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="login-dropdown">
                            <li>
                                <a class="dropdown-item" href="../controllers/admin.php">
                                    <span class="bi bi-gear-fill"></span>
                                    Configurações
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="../controllers/user_area.php">
                                    <span class="bi bi-person-circle"></span>
                                    Área do usuário
                                </a>
                            </li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item" href="../handlers/exit.php">
                                    <span class="bi bi-box-arrow-right"></span>
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>