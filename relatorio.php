<?php include('session.php'); ?>
<?php include("public/menubar.php"); ?>
<?php
    
$rss_result = false;    

$error = false;

if (isset($_POST['btnSearch'])) {

    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];
    
    if (empty($data_inicial)) {
        $error = 'Informe a Data Inicial!';
    } else if(strlen($data_inicial) < 10){
        $error = 'Informe o Ano Inicial com 4 dígitos!';
    }

    if (empty($data_final)) {
        $error = 'Informe a Data Final!';
    } else if(strlen($data_final) < 10){
        $error = 'Informe o Ano Final com 4 dígitos!';
    }

    if (!$error) {
        
        $datai = explode("/", $data_inicial);
        $data_ini_format = $datai[2] . "-" . $datai[1] . "-" . $datai[0] . " 00:00:00";
        
        $dataf = explode("/", $data_final);
        $data_fim_format = $dataf[2] . "-" . $dataf[1] . "-" . $dataf[0] . " 23:59:59";
        
        $sql = "SELECT cl.*, ch.id As chip_id, ch.numero, ch.iccid, ch.st_ativo, 
                    cc.date_inclusao, cc.date_exclusao, cc.id AS cliente_chip_id
                    FROM tbl_cliente cl
                    LEFT JOIN tbl_cliente_chip cc ON cl.id = cc.cliente_id 
                    LEFT JOIN tbl_chip ch ON ch.id = cc.chip_id
                    WHERE cc.date_inclusao BETWEEN '".$data_ini_format."' AND '".$data_fim_format."'
                    ORDER BY cc.date_inclusao DESC;;";
        $rss_result = mysqli_query($connect, $sql);
        
    } else {
        $succes = <<<EOF
				<script>
				alert('Informe as Datas de forma correta ( dd/mm/aaa )');
				window.location = 'relatorio.php';
				</script>
EOF;
            echo $succes;
    }
}

?>
    <script>
        function mascaraData(val) {
  var pass = val.value;
  var expr = /[0123456789]/;

  for (i = 0; i < pass.length; i++) {
    // charAt -> retorna o caractere posicionado no índice especificado
    var lchar = val.value.charAt(i);
    var nchar = val.value.charAt(i + 1);

    if (i == 0) {
      // search -> retorna um valor inteiro, indicando a posição do inicio da primeira
      // ocorrência de expReg dentro de instStr. Se nenhuma ocorrencia for encontrada o método retornara -1
      // instStr.search(expReg);
      if ((lchar.search(expr) != 0) || (lchar > 3)) {
        val.value = "";
      }

    } else if (i == 1) {

      if (lchar.search(expr) != 0) {
        // substring(indice1,indice2)
        // indice1, indice2 -> será usado para delimitar a string
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }

    } else if (i == 4) {

      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
        continue;
      }

      if ((nchar != '/') && (nchar != '')) {
        var tst1 = val.value.substring(0, (i) + 1);

        if (nchar.search(expr) != 0)
          var tst2 = val.value.substring(i + 2, pass.length);
        else
          var tst2 = val.value.substring(i + 1, pass.length);

        val.value = tst1 + '/' + tst2;
      }
    }

    if (i >= 6) {
      if (lchar.search(expr) != 0) {
        var tst1 = val.value.substring(0, (i));
        val.value = tst1;
      }
    }
  }

  if (pass.length > 10)
    val.value = val.value.substring(0, 10);
  return true;
}
    </script>
    <!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Relatório Gerencial</h5>
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Dashboard</a>
                            </li>
                            <li><a class="active">Relatório</a>
                            </li>
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
                        <form method="post" class="col s12" id="form-validation" >
                            <div class="row">
                                <div class="input-field col s12">
                                    <div class="row">
                                        <div class="input-field col s12 m12 l5">
                                            <input type="text" name="data_inicial" id="data_inicial" maxlength="10" onkeypress="mascaraData(this)" placeholder="dd/mm/aaaa" required />
                                            <label for="data_inicial">Data Inicial</label>
                                        </div>
                                        <div class="input-field col s12 m12 l5">
                                            <input type="text" name="data_final" id="data_final" maxlength="10" onkeypress="mascaraData(this)" placeholder="dd/mm/aaaa" required/>
                                            <label for="data_final">Data Final</label>
                                        </div>
                                        <div class="input-field">
                                            <button class="btn cyan waves-effect waves-light center"
                                                    type="submit" name="btnSearch">Buscar
                                                <i class="mdi-action-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card-panel">
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
                            <table id="table_channel" class="responsive-table display" cellspacing="0">

                                <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="20%">Nome Cliente</th>
                                    <th width="15%">CPF Cliente</th>
                                    <th width="15%">Numero Chip</th>
                                    <th width="15%">ICCID Chip</th>
                                    <th width="15%">Data Ativação</th>
                                    <th width="15%">Data Desativação</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if ($rss_result){
                                $i = 1;
                                while($rss_row=mysqli_fetch_array($rss_result)) {
                                    ?>

                                    <tr>
                                        <td>
                                            <?php
                                            echo $i;
                                            $i++;
                                            ?>
                                        </td>
                                        <td><?php echo $rss_row['name'];?></td>
                                        <td><?php echo $rss_row['cpf'];?></td>
                                        <td><?php echo $rss_row['numero'] ? $rss_row['numero'] : ''; ?></td>
                                        <td><?php echo $rss_row['iccid'] ? $rss_row['iccid'] : ''; ?></td>
                                        <td><?php echo $rss_row['date_inclusao'] ? date_format(date_create($rss_row['date_inclusao']),"d/m/Y - H:i:s") : ''; ?></td>
                                        <td><?php echo $rss_row['date_inclusao'] ? date_format(date_create($rss_row['date_inclusao']),"d/m/Y - H:i:s") : ''; ?></td>
                                    </tr>
                                <?php } 
                                }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php include('public/footer.php'); ?>
