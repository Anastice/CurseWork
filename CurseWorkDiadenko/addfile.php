<?php 
session_start();
if( ! $_SESSION['username'] )
{
	header("location:index.php");
	exit();
}

else
{
	$username = $_SESSION['username'];

	$db=mysqli_connect("localhost","root","","playlist");

	$sql = "SELECT * FROM user WHERE username = '$username' ";
	$id = 'id';
	$result = mysqli_query($db,$sql);
	while($row=mysqli_fetch_assoc($result))
	{
		$id = $row['id'];
	}

}

if( isset($_POST['add'])){
	$uid = $id;
	$title = mysqli_real_escape_string($db,$_POST['title']);
	$file = mysqli_real_escape_string($db,$_POST['url']);
	$type = mysqli_real_escape_string($db,$_POST['type']);
    $sql1="INSERT INTO filelist(user_id, title, catagory, file ) VALUES('$uid', '$title','$type','$file')"; 
    mysqli_query($db,$sql1);  
    header("location:home.php"); 
}

 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Add File On MyPlaylist</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>

	<body>
		
		<div id="site-content">
			<header class="site-header">
				<div class="container">
					<a href="index.php" id="branding">
						<img src="dummy/mylogo.png" alt="Site Title">
						<small class="site-description">Add your favourate song here</small>
					</a> <!-- #branding -->
					
					<nav class="main-navigation">
						<button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
						<ul class="menu">
						    <li class="menu-item current-menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item"><a href="register.php">Sign Up</a></li>
							<li class="menu-item"><a href="contact.php">Report Us</a></li>
						</ul> <!-- .menu -->
					</nav>  <!-- .main-navigation -->
					<div class="mobile-menu"></div>
				</div>
			</header> <!-- .site-header -->
			
			<main class="main-content">
                 <div class="fullwidth-block inner-content">
					<div class="container">
						<h2 class="page-title" style="text-align: center;">Add Your Favourate Song</h2>
						<div class="row">
							<div class="col-md-offset-3 col-md-6">
							<?php
							    if(isset($_SESSION['message']))
							    {
							         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
							         unset($_SESSION['message']);
							    }
							?>
								<form action="addfile.php" method="post" class="contact-form">
									<input type="text" placeholder="File title" name="title">
									<input type="text" placeholder="File link" name="url">

									<h3>Select video catagory</h3>
									<table>
										<tr>
										<td>
								    <input type="radio" placeholder="File title" name="type" value="Songs about Family">Songs about Family
									<input type="radio" placeholder="File title" name="type" value="Love / Relationship songs">Love / Relationship songs
									<input type="radio" placeholder="File title" name="type" value="Sad, lonely, or reflective songs">Sad, lonely, or reflective songs
									<input type="radio" placeholder="File title" name="type" value="Tutorials">Tutorials
									<input type="radio" placeholder="File title" name="type" value="others">others
										</td>
											
										</tr>
									</table>
									<br>
								  <input type="submit" value="Add File" name="add">
								</form>
							</div>
						</div>
					</div>
				</div>
			</main> <!-- .main-content -->

			<footer class="site-footer">
				<div class="container">
					
					<address>
						<p>Daffodil International University<br><a href="tel:354543543">Ashulia</a> <br> <a href="mailto:info@bandname.com">playlist@gmail.com</a></p>
					</address>
					
					<form action="#" class="newsletter-form">
						<input type="email" placeholder="Enter your email to join newsletter...">
						<input type="submit" class="button cut-corner" value="Subscribe">
					</form> <!-- .newsletter-form -->
					
					<div class="social-links">
						<a href="#"><i class="fa fa-facebook-square"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-pinterest"></i></a>
					</div> <!-- .social-links -->
					
					<p class="copy">Copyright 2014 Myplaylist. All right reserved</p>
				</div>
			</footer> <!-- .site-footer -->

		</div> <!-- #site-content -->

		<script src="js/jquery-1.11.1.min.js"></script>		
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>