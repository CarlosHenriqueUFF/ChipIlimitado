<?php
$sql_query = "SELECT cl.*, ch.id As chip_id, ch.numero, ch.iccid, ch.st_ativo, 
                cc.date_inclusao, cc.id AS cliente_chip_id
                FROM tbl_cliente cl
                LEFT JOIN tbl_cliente_chip cc ON (cl.id = cc.cliente_id AND cc.date_exclusao = '0000-00-00 00:00:00')
                LEFT JOIN tbl_chip ch ON ch.id = cc.chip_id
                WHERE cl.deleted = 0 
                ORDER BY cc.date_inclusao DESC;";
$result = mysqli_query($connect, $sql_query);
?>

<!-- START CONTENT -->
<section id="content">

    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper" class=" grey lighten-3">
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Gerenciar Cliente</h5>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a class="active">Cliente</a></li>
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
                    <div align="right"><a href="add-cliente.php" class="btn waves-effect waves-light indigo"><i class="mdi-content-add"></i>Novo Cliente</a></div>

                    <div class="card-panel">

                        <table id="table_category" class="responsive-table display" cellspacing="0">		         
                            <thead>
                                <tr>
                                    <th class="hide-column">Cliente ID</th>
                                    <th class="hide-column">Cliente Chip ID</th>
                                    <th class="hide-column">Chip ID</th>
                                    <th width="5%">Cliente No.</th>
                                    <th width="20%">Nome Cliente</th>
                                    <th width="15%">CPF Cliente</th>
                                    <th width="15%">Numero Chip</th>
                                    <th width="15%">ICCID Chip</th>
                                    <th width="15%">Data Ativação</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>   

                            <tbody>
                                <?php
                                    $i = 1;
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td class="hide-column"><?php echo $data['id']; ?></td>
                                        <td class="hide-column"><?php echo $data['cliente_chip_id']; ?></td>
                                        <td class="hide-column"><?php echo $data['chip_id']; ?></td>
                                        <td>
                                    <?php
                                        echo $i;
                                        $i++;
                                        ?>
                                        </td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['cpf']; ?></td>
                                        <td><?php echo $data['numero'] ? $data['numero'] : ''; ?></td>
                                        <td><?php echo $data['iccid'] ? $data['iccid'] : ''; ?></td>
                                        <td><?php echo $data['date_inclusao'] ? date_format(date_create($data['date_inclusao']),"d/m/Y - H:i") : ''; ?></td>
                                        <td>
                                            <a href="edit-cliente.php?id=<?php echo $data['id']; ?>" >
                                                <i class="mdi-editor-mode-edit"></i>
                                            </a>
                                            <?php if(intval($data['st_ativo']) == 0) {?>
                                                <a href="delete-cliente.php?type=1&id=<?php echo $data['id']; ?>" onclick="return confirm('Você confirma a exclusão deste cliente?')" >
                                                    <i class="mdi-action-delete"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if(intval($data['st_ativo']) == 1) {?>
                                                <a href="delete-cliente.php?type=2&id=<?php echo $data['id'];?>&chip-id=<?php echo $data['chip_id'];?>&cliente-chip-id=<?php echo $data['cliente_chip_id'];?>" onclick="return confirm('Você confirma a remoção do chip desse cliente?')" >
                                                    <i class="mdi-action-highlight-remove"></i>
                                                </a>
                                            <?php } ?>
                                            <a href="add-chip-cliente.php?id=<?php echo $data['id'];?>" onclick="return confirm('Você confirma de uma linha livre para este cliente?')" >
                                                <i class="mdi-image-add-to-photos"></i>
                                            </a>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
