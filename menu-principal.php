<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">
            <a class="navbar-brand" href="<?php echo $relative_link?>index.php">
                <img src="<?php echo $relative_link?>img/Phisiclation-removebg-preview.png" alt="phisiclationLogo">
            </a>
        </span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Simulações Favoritas
                    </a>
                    <!-- COLOCAR SIMULAÇÕES FAVORITAS -->
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $nPossui = true;
                        $sql = "SELECT * FROM simulation";
                        $consulta_simulation = $pdo->query($sql);
                        while ($simulationLinha = $consulta_simulation->fetch(PDO::FETCH_BOTH)) {
                            $idSimulation = $simulationLinha['IdSimulation'];
                            $sql = "SELECT count(*) FROM fav_simulation WHERE idUser = '$idUser' and idSimulation = '$idSimulation'";
                            $consulta_fav = $pdo->query($sql);
                            $favLinha = $consulta_fav->fetch(PDO::FETCH_BOTH);
                            if ($favLinha['count(*)']>0) {
                                if ($principal==false and $alterarSenha==true) {
                                    $link = "{$simulationLinha['link']}";                                
                                } else {
                                    $link = "simulation/{$simulationLinha['link']}";                                
                                }
                                echo '<li><a class="dropdown-item" href="'.$link.'?id='.$idSimulation.'">'.$simulationLinha['nome'].'</a></li>';
                                $nPossui = false;
                            }
                        }
                        if ($nPossui) {
                            echo '<li><a class="dropdown-item" href="#">Não possui favoritas</a></li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Opções
                    </a>
                    <!-- COLOCAR OPÇÕES -->
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        echo '<li><a class="dropdown-item" href="'.$relative_link.'actions/logof.php"><i class="fas fa-sign-out-alt"> Logoff</i></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="'.$relative_link.'alterar-senha.php">Alterar Senha</a></li>';
                        ?>
                    </ul>
                </li>
            </ul>
            <!-- SELECIONAR TIPOS DE SIMULAÇÕES -->
            <?php
            if ($principal) {
                echo '
                <form class="d-flex" method="get">
                    <div class="input-group">
                        <select name="select" class="form-select" aria-label="Default select example">
                            <option value="" ';
                            if ($select == "") {
                                echo 'selected';
                            }
                            echo '>Todas</option>';

                            $sql = "SELECT * FROM type_simulation";
                            $consulta_type = $pdo->query($sql);                          
                            while ($typeLinha = $consulta_type->fetch(PDO::FETCH_BOTH)) {
                                $selected = '';
                                if ($typeLinha['IdType']==$select) {
                                    $selected = 'selected';
                                }
                                echo '<option value="'.$typeLinha['IdType'].'"'.$selected.'>'.$typeLinha['nome'].'</option>';
                            }
                        echo '</select>
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                ';
            } elseif ($alterarSenha) {
                $sql = "SELECT * FROM simulation WHERE IdSimulation = '$idSimulationGET'";
                $consulta_simulation = $pdo->query($sql);
                $simulationLinha = $consulta_simulation->fetch(PDO::FETCH_BOTH);
                $sql = "SELECT count(*) FROM fav_simulation WHERE idUser = '$idUser' and idSimulation = '$idSimulationGET'";
                $consulta_fav_simulation = $pdo->query($sql);
                $nome = $simulationLinha['nome'];
                echo '<div class="d-flex"><h5>'.$nome.'</h5>';
                $favLinha = $consulta_fav_simulation->fetch(PDO::FETCH_BOTH);
                if ($favLinha['count(*)']==0) {
                    echo '<a class="link-success mx-1" href="../actions/favoritar.php?id='.$simulationLinha['IdSimulation'].'&simulation=true" data-bs-toggle="tooltip" title="Favoritar"><i class="far fa-star"></i></a>';
                } else {
                    echo '<a class="link-success mx-1" href="../actions/desfavoritar.php?id='.$simulationLinha['IdSimulation'].'&simulation=true" data-bs-toggle="tooltip" title="Desfavoritar"><i class="fas fa-star"></i></a>';
                }
                echo '<a class="link-danger mx-1" href="../reportarBug.php?id='.$simulationLinha['IdSimulation'].'" data-bs-toggle="tooltip" title="Reportar Bug"><i class="fas fa-bug"></i></a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</nav>