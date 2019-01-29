<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="css/login.css" type="text/css" media="all">

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<body background="images/bg.jpg">

</body>
</html>




<?php
session_start();
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
 foreach ($_SESSION["cart_item"] as $item){
 	$item_total+= ($item["price"]*$item["quantity"]);
 }
    @mysql_connect("localhost","root","");
    @mysql_select_db("test");
$name=$_POST['First'];
$email=$_POST['Email'];
$cin=$_POST['CIN'];
$mobile=$_POST['Number'];
$adresse=$_POST['YourAdress'];
$date=date('y-m-d');

$req="SELECT*FROM client WHERE cin='$cin'";
$res=mysql_query($req);
if(mysql_num_rows($res)>0){
	echo "<p align='center' style='color:green;font-family:forte;font-size:50px'><b>You are an existant  client you can login and order  </b></p> <br>";   
	?>
	?>
	<a href="check.html"><input type="submit" value="Go Back" align="center"></a>
	<?php 
		
}else{
$req="INSERT INTO client(nom,email,adresse,cin,tel)VALUES('$name','$email','$adresse','$cin','$mobile')";
$req1="INSERT INTO commande VALUES('','$date','$cin','$item_total')";

$r=mysql_query($req);
$r1=mysql_query($req1);
if(!$r)
	echo"Cannot add this client <br>";
else
echo "<p align='center' style='color:green;font-family:forte;font-size:50px'><b>Client has been successfully registred</b></p> <br>";	

if(!$r1)
	echo"Echec de l'ajout de la commande <br>";
else
	echo "<p align='center' style='color:green;font-family:forte;font-size:50px'><b>Your order has been successfully registred</b></p> <br>";









 foreach ($_SESSION["cart_item"] as $item){

$qt=$item["quantity"];
$p=$item["price"]*$qt;
$c=$item["code"]; 
$requete="INSERT INTO lignecommande(NumCommande,code,qtc,prix) VALUES ((SELECT MAX(NumCommande) FROM commande ),'$c','$qt','$p')";
$up="UPDATE tblproduct SET Qts= Qts-'$qt' WHERE code='$c'";

        $result=mysql_query($requete);
       $rup=mysql_query($up);
        if(!$result)
        	echo'erreur ligne commande <br>';
        if(!$rup)
        	echo'erreur mise a jour';
        	
        		
        


 }

?>	
<link href="style2.css" rel="stylesheet" type="text/css" media="all" />
<table cellpadding="10" cellspacing="1">

<tbody>
<tr>
<th style="text-align:left;"><strong>Name</strong></th>
<th style="text-align:left;"><strong>Code</strong></th>
<th style="text-align:center;"><strong>Quantity</strong></th>
<th style="text-align:right;"><strong>Price</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["price"]; ?></td>
				
				</tr>
				<?php
      
        
		}

		
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>	

  <?php
}
}else{
	echo'No item in cart';
}
echo'';

?>


