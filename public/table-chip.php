<?php

	//$sql_query = "SELECT * FROM tbl_channel p, tbl_category c WHERE p.category_id = c.cid ORDER BY id DESC";
        $sql_query = "SELECT * FROM tbl_chip WHERE deleted = 0 ORDER BY id DESC";
	$result = mysqli_query($connect, $sql_query);

 ?>

	<!-- START CONTENT -->
    <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
            <div class="container">
            	<div class="row">
                    <div class="col s12 m12 l12">
                        <h5 class="breadcrumbs-title">Gerenciar Chip</h5>
                        <ol class="breadcrumb">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a class="active">Chip</a></li>
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
                        <div align="right"><a href="add-chip.php" class="btn waves-effect waves-light indigo"><i class="mdi-content-add"></i>Novo Chip</a></div>

                        <div class="card-panel">

                            <table id="table_channel" class="responsive-table display" cellspacing="0">		         
                                <thead>
                                    <tr>
                                            <th class="hide-column">Chip ID</th>
                                            <th width="10%">Chip No.</th>
                                            <th width="25%">Número do Chip</th>
                                            <th width="30%">ICCID do Chip</th>
                                            <th width="20%">Vinculado Cliente</th>
                                            <th width="15%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $i = 1;
                                        while($data = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                            <td class="hide-column"><?php echo $data['id'];?></td>
                                            <td>
                                                    <?php
                                                        echo $i;
                                                        $i++;
                                                    ?>
                                            </td>
                                            <td><?php echo $data['numero'];?></td>
                                            <td><?php echo $data['iccid'];?></td>
                                            <td>
                                                <?php if (intval($data['st_ativo']) == 1) { ?>
                                                    Sim
                                                <?php } else { ?>
                                                    Não
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="edit-chip.php?id=<?php echo $data['id'];?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>
                                                <?php if(intval($data['st_ativo']) == 0) {?>
                                                    <a href="delete-chip.php?id=<?php echo $data['id'];?>" onclick="return confirm('Você confirma a exclusão desse chip?')" >
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                <?php } ?>
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
</section>
