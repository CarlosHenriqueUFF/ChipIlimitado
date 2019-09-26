<?php
if (isset($_GET['id'])) {
    $qry = "SELECT * FROM tbl_cliente WHERE id ='" . $_GET['id'] . "'";
    $result = mysqli_query($connect, $qry);
    $row = mysqli_fetch_assoc($result);
}

$error = false;

if (isset($_POST['btnEdit'])) {
    
    $nome = $_POST['name'];
    $cpf = $_POST['cpf'];
    
    if (empty($nome)) {
        $error = 'Informe o Nome do cliente!';
    }

    if (empty($cpf)) {
        $error = 'Informe o CPF do cliente!';
    }

    if (!$error) {

        $sql = "SELECT * FROM tbl_cliente WHERE cpf = '$cpf' id != " . $_POST['id']. " AND deleted = 0;";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row1 = mysqli_fetch_assoc($result);

            if ($cpf == $row1['cpf']) {

                $error = 'Esse CPF já está cadastrado!';
            }
        } else {

            $sql = "UPDATE tbl_cliente SET name = ?, cpf = ? WHERE id = ?;";

            $insert = $connect->prepare($sql);
            $insert->bind_param('ssd', $nome, $cpf, $_POST['id']);
            $insert->execute();

            $succes = <<<EOF
				<script>
				alert('Cliente atualizado com Successo');
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
                        <h5 class="breadcrumbs-title">Editar Cliente</h5>
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="cliente.php">Cliente</a></li>
                            <li><a class="active">Editar Cliente</a></li>
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
                                <form method="post" class="col s12" >
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
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            </div>

                                            <div class="col s12 m12 l12"> 
                                                <div class="row">
                                                    <div class="input-field col s12">
                                                        <input type="text" name="name" id="channel_name" value="<?php echo $row['name']; ?>" required/>
                                                        <label for="name">Nome</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col s12 m12 l12"> 
                                                <div class="row">
                                                    <div class="input-field col s12 m12 l5">
                                                        <input type="text" name="cpf" id="channel_name" value="<?php echo $row['cpf']; ?>" required/>
                                                        <label for="cpf">CPF</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn cyan waves-effect waves-light right"
                                                    type="submit" name="btnEdit">Update
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
