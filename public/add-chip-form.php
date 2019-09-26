<?php
include_once('functions.php');

$error = false;

if (isset($_POST['submit'])) {

    $numero = $_POST['numero'];
    $iccid = $_POST['iccid'];
    
    if (empty($numero)) {
        $error = 'Informe o valor do número do Chip';
    }

    if (empty($iccid)) {
        $error = 'Informe o ICCID do Chip';
    }

    if (!$error) {

        $sql = "SELECT * FROM tbl_chip WHERE (numero = '$numero' OR iccid = '$iccid');";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            if ($numero == $row['numero']) {

                $error = 'Esse número já existe!';
            }

            if ($iccid == $row['iccid']) {

                $error = 'Esse ICCID já está cadastrado!';
            }
        } else {

            $sql = "INSERT INTO tbl_chip (numero, iccid) VALUES (?, ?)";

            $insert = $connect->prepare($sql);
            $insert->bind_param('ss', $numero, $iccid);
            $insert->execute();

            $succes = <<<EOF
				<script>
				alert('Chip cadastrado com Successo');
				window.location = 'chip.php';
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
                    <h5 class="breadcrumbs-title">Cadastrar Novo Chip</h5>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="chip.php">Chip</a></li>
                        <li><a class="active">Novo Chip</a></li>
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
                            <form method="post" id="form-validation" >
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
                                            
                                            <div class="row">
                                                <div class="input-field col s12 m12 l5">
                                                    <input type="text" name="numero" id="channel_name" placeholder="O número do Chip" required/>
                                                    <label for="numero">Número</label>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="input-field col s12 m12 l5">
                                                    <input type="text" name="iccid" id="youtube" placeholder="999999999999999" autofocus required/>
                                                    <label for="iccid">ICCID</label>
                                                </div>
                                            </div>
                                        
                                            <br>
                                            <button class="btn cyan waves-effect waves-light right"
                                                    type="submit" name="submit">Salvar
                                                <i class="mdi-content-send right"></i>
                                            </button>

                                        </div>

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