<?php
session_start();
$_SESSION["nama"] = $_GET["txtnama"];
$_SESSION["email"] = $_GET["txtemail"];
$_SESSION["pesan"] = $_GET["txtpesan"];
header ( header: "location: get.php");
?>
