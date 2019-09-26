<?php

	if (isset($_GET['id']) && isset($_GET['type'])) {
            if (intval($_GET['type']) == 1 ){
                $sql = "UPDATE tbl_cliente SET deleted = 1 WHERE id = " .$_GET['id']. ";";

                $delete_result_cliente = false;

                $stmt2 = $connect->stmt_init();
                if ($stmt2->prepare($sql)) {	
                        // Execute query
                        $stmt2->execute();
                        // store result 
                        $delete_result_cliente = $stmt2->store_result();
                        $stmt2->close();
                }

                // if delete data success back to reservation page
                if($delete_result_cliente) {
                        header("location: cliente.php");
                }
            } else if (intval($_GET['type']) == 2 ){
                if (isset($_GET['chip-id']) && isset($_GET['cliente-chip-id'])){
                    $sql = "UPDATE tbl_chip SET st_ativo = 0 WHERE id = " .$_GET['chip-id']. ";";

                    $delete_result_chip = false;

                    $stmt = $connect->stmt_init();
                    if ($stmt->prepare($sql)) {	
                            // Execute query
                            $stmt->execute();
                            // store result 
                            $delete_result_chip = $stmt->store_result();
                            $stmt->close();
                    }
                    
                    $sql1 = "UPDATE tbl_cliente_chip SET date_exclusao = CURRENT_TIMESTAMP WHERE id = " .$_GET['cliente-chip-id']. ";";

                    $delete_result_chip_cliente = false;

                    $stmt1 = $connect->stmt_init();
                    if ($stmt1->prepare($sql1)) {	
                            // Execute query
                            $stmt1->execute();
                            // store result 
                            $delete_result_chip_cliente = $stmt1->store_result();
                            $stmt1->close();
                    }

                    // if delete data success back to reservation page
                    if($delete_result_chip && $delete_result_chip_cliente) {
                            header("location: cliente.php");
                    }
                }
            }
	            
        }

?>
