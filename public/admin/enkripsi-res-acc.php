<?php 
$id = $_GET['id'];

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $sql = $db->query("UPDATE enkripsi SET status='$status' WHERE id='$id'");
    refresh('?enkripsi=list-acc');
} else {echo "gagal";}
?>