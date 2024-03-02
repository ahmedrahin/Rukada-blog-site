<?php
    include "inc/header.php";
?>
			<div role="main" class="main">

                <section class="page-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Register</h1>
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
                                            <h4>Register An Account</h4>
                                            <form action="" method="POST">
                                                
                                                <div class="form-gorup mb-3">
                                                    <label for="name">Full Name</label>
                                                    <input type="text" name="name" id="name" required>
                                                </div>    

                                                <div class="form-gorup  mb-3">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" name="email" id="email" required>
                                                </div> 

                                                <div class="form-gorup">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password" required>
                                                </div> 

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="submit" name="btnRegister" value="Register" class="btn btn-primary pull-right push-bottom" data-loading-text="Loading...">
                                                    </div>
                                                </div>

                                                <?php

                                                    if(isset($_POST['btnRegister'])){

                                                        $userName              = mysqli_real_escape_string($db, $_POST['name']);
                                                        $userEmail             = mysqli_real_escape_string($db, $_POST['email']);
                                                        $userPassword          = mysqli_real_escape_string($db, $_POST['password']);
                                                        $password              = sha1($userPassword);
                                                        

                                                        $addUser = "INSERT INTO users (name, email, password, role) VALUES ('$userName', '$userEmail', '$password', 2)";
                                                        $addDb   = mysqli_query($db, $addUser);

                                                        if($addDb){
                                                            header("Location: index.php");
                                                        }else {
                                                            die();
                                                        }

                                                        $_SESSION['userName']   = $userName;
                                                        $_SESSION['userEmail']  = $userEmail;

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
	