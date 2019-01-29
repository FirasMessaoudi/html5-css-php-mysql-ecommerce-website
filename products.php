<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="css/login.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<body>

</body>
</html>


<?php
@mysql_connect("localhost","root","") or die ("erreur de connexion");
@mysql_select_db("test") or die ("erreur de la selection");
if (isset($_POST["username"]) && isset($_POST['password']))
{

$email=$_POST['username'];
$motdepasse=$_POST['password'];
$req="SELECT nom,email,cin FROM client  WHERE email='$email' AND cin='$motdepasse'";
$res=mysql_query($req);
if(mysql_num_rows($res)>0){
	echo "<p align='center' style='color:green;font-family:forte;font-size:50px'><b>Welcome</b></p> <br>";

while($data=mysql_fetch_assoc($res)){
	echo"<p align='center' style='color:black;font-family:sans-serif;font-size:50px'><b>Client : ".strtoupper($data['nom'])."</b></p> <br>";
	
}




    
     echo   '<table width="800" border="2" align="center">';
			 echo   '  <tr>';
			 echo   '     <th><strong><font color="black">Product</strong></font></th>';
			 echo   '     <th><strong><font color="black">Quantity</strong></font></th>';
			echo   '      <th><strong><font color="black">total price</strong></font></th>';
			 echo   '  </tr>';	


			 $r="SELECT cm.NumCommande,p.name,l.prix,l.qtc FROM commande cm,lignecommande l,tblproduct P WHERE cm.ncl='$motdepasse'AND cm.numcommande=l.numcommande AND P.code=l.code";
			 $result=mysql_query($r);

			 while($data=mysql_fetch_assoc($result)){
			 	echo '<tr>';
				echo '<td> '.$data['name'].' </td> ';
				echo '<td> '.$data['qtc'].' </td> ';
				echo '<td> '.$data['prix'].' </td> ';
				echo'</tr>';
				
				
			 }
			 $som="SELECT SUM(prix) from lignecommande l,commande c where 
			 c.NumCommande=l.NumCommande AND c.ncl='$motdepasse';";
			 $rr=mysql_query($som);
			 while($tab=mysql_fetch_assoc($rr)){

              echo "<p align='center' style='color:blue;font-family:sans-serif;font-size:50px'><b>Total purchases=".$tab['SUM(prix)']."DT</b></p> <br>";

          }
          echo"<p align='center' style='color:red;font-family:sans-serif;font-size:50px'><b>Products ordered </b></p> <br>";
			 
			}

else{
	echo "<p align='center' style='color:red;font-family:sans-serif;font-size:50px'><b>This client doesn't exist</b></p> <br>";
}
}
else
{
	echo'erreur';
}
?>
