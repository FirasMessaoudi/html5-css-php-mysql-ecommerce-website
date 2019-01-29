<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Tech store</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Cruise Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- fonts -->
<link href="//fonts.googleapis.com/css?family=Cinzel:400,700,900" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<!-- /fonts -->
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/gallery.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/jQuery.lightninBox.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/aos.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/index2.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/panier.css" rel="stylesheet" type="text/css" media="all" />

<!-- /css -->
<!-- js -->
<script src="js/modernizr.min.js"></script>
<!-- /js -->
<script type="text/javascript">
	
</script>
</head>
<body onload=" header('Location: index.php');
">
<!-- topbar -->
<div class="topbar-w3ls">
	<div class="container">
		<a href="index.php" class="logo">
			<h1>
				TechStore
			</h1>
		</a>		
		<div class="top-agileits">
			<div class="top-w3l1">
				<span class="glyphicon glyphicon-phone-alt"></span> 	
				<p class="agile1">+21650383993</p>
				<p class="agile2">+21620424137</p>
			</div>		
			<div class="top-w3l2">
				<a href="https://www.google.tn/maps/place/Institut+Sup%C3%A9rieur+De+Gestion+De+TUNIS/@36.8042187,10.1514986,15z/data=!4m5!3m4!1s0x0:0xfa7c2e843bea6509!8m2!3d36.8042187!4d10.1514986" target="_blank"><span class="glyphicon glyphicon-map-marker" ></span></a>
				<p class="agileits1">41 Freedom Street</p> 
				<p class="agileits2">Brado, Tunis</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>	
</div>
<!-- /topbar -->
<!-- navigation -->
<div class="navbar-wrapper">
    <div class="container">
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav cl-effect-7">
						<li class="active"><a href="index.php" class="page-scroll">Home</a></li>
						<li><a href="#about" class="page-scroll">About</a></li>
						<li><a href="login.html" class="page-scroll" target="_blank">Log In</a></li>
						<li><a href="#gallery" class="page-scroll">Our Products</a></li>
						<!--<li><a href="#team" class="page-scroll">Team</a></li>-->
						<li><a href="#contact" class="page-scroll">Contact</a></li>
					</ul>
				</div>
			</div>
        </nav>
	</div>
</div>
<!-- /navigation -->
<!-- banner -->
<section class="banner-w3ls">
		<div id="block" data-vide-bg="video/vid2" data-vide-options="position: 0% 50%">
			<div class="overlay">
				<h2>Shopping online</h2>
				<h3>You won't be able to resist all these offers</h3>
				<p>Our extensive and affordable range features the very latest electronics and gadgets including smart phones, tablets, action cams, tv boxes...</p>
				



			</div>
		</div>	
</section>
<!-- /banner -->
<!-- about -->
<section class="about-wthree" id="about" >
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-12" data-aos="flip-right">
			<h3 class="text-center">About Us</h3>
			<p class="text-center" ><font color="black"><strong>You are looking for a laptop at an unbeatable price or a mobile phone or a Smartphone with ease of payment without a bank account? Find your Laptop, Computer Server and Storage Server on our website. We are specialized in selling high-tech products and we are leading partners with industry leaders in Tunisia like Samsung, Sony, Evertek, Nokia, Huawei, HTC, HP, Dell, Lenovo, Acer, Asus, Lexmark , Epson & Brother. You can order your laptop, Smartphone, Touchscreen, Printer, Printer Accessories, Photocopier, LED Tv, Plasma Tv, Lcd Tv, Household Appliances, Office Suppliers in Tunisia or an Office Computer.</strong></font></p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12" data-aos="flip-left">
			<ul class="grid cs-style-1">
				<li>
					<figure>
						<img src="images/store3.gif" alt="img01" class="img-responsive">
						<figcaption>
							<a href="images/store3.gif" class="lightninBox" data-lb-group="1">View More</a>
						</figcaption>
					</figure>
				</li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /about -->
<!-- gallery -->
<section class="gallery-info" id="gallery" >

	<div class="container">
		<h3 class="text-center" data-aos="zoom-in" style="color: skyblue"><strong>Our Products</strong></h3>
		
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>	
<table cellpadding="10" cellspacing="1">
<tbody>
<tr >
<th style="text-align:left;color:blue;"><strong>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></th>
<th style="text-align:left;color:blue;"><strong>Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></th>
<th style="text-align:center;color:blue;"><strong>Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></th>
<th style="text-align:right;color:blue;"><strong>Price</strong></th>
<th style="text-align:center;color:blue;"><strong>Action</strong></th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;color:blue;"><?php echo $item["name"]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;color:blue;"><?php echo $item["code"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;color:blue;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;color:blue;"><?php echo "".$item["price"]; ?>DT</td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;color:blue;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><strong>Remove Item</strong></a></td>
				</tr>
				<?php
        $item_total += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong><font color="red"><strong><?php echo "".$item_total; ?>DT</strong></font></td>
</tr>
</tbody>
</table>		
  <?php
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE Qts>0 ORDER BY price DESC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form name="f1" method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
			<a href="<?php echo $product_array[$key]["desc"]; ?>" target="_blank"><strong><font color="red">View More</font></strong></a>
			<div class="product-price"><?php echo "".$product_array[$key]["price"]; ?>DT</div>
			<div id="qt"><?php echo $product_array[$key]["Qts"]; ?> items</div>
			<div><input type="text" name="quantity" value="1" size="2" />
			<input type="submit" value="Add to cart" class="btnAddAction" /></div>
			</form>
		</div>
	<?php
			}
	}
	?>
	
		<a href="check.html" target="_blank"><button class="btn btn-outline btn-lg" type="submit">CheckOut</button></a>
	
</div>



		
    </div>
</section>
<!-- /gallery -->
<!--contact-->
<section class="contact-w3-agileits" id="contact">
	<div class="container">
		<h3 class="text-center" data-aos="zoom-in" style="color: #e74c3c" ><strong>GET IN TOUCH</strong></h3>
		
		<div class="col-lg-8 col-md-8 contact-w3l2" data-aos="flip-left">
			<form action="contact.php" method="post">
				<div class="form-group col-md-4 col-sm-4">
					<input type="text" class="form-control" id="name" name="name" placeholder=" Your Name" required  />
				</div>
				<div class="form-group col-md-4 col-sm-4">
					<input type="email" class="form-control" id="email2" name="email2" placeholder="Your Email" required />
				</div>
				<div class="form-group col-md-4 col-sm-4">
					<input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone" required />
				</div>
				<div class="clearfix"></div>
				<div class="form-group col-md-12">
					<textarea class="form-control" rows="6" name="message" placeholder="Your Message" required ></textarea>
				</div>
				<div class="form-group col-md-12">
					<button type="submit" class="btn-outline2"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Submit</button>
				</div>
				<div class="clearfix"></div>
			</form>	
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /contact -->
<!-- footer -->
<section class="footer-w3-agileits">
	<div class="container">
		<div class="col-lg-8 col-md-8">
			<ul class="w3-agile">
				<li><a href="index.php" class="page-scroll">Home</a></li>
				<li><a href="#about" class="page-scroll">About</a></li>
				<li><a href="login.html" class="page-scroll" target="_blank">Log In</a></li>
				<li><a href="#gallery" class="page-scroll">Our Products</a></li>
				<!--<li><a href="#team" class="page-scroll">Team</a></li>-->
				<li><a href="#contact" class="page-scroll">Contact</a></li>
			</ul>
		</div>
		<div class="col-lg-4 col-md-4">
			<ul class="social-icons2">
				<li><a href="#"><i class="fa fa-facebook"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter"></i></a></li>
				<li><a href="#"><i class="fa fa-youtube"></i></a></li>
				<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
			</ul>	
		</div>
		
	</div>
	<div class="w3footeragile">
		<p align="center"> &copy; 2017 online shopping. All Rights Reserved | created by<strong><font color="blue"> Messaoudi Firas & Huiji Haythem</font></strong></p>
	</div>s


</section>
<!-- /footer -->
<!-- back to top -->
<a href="#0" class="cd-top">Top</a>
<!-- /back to top -->
<!-- js files -->
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/grayscale.js"></script>
<script src='js/aos.js'></script>
<script src="js/index.js"></script>
<!-- js for back to top -->
<script src="js/top.js"></script>
<!-- /js for back to top -->
<!-- js for about lightbox -->
<script src="js/jQuery.lightninBox.js"></script>
<script type="text/javascript">
	$(".lightninBox").lightninBox();
</script>
<!-- /js for about lightbox -->
<!-- js for gallery -->
<script src="js/jquery.picEyes.js"></script>
<script>
$(function(){
	//picturesEyes($('li'));
	$('ul.demo li').picEyes();
});
</script>
<!-- /js for gallery -->
<!-- js for banner -->
<script src="js/jquery.vide.js"></script>
<!-- /js for banner -->
<!-- /js files -->

</body>
</html>