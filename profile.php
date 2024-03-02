<?php
    include "inc/header.php";
?>
			<div role="main" class="main">

				<section class="page-header page-header-modern bg-color-light-scale-1 page-header-lg">
					<div class="container">
						<div class="row">
							<div class="col-md-12 align-self-center p-static order-2 text-center">
                                <h1 class="font-weight-bold text-dark">
                                    <!-- user name -->
                                    <?php
                                        if( isset($_GET['user']) ){
                                            $userId  = $_GET['user'];
                                            $Sql     = "SELECT * FROM users WHERE id = $userId";
                                            $userDb  = mysqli_query($db, $Sql);
    
                                            while( $row = mysqli_fetch_array($userDb) ){
                                                $name      = $row['name'];
                                                echo $name;
                                            }
                                        }
                                    ?>
                                </h1>
                            </div>
                            <div class="col-md-12 align-self-center order-1">
								<ul class="breadcrumb d-block text-center">
									<li><a href="index.php">Home</a></li>
									<li class="active">USER Profile</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container pt-3 pb-2">

					<div class="row pt-2">
						<div class="col-lg-3 mt-4 mt-lg-0">

							<div class="d-flex justify-content-center mb-4">
								<div class="profile-image-outer-container">
									<div class="profile-image-inner-container bg-color-primary">
                                        
                                        <!-- user image -->
                                        <?php
                                            if( isset($_GET['user']) ){
                                                $userId  = $_GET['user'];
                                                $Sql     = "SELECT * FROM users WHERE id = '$userId'";
                                                $userDb  = mysqli_query($db, $Sql);
        
                                                while( $row = mysqli_fetch_array($userDb) ){
                                                    $image      = $row['image'];

                                                    if( !empty($image) ){
                                                        ?>
                                                        <a href="" class="addPopup" type="button" data-bs-toggle="modal" data-bs-target="#add<?php echo $userId; ?>"></a>
                                                            <img src="admin/assets/user-image/<?php echo $image; ?>" class="userProfile" id="imgs">
                                                            <form action="" method="POST">
                                                                <button type="submit" name="btnDel" class="profile-image-button bg-color-dark profileS">
                                                                    <span>
                                                                        <i class="fas fa-trash"></i>
                                                                    </span>
                                                                </button>
                                                            </form>

                                                            <?php
                                                                if( !empty($_SESSION['status-image']) ){
                                                                    ?> <script src="assets/js/sweetalert.js"></script><?php
                                                                    if(!empty( $_SESSION['status-image'])){
                                                                        ?>
                                                                          <script>
                                                                            swal({
                                                                            title: "<?php echo $_SESSION['status-image']; ?>",
                                                                            icon: "<?php echo $_SESSION['status-item']; ?>",
                                                                            });
                                                                          </script>
                                                                        <?php
                                                                         unset($_SESSION['status-image']); 
                                                                    }
                                                                }
                                                            ?>
                                                            
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="add<?php echo $userId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fas fa-window-close"></i>
                                                                </button>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Upload New Profile
                                                                </h1>
                                                                </div>

                                                                <div class="d-flex justify-content-center mb-4">
                                                                    <div class="profile-image-outer-container">
                                                                        <div class="profile-image-inner-container bg-color-primary">
                                                                            <img src="admin/assets/user-image/<?php echo $image; ?>" alt="" id="imgs2">
                                                                            <span class="profile-image-button bg-color-dark">
                                                                                <i class="fas fa-camera text-light"></i>
                                                                            </span>
                                                                        </div>
                                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                                            <input id="inputs" name="newImg" type="file" class="form-control profile-image-input">
                                                                            <input type="submit" value="Upload Profile" name="btnAdd" class="addImg btn btn-primary btn-modern float-end">
                                                                            
                                                                        <!-- add new img -->
                                                                        <?php
                                                                        
                                                                            if( isset($_POST['btnAdd']) ){
                                                                                if( !empty($_SESSION['status-image']) && !empty($_SESSION['status-item']) ){
                                                                                    ?>
                                                                                        <span>
                                                                                            <?php echo $_SESSION['status-image']; ?>
                                                                                        </span>
                                                                                    <?php
                                                                                } 
                                                                                
                                                                                else{
                                                                                    $image              = $_FILES['newImg']['name'];
                                                                                    $imageTmp           = $_FILES['newImg']['tmp_name'];
                                                                                    $imageType          = $_FILES['newImg']['type'];

                                                                                    $img                =  rand(1,99999) . '-' . $image;
                                                                                    move_uploaded_file($imageTmp, "admin/assets/user-image/" . $img);
                                                                                    
                                                                                    if( !empty( $image ) ){
                                                                                    if( $imageType == "image/png" || $imageType == "image/jpeg" ){
                                                                                        
                                                                                            $addImg = "UPDATE users SET image='$img' WHERE id = '$userId' ";
                                                                                            $addDb   = mysqli_query($db, $addImg); 
                                                                                            header("Location: profile.php?user=$userId"); 

                                                                                            if($addImg) {
                                                                                                $_SESSION['status-image'] = "Profile Uploaded";
                                                                                                $_SESSION['status-item'] = "success";
                                                                                                header("Location: profile.php?user=$userId");  
                                                                                            }
                                                                                        
                                                                                    } else {
                                                                                        $_SESSION['status-image'] = "Please Select a valid photo";
                                                                                        $_SESSION['status-item'] = "error";
                                                                                        header("Location: profile.php?user=$userId");  
                                                                                    }
                                                                                } else {
                                                                                        $_SESSION['status-image'] = "Please select a photo";
                                                                                        $_SESSION['status-item'] = "info";
                                                                                        header("Location: profile.php?user=$userId");  
                                                                                }
                                                                            }
                                                                        }

                                                                        ?>

                                                                        </form>
									
                                                                    </div>
                                                                </div>           
                                                                
                                                                </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <!-- delete image -->
                                                            <?php
                                                                if( isset($_POST['btnDel']) ){
                                                                    $img = null;
                                                                    $remove = "UPDATE users SET image = '$img' WHERE id = '$userId'";
                                                                    $imagdel = mysqli_query($db, $remove);
                                                                    header("Location: profile.php?user=$userId");

                                                                    if($imagdel){
                                                                        $_SESSION['status-image'] = "Profile is Deleted";
                                                                        $_SESSION['status-item'] = "success";
                                                                        header("Location: profile.php?user=$userId");  
                                                                    }

                                                                }
                                                                ?>
                                                        <?php
                                                    }

                                                    // no user image 
                                                    else {
                                                        ?>
                                                            <a href="" class="addPopup" type="button" data-bs-toggle="modal" data-bs-target="#add<?php echo $userId; ?>"></a>
                                                            <img src="admin/assets/user-image/defualt.png" alt="" id="imgs">
                                                            <span class="profile-image-button bg-color-dark">
                                                                <i class="fas fa-camera text-light"></i>
                                                            </span>
                                                            <?php
                                                                if( !empty($_SESSION['status-image']) ){
                                                                    ?> <script src="assets/js/sweetalert.js"></script><?php
                                                                    if(!empty( $_SESSION['status-image'])){
                                                                        ?>
                                                                          <script>
                                                                            swal({
                                                                            title: "<?php echo $_SESSION['status-image']; ?>",
                                                                            icon: "<?php echo $_SESSION['status-item']; ?>",
                                                                            });
                                                                          </script>
                                                                        <?php
                                                                         unset($_SESSION['status-image']); 
                                                                    }
                                                                }
                                                            ?>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="add<?php echo $userId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i class="fas fa-window-close"></i>
                                                                </button>
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Select Your Profile
                                                                </h1>
                                                                </div>

                                                                <div class="d-flex justify-content-center mb-4">
                                                                    <div class="profile-image-outer-container">
                                                                        <div class="profile-image-inner-container bg-color-primary">
                                                                            <img src="admin/assets/user-image/defualt.png" alt="" id="imgs2">
                                                                            <span class="profile-image-button bg-color-dark">
                                                                                <i class="fas fa-camera text-light"></i>
                                                                            </span>
                                                                        </div>
                                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                                            <input id="inputs" name="newImg" type="file" class="form-control profile-image-input">
                                                                            <input type="submit" value="Upload Profile" name="btnAdd" class="addImg btn btn-primary btn-modern float-end">
                                                                            
                                                                        <!-- add new img -->
                                                                        <?php
                                                                        
                                                                            if( isset($_POST['btnAdd']) ){
                                                                                if( !empty($_SESSION['status-image']) && !empty($_SESSION['status-item']) ){
                                                                                    ?>
                                                                                        <span>
                                                                                            <?php echo $_SESSION['status-image']; ?>
                                                                                        </span>
                                                                                    <?php
                                                                                }  
                                                                                
                                                                                else{
                                                                                    $image              = $_FILES['newImg']['name'];
                                                                                    $imageTmp           = $_FILES['newImg']['tmp_name'];
                                                                                    $imageType          = $_FILES['newImg']['type'];

                                                                                    $img                =  rand(1,99999) . '-' . $image;
                                                                                    move_uploaded_file($imageTmp, "admin/assets/user-image/" . $img);

                                                                                    if(!empty($image)){
                                                                                        
                                                                                    if( $imageType == "image/png" || $imageType == "image/jpeg" ){
                                                                                        if( !empty( $image ) ){
                                                                                            $addImg = "UPDATE users SET image='$img' WHERE id = '$userId' ";
                                                                                            $addDb   = mysqli_query($db, $addImg); 
                                                                                            header("Location: profile.php?user=$userId");  

                                                                                            if($addImg) {
                                                                                                $_SESSION['status-image'] = "Profile Uploaded";
                                                                                                $_SESSION['status-item'] = "success";
                                                                                                header("Location: profile.php?user=$userId");  
                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        $_SESSION['status-image'] = "Please Select a valid photo";
                                                                                        $_SESSION['status-item'] = "error";
                                                                                        header("Location: profile.php?user=$userId");  
                                                                                    }
                                                                              }else {
                                                                                $_SESSION['status-image'] = "Please select a photo";
                                                                                $_SESSION['status-item'] = "info";
                                                                                header("Location: profile.php?user=$userId"); 
                                                                              }
                                                                            }
                                                                        }

                                                                        ?>

                                                                        </form>
									
                                                                    </div>
                                                                </div>           
                                                                
                                                                </div>
                                                                </div>
                                                            </div>
                                                            
                                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
										
										
									</div>
									
								</div>
							</div>

							<aside class="sidebar mt-2" id="sidebar">
								<ul class="nav nav-list flex-column mb-5">
									<li class="nav-item"><a class="nav-link text-3 text-dark active" href="#">My Profile</a></li>
									<li class="nav-item"><a class="nav-link text-3" href="#">User Preferences</a></li>
									<li class="nav-item"><a class="nav-link text-3" href="#">Billing</a></li>
									<li class="nav-item"><a class="nav-link text-3" href="#">Invoices</a></li>
								</ul>
							</aside>

						</div>
						<div class="col-lg-9">

							<form role="form" method="POST" class="needs-validation">

                                <!-- user information -->
                                <?php
                                
                                    if( isset($_GET['user']) ){
                                        $userId  = $_GET['user'];
                                        $Sql     = "SELECT * FROM users WHERE id = $userId";
                                        $userDb  = mysqli_query($db, $Sql);

                                        while( $row = mysqli_fetch_array($userDb) ){

                                            $name      = $row['name'];
                                            $email     = $row['email'];
                                            $phone     = $row['phone'];
                                            $password  = $row['password'];
                                            $address   = $row['address'];
                                            $name      = $row['name'];

                                            ?>
                                            
                                            <input type="hidden" name="updateUser" value="<?php echo $userId; ?>">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Your Name</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="name" value="<?php echo $name; ?>" placeholder="Your name.." required>
                                                </div>
                                            </div>
                
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Your Email</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="email" name="email" value="<?php echo $email; ?>" placeholder="Your email.." required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Your Phone</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Your phone..">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Address</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="address" value="<?php echo $address; ?>" placeholder="Street">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"></label>
                                                <div class="col-lg-6">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="city" value="" placeholder="City">
                                                </div>
                                                <div class="col-lg-3">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="state" value="" placeholder="State">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Username</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="text" name="username" placeholder="Username..">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 pl">Password</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="password" name="password" placeholder="*****">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Confirm password</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control text-3 h-auto py-2" type="password" name="repassword" placeholder="*****">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="form-group col-lg-9">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <input type="submit" value="Save Changes" name="btnUpdate" class="btn btn-primary btn-modern float-end" data-loading-text="Loading...">
                                                </div>
                                            </div>
                                              <?php

                                        }
                                    }

                                    if( !empty($_SESSION['status']) ){
                                        ?> <script src="assets/js/sweetalert.js"></script><?php
                                        if(!empty( $_SESSION['status'])){
                                            ?>
                                                <script>
                                                    swal({
                                                    title: "<?php echo $_SESSION['status']; ?>",
                                                    icon: "<?php echo $_SESSION['status-item']; ?>",
                                                    });
                                                </script>
                                            <?php
                                                unset($_SESSION['status']); 
                                        }
                                    }
                                
                                ?>		
                                
                                    <!-- update info -->
                                    <?php
                                    
                                        if( isset($_POST['btnUpdate']) ){

                                            if(!empty($_SESSION['status']) && !empty($_SESSION['status-item']) ){

                                                ?>
                                                    <span>
                                                        <?php echo $_SESSION['status']; ?>
                                                    </span>
                                                 <?php

                                            }
                                            else {

                                                $upId            = $_POST['updateUser'];
                                                $upName          = mysqli_real_escape_string($db, $_POST['name']);
                                                $upEmail         = mysqli_real_escape_string($db, $_POST['email']);
                                                $upPhone         = mysqli_real_escape_string($db, $_POST['phone']);
                                                $upAddress       = mysqli_real_escape_string($db, $_POST['address']);
                                                $upPass          = mysqli_real_escape_string($db, $_POST['password']);
                                                $rePass          = mysqli_real_escape_string($db, $_POST['repassword']);

                                                if( !empty($upPass) ){

                                                    if( $upPass == $rePass ){
                                 
                                                     $pass = sha1($upPass);
                                                     $updateSql = " UPDATE users SET name='$upName', email='$upEmail', password='$pass', phone='$upPhone', address='$upAddress' WHERE id = '$upId' ";
                                                     $upDb    = mysqli_query($db, $updateSql);
                                 
                                                     if($updateSql){
                                                        $_SESSION['status']      = "Update Successfully";
                                                        $_SESSION['status-item'] = "success";
                                                         header("Location: profile.php?user=$upId");
                                                     }
                                 
                                                    }else {
                                                      $_SESSION['status']      = "Your Password Doesn't Match!";
                                                      $_SESSION['status-item'] = "error";
                                                      header("Location: profile.php?user=$upId");
                                                    }
                                 
                                                 }
                                                //  without password
                                                 else {

                                                        if(!empty( $upName || $upEmail || $upPhone || $upAddress )){

                                                            $updateSql = " UPDATE users SET name='$upName', email='$upEmail', phone='$upPhone', address='$upAddress' WHERE id = '$upId' ";
                                                            $upDb      = mysqli_query($db, $updateSql);
                                                            
                                                            if($updateSql){
                                                                $_SESSION['status']      = "Update Successfully";
                                                                $_SESSION['status-item'] = "success";
                                                                header("Location: profile.php?user=$upId");
                                                            }

                                                        }
                                                 }   
                                            }
                                        }
                                    
                                    ?>

							</form>
						</div>
					</div>

				</div>

			</div>

<?php
    include "inc/footer.php";
?>

