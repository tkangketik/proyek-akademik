<?php 
$id = $_GET['id'];
if (isset($_POST['save'])) {
    $req = $_POST['req'];

    $sql = $db->query("UPDATE enkripsi SET req='$req' WHERE id='$id'");
    refresh('?enkripsi=list');
} else {echo "gagal";}
?>