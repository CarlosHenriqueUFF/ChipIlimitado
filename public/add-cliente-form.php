<?php 

include_once('functions.php');

$error = false;

if (isset($_POST['btnAdd'])) {

    $nome = $_POST['name'];
    $cpf = $_POST['cpf'];
    
    if (empty($nome)) {
        $error = 'Informe o Nome do Cliente!';
    }

    if (empty($cpf)) {
        $error = 'Informe o CPF do cliente!';
    }

    if (!$error) {

        $sql = "SELECT * FROM tbl_cliente WHERE cpf = '$cpf';";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            if ($cpf == $row['cpf']) {

                $error = 'Esse CPF já está cadastrado!';
            }
        } else {

            $sql = "INSERT INTO tbl_cliente (name, cpf) VALUES (?, ?)";

            $insert = $connect->prepare($sql);
            $insert->bind_param('ss', $nome, $cpf);
            $insert->execute();

            $succes = <<<EOF
				<script>
				alert('Cliente cadastrado com Successo');
				window.location = 'cliente.php';
				</script>
EOF;
            echo $succes;
        }
    }
}
?>


    <!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Cadastrar Novo Cliente</h5>
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="cliente.php">Cliente</a></li>
                            <li><a class="active">Novo Cliente</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel">
                            <div class="row">
                                <form method="post" class="col s12" id="form-validation" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <div class="col s12 m12 l12">
                                                <?php if (!empty($error) && isset($error)) { ?>
                                                    <div class="col s12 m12 l12">
                                                        <div class="card-panel teal lighten-2">
                                                            <span class="white-text text-darken-2">
                                                                <?php echo $error; ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?php
                                                  unset($error);
                                                }
                                                ?>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="input-field col s12">
                                                    <input type="text" name="name" id="name" required/>
                                                    <label for="name">Nome</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col s12 m12 l5">
                                                    <input type="text" name="cpf" id="cpf" required/>
                                                    <label for="cpf">CPF</label>
                                                </div>
                                            </div>

                                            <br>
                                            <button class="btn cyan waves-effect waves-light right"
                                                    type="submit" name="btnAdd">Salvar
                                                <i class="mdi-content-send right"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>