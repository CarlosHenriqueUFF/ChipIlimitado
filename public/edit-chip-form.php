<?php
if (isset($_GET['id'])) {
    $qry = "SELECT * FROM tbl_chip WHERE id ='" . $_GET['id'] . "'";
    $result = mysqli_query($connect, $qry);
    $row = mysqli_fetch_assoc($result);
}

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

        $sql = "SELECT * FROM tbl_chip WHERE (numero = '$numero' OR iccid = '$iccid') AND id != " . $_POST['id']. " AND deleted = 0;";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {

            $row1 = mysqli_fetch_assoc($result);

            if ($numero == $row1['numero']) {

                $error = 'Esse número já existe!';
            }

            if ($iccid == $row1['iccid']) {

                $error = 'Esse ICCID já está cadastrado!';
            }
        } else {

            $sql = "UPDATE tbl_chip SET numero = ?, iccid = ? WHERE id = ?;";

            $insert = $connect->prepare($sql);
            $insert->bind_param('ssd', $numero, $iccid, $_POST['id']);
            $insert->execute();

            $succes = <<<EOF
				<script>
				alert('Chip atualizado com Successo');
				window.location = 'chip.php';
				</script>
EOF;
            echo $succes;
        }
    }
    
}

?>

<script src="assets/js/ckeditor/ckeditor.js"></script>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

<script type="text/javascript">

    (function ($, W, D) {
        var JQUERY4U = {};
        JQUERY4U.UTIL = {
            setupFormValidation: function () {
                //form validation rules
                $("#add_rss").validate({
                    rules: {
                            numero		: "required",
                            iccid 		: "required"
                        },

                        messages: {
                            numero 		: "Por favor, insira o Número do Chip!",
                            iccid 		: "Por favor, insira o ICCID do Chip!"

                        },
                    errorElement: 'div',
                    submitHandler: function (form) {
                        form.submit();
                    }

                });
            }
        }

        //when the dom has loaded setup form validation rules
        $(D).ready(function ($) {
            JQUERY4U.UTIL.setupFormValidation();
        });

    })(jQuery, window, document);

</script>

<!-- START CONTENT -->
<section id="content">

    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class=" grey lighten-3">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Editar Chip</h5>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="chip.php">Chip</a></li>
                        <li><a class="active">Editar Chip</a></li>
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
                            <form method="post" id="add_rss" >
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
                                                <div class="input-field col s12 m12 l5">
                                                    <input type="text" name="numero" id="channel_name" value="<?php echo $row['numero']; ?>" required/>
                                                    <label for="numero">Número</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col s12 m12 l12"> 
                                            <div class="row">
                                                <div class="input-field col s12 m12 l5">
                                                    <input type="text" name="iccid" id="channel_name" value="<?php echo $row['iccid']; ?>" required/>
                                                    <label for="iccid">ICCID</label>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn cyan waves-effect waves-light right"
                                                type="submit" name="submit">Update
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