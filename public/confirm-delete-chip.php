<?php 

	if (isset($_GET['id'])) {
		$ID = $_GET['id'];
            // delete data from menu table
            $sql = "UPDATE tbl_chip SET deleted = 1 WHERE id = " .$_GET['id']. ";";

            $delete_result = false;

            $stmt = $connect->stmt_init();
            if ($stmt->prepare($sql)) {	
                    // Execute query
                    $stmt->execute();
                    // store result 
                    $delete_result = $stmt->store_result();
                    $stmt->close();
            }

            // if delete data success back to reservation page
            if($delete_result) {
                    header("location: chip.php");
            }
        }

?>