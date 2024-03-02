<?php
    include "inc/header.php";
?>
			<div role="main" class="main">

                <section class="page-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Log In</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="container">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="row featured-boxes login">
                                <div class="col-lg-6 offset-lg-3">
                                    <div class="featured-box featured-box-secundary default info-content">
                                        <div class="box-content">
                                            <h4>I'M A USER</h4>
                                            <form action="" method="POST">  

                                            <?php
      
                                                if( !empty($_SESSION['error_msg']) ){
                                                ?>
                                                    <div class="alert alert-danger">
                                                        <?php echo $_SESSION['error_msg']; ?>
                                                    </div>
                                                <?php
                                                session_unset();
                                                session_destroy();
                                                }
                                            
                                            ?>

                                                <div class="form-gorup  mb-3">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" id="email" required>
                                                </div> 

                                                <div class="form-gorup mb-3">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password" required>
                                                </div> 

                                                <div class="form-gorup">
                                                    <label for="repassword">Re-Enter Password</label>
                                                    <input type="password" name="repassword" id="repassword" required>
                                                </div> 

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" name="btnLogin" value="Log In" class="btn btn-primary pull-right push-bottom btnlogin">
                                                    </div>
                                                </div>

                                                <?php

                                                    if(isset($_POST['btnLogin'])){

                                                        $email       = mysqli_real_escape_string($db , $_POST['email']);
                                                        $password    = mysqli_real_escape_string($db , $_POST['password']);
                                                        $rePassword  = mysqli_real_escape_string($db, $_POST['repassword']);
                                                        
                                                        if( $password == $rePassword ){
                                                            $hasspass    = sha1($password);         
                                                            $loginSql    = "SELECT * FROM users WHERE email='$email' AND status = 1 ";
                                                            $userAth     = mysqli_query( $db , $loginSql );
                                                            $userCount   = mysqli_num_rows($userAth);

                                                            if( $userCount == 1){
                                                                while( $loginRow = mysqli_fetch_array($userAth) ){

                                                                    $_SESSION['userId']            = $loginRow['id'];
                                                                    $_SESSION['userName']          = $loginRow['name'];
                                                                    $_SESSION['userEmail']         = $loginRow['email'];
                                                                    $userPassword                  = $loginRow['password'];
                                                                    $status                        = $loginRow['status'];
                                                                    
                                                                    if( $_SESSION['userEmail'] == $email && $userPassword == $hasspass ){

                                                                        if(isset($_GET['lp'])){
                                                                            $postPage = $_GET['lp'];
                                                          
                                                                            header("Location: single.php?pId=$postPage");
                                                          
                                                                          }else if (isset($_GET['lc'])){
                                                                            $CatPage = $_GET['lc'];
                                                          
                                                                            header("Location: category.php?id=$CatPage");
                                                          
                                                                          }
                                                                          else {
                                                                            header("Location: index.php");
                                                                          }

                                                                    } 

                                                                    else if ( $_SESSION['userEmail'] != $email || $userPassword != $hasspass ){

                                                                        $_SESSION['error_msg'] = 'Your information is invalid';
                                                                        if(isset($_GET['lp'])){
                                                                          $postPage = $_GET['lp'];
                                                          
                                                                          header("Location: login.php?lp=$postPage");
                                                          
                                                                        }else if (isset($_GET['lc'])){
                                                                          $CatPage = $_GET['lc'];
                                                          
                                                                          header("Location: login.php?lc=$CatPage");
                                                          
                                                                        }else {
                                                                          header("Location: login.php");
                                                                        }

                                                                    }

                                                                    else {

                                                                        $_SESSION['error_msg'] = 'User not found!';
                                                                        if(isset($_GET['lp'])){
                                                                            $postPage = $_GET['lp'];

                                                                            header("Location: login.php?lp=$postPage");

                                                                        }else if (isset($_GET['lc'])){
                                                                            $CatPage = $_GET['lc'];

                                                                            header("Location: login.php?lc=$CatPage");

                                                                        }
                                                                        else {
                                                                            header("Location: login.php");
                                                                        }

                                                                    }
                                                            }

                                                        } else {

                                                            $_SESSION['error_msg'] = 'User not found!';
                                                            if(isset($_GET['lp'])){
                                                                $postPage = $_GET['lp'];

                                                                header("Location: login.php?lp=$postPage");

                                                            }else if (isset($_GET['lc'])){
                                                                $CatPage = $_GET['lc'];

                                                                header("Location: login.php?lc=$CatPage");

                                                            }
                                                            else {
                                                                header("Location: login.php");
                                                            }

                                                        }
                                                        
                                                        }else {
                                                            $_SESSION['error_msg'] = "Your Password & Retype Password doesn't match";
                                                            if(isset($_GET['lp'])){
                                                              $postPage = $_GET['lp'];
                                              
                                                              header("Location: login.php?lp=$postPage");
                                              
                                                            }else if (isset($_GET['lc'])){
                                                              $CatPage = $_GET['lc'];
                                              
                                                              header("Location: login.php?lc=$CatPage");
                                              
                                                            }else {
                                                              header("Location: login.php");
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
                    </div>

                </div>

            </div>

            
<?php
    ob_end_flush();
    include "inc/footer.php";
?>
	