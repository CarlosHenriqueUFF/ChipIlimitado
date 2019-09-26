<?php

  //Total cliente count
  $sql_cliente = "SELECT COUNT(*) as num FROM tbl_cliente WHERE deleted = 0";
  $total_cliente = mysqli_query($connect, $sql_cliente);
  $total_cliente = mysqli_fetch_array($total_cliente);
  $total_cliente = $total_cliente['num'];

  //Total chip count
  $sql_chip = "SELECT COUNT(*) as num FROM tbl_chip WHERE deleted = 0";
  $total_chip = mysqli_query($connect, $sql_chip);
  $total_chip = mysqli_fetch_array($total_chip);
  $total_chip = $total_chip['num'];
  
  //Total clientes_ativos app count
  $sql_clientes_ativos_app = "SELECT COUNT(*) as num FROM tbl_cliente_chip WHERE date_exclusao = '0000-00-00 00:00:00'";
  $total_clientes_ativos_app = mysqli_query($connect, $sql_clientes_ativos_app);
  $total_clientes_ativos_app = mysqli_fetch_array($total_clientes_ativos_app);
  $total_clientes_ativos_app = $total_clientes_ativos_app['num'];

?>
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Dashboard</h5>
                <ol class="breadcrumb">
                  <li><a href="dashboard.php">Dashboard</a>
                  </li>
                  <li><a href="#" class="active">Home</a>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->

        <!--start container-->
        <div class="container">
            <div class="section">

                        <!--card stats start-->
            <div id="card-stats" class="seaction">
              <div class="row">
                            <div class="col s12 m6 l3">
                            <a href="cliente.php">
                                <div class="card">
                                    <div class="card-content grey white-text">
                                    <br>
                                        <p class="card-stats-title"><i class="mdi-social-people"></i> CLIENTES</p>
                                        <h4 class="card-stats-number"><?php echo $total_cliente;?></h4>
                                        <p class="card-stats-compare"><span class="blue-grey-text text-lighten-5">Total Clientes</span>
                                        </p>
                                    <br>
                                    </div>
                                </div>
                            </a>
                            </div>

                            <div class="col s12 m6 l3">
                            <a href="chip.php">
                                <div class="card">
                                    <div class="card-content grey white-text">
                                    <br>
                                        <p class="card-stats-title"><i class="mdi-action-payment"></i> CHIP</p>
                                        <h4 class="card-stats-number"><?php echo $total_chip;?></h4>
                                        <p class="card-stats-compare"><span class="blue-grey-text text-lighten-5">Total de Chips</span>
                                        </p>
                                    <br>
                                    </div>
                                </div>
                            </a>
                            </div>
                  
                            <div class="col s12 m6 l3">
                            <a href="cliente.php">
                                <div class="card">
                                    <div class="card-content grey white-text">
                                    <br>
                                        <p class="card-stats-title"><i class="mdi-navigation-check"></i> ATIVOS</p>
                                        <h4 class="card-stats-number"><?php echo $total_clientes_ativos_app;?></h4>
                                        <p class="card-stats-compare"><span class="blue-grey-text text-lighten-5">Total de Chips em Uso</span>
                                        </p>
                                    <br>
                                    </div>
                                </div>
                            </a>
                            </div>

                            <div class="col s12 m6 l3">
                            <a href="relatorio.php">
                                <div class="card">
                                    <div class="card-content grey white-text">
                                    <br>
                                        <p class="card-stats-title"><i class="mdi-action-toc"></i> RELATÓRIO</p>
                                        <h4 class="card-stats-number"><i class="mdi-content-content-copy"></i></h4>
                                        <p class="card-stats-compare"><span class="blue-grey-text text-lighten-5">Relatório Gerencial</span>
                                        </p>
                                    <br>
                                    </div>
                                </div>
                            </a>
                            </div>

                            

                        </div>
            </div>
            <!--card stats end-->
    </div>
</div> 
