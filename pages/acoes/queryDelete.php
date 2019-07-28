<?php
    include("../includes/dbconnection.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM `dadosconsulta` WHERE idcon = $id;";
    mysqli_query($conn,$sql);
    mysqli_close($conn);
    echo json_encode(true);
?>