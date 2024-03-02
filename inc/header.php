<?php 
	session_start();
	ob_start();
    include "admin/inc/db.php"
 ?>

<?php

	if( !empty($_SESSION['userName']) || !empty($_SESSION['userEmail']) ){

	$name       = $_SESSION['userName'];
	$emailId    = $_SESSION['userEmail'];

	$statusSql = "SELECT * FROM users WHERE name='$name' AND email='$emailId'";
	$sendDb    = mysqli_query( $db, $statusSql );

	while( $statusRow = mysqli_fetch_array( $sendDb ) ){
		$_SESSION['userId'] = $statusRow['id'];
		$userStatus         = $statusRow['status'];

		if( $userStatus == 0 ){

			ob_start();
			session_start();
			session_unset();
			session_destroy();
			header("Location: index.php");
			ob_end_flush();
	
		}
	}


  }

?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Rukada || Blog Portal</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="assets/vendor/animate/animate.min.css">
		<link rel="stylesheet" href="assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">

		<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/css/theme.css">
		<link rel="stylesheet" href="assets/css/theme-elements.css">
		<link rel="stylesheet" href="assets/css/theme-blog.css">
		<link rel="stylesheet" href="assets/css/theme-shop.css">
		<link rel="stylesheet" href="assets/css/custom.css">
		
		<!-- Demo CSS -->

		<script src="assets/js/sweetalert.js"></script>
												

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/css/skins/default.css"> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0">
					<div class="header-container container-fluid px-lg-4">
						<div class="header-row">
							<div class="header-column header-column-border-right flex-grow-0">
								<div class="header-row pr-4">
									<div class="header-logo">
										<a href="index.php">
											<img alt="Porto" width="100" height="48" data-sticky-width="82" data-sticky-height="40" src="assets/img/logo.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<div class="header-nav header-nav-links justify-content-center">
										<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse header-mobile-border-top">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a href="index.php" class="dropdown-item dropdown-toggle">
															All Post
														</a>
													</li>

													<?php
													
														$parentSql = "SELECT id AS 'pcatId', name AS 'pcatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC ";
														$parentDb  = mysqli_query($db, $parentSql);
														

														while( $row = mysqli_fetch_assoc($parentDb) ){
															extract($row);

														$childSql  = "SELECT id AS 'CcatId', name AS 'CcatName' FROM category WHERE is_parent = '$pcatId' AND status = 1 ORDER BY name ASC ";
														$childDb       = mysqli_query($db, $childSql);
														$numberOfchild = mysqli_num_rows($childDb);
														
														if( $numberOfchild == 0 ){
															?>
																<li class="dropdown">
																	<a href="category.php?id=<?php echo $pcatId ;?>" class="dropdown-item dropdown-toggle">
																		<?php echo $pcatName ;?>
																	</a>
																</li>
															<?php
														} else {

															?>
																<li class="dropdown">
																	<a class="dropdown-item dropdown-toggle" href="#">
																		<?php echo $pcatName ;?>
																	</a>
																	<ul class="dropdown-menu">
																		<?php
																			while( $childRow = mysqli_fetch_assoc($childDb) ){
																			extract ($childRow);
																			?>
																				<li class="dropdown-submenu">
																					<a class="dropdown-item" href="category.php?id=<?php echo $CcatId ;?>">
																						<?php echo $CcatName ;?>
																					</a>
																				</li>
																			<?php
																		}
																		?>																		
																	</ul>
																</li>
															<?php
															
														}

													}
															
													?>
													
													<?php

														if( empty($_SESSION['userId']) ){
															?>
																<li class="dropdown logreg">
																	<a href="login.php<?php if(isset($_GET['pId'])){$postPage = $_GET['pId'];echo "?lp=" . $postPage;}else if(isset($_GET['id'])){$categoryPage = $_GET['id']; echo "?lc=" . $categoryPage;} ?>">
																		LOG IN
																	</a>
																	<span>/</span>
																	<a href="register.php" >
																		REGISTER
																	</a>
																</li>
															<?php
														}else if( !empty($_SESSION['userId']) ) {

															$userId    = $_SESSION['userId'];
															$userImg   = "SELECT * FROM users WHERE id = '$userId' ";
															$imgDb     = mysqli_query($db, $userImg);
															
															while($row = mysqli_fetch_assoc($imgDb)){
																$img = $row['image'];
																?>
																<li class="dropdown userMenu">
																  <a class="dropdown-item dropdown-toggle" href="#">
																	<?php
																	if(!empty($img)){
																		?>
																			<img src="admin/assets/user-image/<?php echo $img; ?>" alt="" class="userImg">
																		<?php
																	}else {
																		?>
																			<img src="admin/assets/user-image/defualt.png" alt="" class="userImg">
																		<?php
																	}
																	?>
																  </a>
																  <ul class="dropdown-menu">
																	<li class="dropdown-submenu">
																		<a href="profile.php?user=<?php echo $userId; ?>" class="dropdown-item">Profile</a>
																	</li>
																	<li class="dropdown-submenu">
																		<a href="logout.php<?php if(isset($_GET['pId'])){$postPage = $_GET['pId'];echo "?lg=" . $postPage;}else if(isset($_GET['id'])){$categoryPage = $_GET['id']; echo "?lgc=" . $categoryPage;} ?>" class="dropdown-item">Log Out</a>
																	</li>																	
																  </ul>
																</li>
																<?php
															}
														}
													
													?>
													
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
							<div class="header-column header-column-border-left flex-grow-0 justify-content-center">
								<div class="header-row pl-4 justify-content-end">
									<ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean m-0">
										<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
										<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
										<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
									</ul>
									<button class="btn header-btn-collapse-nav ml-0 ml-sm-3" data-toggle="collapse" data-target=".header-nav-main nav">
										<i class="fas fa-bars"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>