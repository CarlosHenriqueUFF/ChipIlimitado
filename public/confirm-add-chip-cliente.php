<?php

if (isset($_GET['id'])) {
    
    $qry = "SELECT cp.*, (SELECT MIN(cc.date_exclusao) FROM tbl_cliente_chip cc
                WHERE cc.chip_id = cp.id) AS dt_exclusao
                FROM tbl_chip cp
                WHERE cp.st_ativo = 0 AND cp.deleted = 0
                ORDER BY dt_exclusao
                LIMIT 1;";
    $result = mysqli_query($connect, $qry);
    $row = mysqli_fetch_assoc($result);
    
    if(isset($row['id'])){
        $sql = "INSERT INTO tbl_cliente_chip (cliente_id, chip_id) VALUES (?, ?)";

        $insert_result = false;
        
        $insert = $connect->stmt_init();
        if ($insert->prepare($sql)){
            //Bind parans
            $insert->bind_param('ss', $_GET['id'], $row['id']);
            // Execute query
            $insert->execute();
            // store result 
            $insert_result = $insert->store_result();
            $insert->close();
        }
        
        if ($insert_result){
        
            $sql1 = "UPDATE tbl_chip SET st_ativo = 1 WHERE id = ?;";

            $update_result = false;
            
            $update = $connect->stmt_init();
            if ($update->prepare($sql1)){
                //Bind parans
                $update->bind_param('d', $row['id']);
                // Execute query
                $update->execute();
                // store result 
                $update_result = $update->store_result();
                $update->close();
                
                // if delete data success back to reservation page
                if ($update_result) {
                    header("location: cliente.php");
                }
            }
        }
    } else {
        $succes = <<<EOF
				<script>
				alert('Nenhuma Chip disponível');
				window.location = 'cliente.php';
				</script>
EOF;
            echo $succes;
    }

}
?>
