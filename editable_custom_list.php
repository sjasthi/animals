<?php
    $conn = mysqli_connect("localhost", "root", "", "ics499_animals");



    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    echo "$value - $column - $id";

    $sql="UPDATE custom_words SET $column = '$value' WHERE id = '$id'";
    $result = $conn->query($sql);

    $conn -> close();
    
    
?>
