<?php
$servername="localhost";
$username="root";
$password="";
$database="test";

$conn=new mysqli($servername,$username,$password,$database);

if($conn -> connect_error){
    die("Spojenie sa nepodarilo".connect_error);
}
// echo "spojenie sa podarilo";
?>
