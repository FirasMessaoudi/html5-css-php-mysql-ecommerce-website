<?php 
@mysql_connect("localhost","root","") or die ("erreur de connexion");
@mysql_select_db("test") or die ("erreur de la selection");
$email=$_POST['email2'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$message=$_POST['message'];
$req1="INSERT INTO message VALUES('','$name','$email','$phone','$message')";
	$res1=mysql_query($req1);
	if(!$res1)
		echo"Erreur de l'ajout du message ";
	else
		echo "<p align='center' style='color:red;font-family:forte;font-size:50px'><b>Votre message a ete bien enregistree </b></p> <br>";

?>