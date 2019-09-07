<?php
session_start();
if(isset($_POST['estadouser'])){
	$_SESSION['estadouser']=$_POST['estadouser'];
}
if(isset($_POST['ciudaduser'])){
	$_SESSION['ciudaduser']=$_POST['ciudaduser'];
}
if(isset($_POST['estado'])){
	$_SESSION['estado']=$_POST['estado'];

}else{
	$_SESSION['estado']="Sin estado";
}
if(isset($_POST['ciudad'])){
	$_SESSION['ciudad']=$_POST['ciudad'];

}else{
	$_SESSION['ciudad']="Sin ciudad";
}

if(isset($_POST['subcategoria'])){
	$_SESSION['subcategoria']=$_POST['subcategoria'];

}else{
	$_SESSION['subcategoria']="";
}

if(isset($_POST['lugar'])){
	$_SESSION['nombrelugar']=$_POST['lugar'];
}else{
	$_SESSION['nombrelugar']="Sin clasificar";
}
?>
