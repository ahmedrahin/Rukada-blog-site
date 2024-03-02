<?php
include "inc/header.php";
?>

<!--start page wrapper -->
<div class="page-wrapper">
<div class="page-content">

    <?php
    
        $do = ( isset($_GET['do']) ) ? $_GET['do'] : "manage"; 

        if( $do == 'manage' ){

            ?>

                <div class="card">
                    <div class="card-body">
                        <h5 style="padding: 15px 0 10px;">Manage All User</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $userinfo  = "SELECT id as 'userID', name as 'userName', email as 'userEmail', phone as 'userPhone', address as 'userAddress', role as 'role', status as 'userStatus', image as 'userImage' FROM users ORDER BY name ASC";
                                    $userDb    = mysqli_query($db, $userinfo);
                                    $total_row = mysqli_num_rows($userDb);
                                    $sl        = 0;

                                    if( $total_row != 0 ){

                                        while( $userRow = mysqli_fetch_assoc($userDb) ){

                                           extract($userRow);
                                         
                                            $sl +=1;

                                            ?>

                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td><?php 
                                                        if (!empty($userImage)){
                                                            ?>
                                                                <img src="assets/user-image/<?php echo $userImage;?>" alt="" class="image">
                                                            <?php
                                                        }else {
                                                            ?>
                                                                <img src="assets/user-image/defualt.png" alt=""class="image">
                                                            <?php
                                                        }
                                                    ?></td>
                                                    <td><?php echo $userName; ?></td>
                                                    <td><?php echo $userEmail; ?></td>
                                                    <td><?php echo $userPhone; ?></td>
                                                    <td><?php echo $userAddress; ?></td>
                                                    <td>
                                                        <?php
                                                            if($role == 1){
                                                                echo "<span style='#c82333'>Admin</span>";
                                                            }else {
                                                                echo "User";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td align="center">
                                                    <?php
                                                        if($userStatus == 1){
                                                            echo "<span class=\" badge badge-success active_user \">Active</span>";
                                                        }else {
                                                            echo "<span class=\" badge badge-danger inactive-user \">Inactive</span>";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                        <li>
                                                            <a href="user.php?do=edit&id=<?php echo $userID; ?>">
                                                            <i class="bx bx-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="" type="button" data-bs-toggle="modal" data-bs-target="#delUser<?php echo $userID; ?>" >
                                                            <i class="bx bx-trash"></i>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delUser<?php echo $userID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-danger">
                                                        <a href="user.php?do=delete&did=<?php echo $userID; ?>">Confirm</a>
                                                    </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php


                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No User Found </div>";
                                    }
                                
                                ?>

                                    
                                    
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

            <?php

        } 

        else if( $do == 'add' ){

            ?>

            <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Add New User</h3>
            </div>
            
            <div class="card-body" style="display: block;">
                <form action="user.php?do=store" method="POST" enctype="multipart/form-data" class="addUser">
                    <div class="row g-lg-5">
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" id="name" placeholder="Write Your Name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" id="phone" placeholder="Enter Your Number" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label for="address">Your Address</label>
                            <input type="text" name="address" id="address" placeholder="Write Your Address" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="form-group">
                            <label for="Password">Your Password</label>
                            <input type="Password" name="password" id="Password" placeholder="Enter Your Password" maxlength="6" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="re-type">Re-Type Password</label>
                            <input type="Password" name="reType" id="re-type" placeholder="ReType Password" maxlength="6" class="form-control"  required>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label for="role">User Role</label>
                            <select name="role" id="role" required class="form-control">
                                <option value=''>Select User Role</option>
                                <option value="1"> Admin </option>
                                <option value="2"> User </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label for="status">Account Status</label>
                            <select name="status" id="status" required class="form-control">
                                <option value=''>Select User Status</option>
                                <option value="1"> Active </option>
                                <option value="0"> Inactive </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="form-group">
                            <label for="image">Choose Image</label>
                            <input type="file" name="user-image" id="image" class="form-control">
                        </div>
                    </div>

                    <input type="submit" value="Submit" name="btnSubmit" class="form-control">
                        
                    </div>
                </form>
            </div>
            </div>

            <?php

        }

        else if( $do == 'store' ){

            if( isset($_POST['btnSubmit']) ){
                
                $name               = mysqli_real_escape_string($db, $_POST['name']);
                $email              = mysqli_real_escape_string($db, $_POST['email']);
                $password           = mysqli_real_escape_string($db, $_POST['password']);
                $re_typePassword    = mysqli_real_escape_string($db, $_POST['reType']);
                $phone              = mysqli_real_escape_string($db, $_POST['phone']);
                $address            = mysqli_real_escape_string($db, $_POST['address']);
                $userRole           = mysqli_real_escape_string($db, $_POST['role']);
                $status             = mysqli_real_escape_string($db, $_POST['status']);
                $image              = $_FILES['user-image']['name'];
                $imageTmp           = $_FILES['user-image']['tmp_name'];
                $imgType            = $_FILES['user-image']['type'];



                    if( $password == $re_typePassword ){
                        $hassedPass = sha1($password);

                        // image
                        if(!empty($image)){
                            if($imgType == "image/png" || $imgType == "image/jpeg"){

                                $img = rand(1, 999999) . "-" . $image;
                                move_uploaded_file($imageTmp, "assets/user-image/" . $img);

                                $addSql = "INSERT INTO users (name, email, password, phone, address, role, status, image) VALUES ('$name' , '$email' , '$hassedPass' , '$phone' , '$address', '$userRole', '$status', '$img')";
                                $addUser = mysqli_query($db, $addSql); 
                        
                                if($addUser){
                                    header("Location: user.php?do=manage");
                                }else {
                                    die();
                                }

                                

                            }else {
                                echo "<h3>Please choose Png or Jpg version</h3>";
                            }
                        } else {

                            $img = null;

                            $addSql = "INSERT INTO users (name, email, password, phone, address, role, status) VALUES ('$name' , '$email' , '$hassedPass' , '$phone' , '$address', '$userRole', '$status')";
                        $addUser = mysqli_query($db, $addSql); 

                        if($addUser){
                            header("Location: user.php?do=manage");
                        }else {
                            die();
                        }

                        }

                        
                        }else {
                            echo "<h3>Password or Re-type Password doesn't match</h3>";
                        }

                
                
            }

        }

        else if( $do == 'edit' ){

            if( isset($_GET['id']) ){
                $user_id = $_GET['id'];
                $editSql = "SELECT * FROM users WHERE id = '$user_id'";
                $editDb  = mysqli_query($db, $editSql);

                while($userRow = mysqli_fetch_array($editDb)){

                    $userID         = $userRow['id'];
                    $userName       = $userRow['name'];
                    $userEmail      = $userRow['email'];
                    $userPassword   = $userRow['password'];
                    $userPhone      = $userRow['phone'];
                    $userAddress    = $userRow['address'];
                    $role           = $userRow['role'];
                    $userStatus     = $userRow['status'];
                    $userImage      = $userRow['image'];

                    ?>

                    <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title"> Change User Information </h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="user.php?do=update" method="POST" enctype="multipart/form-data" class="addUser">

                        <input type="hidden" name="updateId" value="<?php echo $userID; ?>">
                        <input type="hidden" name="oldImg" value="<?php echo $userImage; ?>">

                            <div class="row g-lg-5">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" placeholder="Write Your Name" class="form-control" value="<?php echo $userName; ?>"  required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Enter Your Email" class="form-control" value="<?php echo $userEmail; ?>" <?php 
                                    if( $role == 2 ){
                                        echo "readonly";
                                    }
                                    ?> >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter Your Number" class="form-control" value="<?php echo $userPhone; ?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="address">Your Address</label>
                                    <input type="text" name="address" id="address" placeholder="Write Your Address" class="form-control" value="<?php echo $userAddress; ?>" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="Password">Your Password</label>
                                    <input type="Password" name="password" id="Password" class="form-control" placeholder="*******">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="re-type">Re-Type Password</label>
                                    <input type="Password" name="reType" id="re-type" placeholder="*******" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="role">User Role</label>
                                    <select name="role" id="role" class="form-control" required>
                                    <option value=''>Select User Role</option>
                                        <option value="1" <?php 
                                        if ($role == 1){ 
                                            echo "selected";
                                        }
                                        ?> > Admin </option>
                                        <option value="2" <?php 
                                        if ($role == 2){ 
                                            echo "selected";
                                        }
                                        ?> > User </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="status">Account Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value=''>Select Account Status</option>
                                        <option value="1" <?php 
                                        if($userStatus == 1){
                                            echo "selected";
                                        }
                                        ?> > Active </option>
                                        <option value="0" <?php 
                                        if($userStatus == 0){
                                            echo "selected";
                                        }
                                        ?> > Inactive </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="image">Choose Image</label>
                                    <?php
                                        if (!empty($userImage)){
                                            ?>
                                                <img src="assets/user-image/<?php echo $userImage;?>" alt="" class="image-edit">
                                            <?php
                                        }else {
                                            ?>
                                                <img src="assets/user-image/defualt.png" alt="" class="image-edit">
                                            <?php
                                        }
                                ?>
                                    <input type="file" name="upImg" id="image" class="form-control">
                                </div>
                            </div>
                               
                            <input type="submit" value="Save Changes" class="form-control" name="btnUpdate">

                            </div>
                        </form>
                    </div>
                    </div>

                    <?php

                }
                
            }

        }

        else if( $do == 'update' ){

            if( isset($_POST['btnUpdate']) ){

                $updateUser         = $_POST['updateId'];
                $name               = mysqli_real_escape_string($db, $_POST['name']);
                $email              = mysqli_real_escape_string($db, $_POST['email']);
                $password           = mysqli_real_escape_string($db, $_POST['password']);
                $re_typePassword    = mysqli_real_escape_string($db, $_POST['reType']);
                $phone              = mysqli_real_escape_string($db, $_POST['phone']);
                $address            = mysqli_real_escape_string($db, $_POST['address']);
                $userRole           = mysqli_real_escape_string($db, $_POST['role']);
                $status             = mysqli_real_escape_string($db, $_POST['status']);
                $oldImg             = $_POST['oldImg'];
                $image              = $_FILES['upImg']['name'];
                $imageTmp           = $_FILES['upImg']['tmp_name'];
                $imgType            = $_FILES['upImg']['type'];


                // image & password
                if( !empty($password) && !empty($image) ){

                     // update image
                    if($imgType == "image/png" || $imgType == "image/jpeg"){
                        $img = rand(1, 99999) . "-" . $image;
                        move_uploaded_file($imageTmp, "assets/user-image/" . $img);
    
                        if( $password == $re_typePassword ){
    
                            $hassedPass = sha1($password);
                            if( $userRole == 1 ){
    
                                $updateSql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id = '$updateUser'";
                                $updateDb = mysqli_query($db, $updateSql);
    
                                if($updateDb){
                                    header("Location: user.php?do=manage");
                                    }else {
                                      die();
                                    }
    
                            }else {
                                $updateSql = "UPDATE users SET name='$name', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id = '$updateUser'";
                                $updateDb = mysqli_query($db, $updateSql);
    
                                if($updateDb){
                                    header("Location: user.php?do=manage");
                                    }else {
                                    die();
                                    }
                            }
    
                        }else {
                            echo "<h3>Password or Re-type Password doesn't match</h3>";
                        }
                    }else {
                        echo "<h3>Please choose Png or Jpg version</h3>";
                    }
                }

                // only password
                else if(!empty($password) && empty($image)){
    
                        if( $password == $re_typePassword ){
    
                            $hassedPass = sha1($password);
                            if( $userRole == 1 ){
    
                                $updateSql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status' WHERE id = '$updateUser'";
                                $updateDb = mysqli_query($db, $updateSql);
    
                                if($updateDb){
                                    header("Location: user.php?do=manage");
                                    }else {
                                      die();
                                    }
    
                            }else {
                                $updateSql = "UPDATE users SET name='$name', password='$hassedPass', phone='$phone', address='$address', role='$userRole', status='$status' WHERE id = '$updateUser'";
                                $updateDb = mysqli_query($db, $updateSql);
    
                                if($updateDb){
                                    header("Location: user.php?do=manage");
                                    }else {
                                    die();
                                    }
                            }
    
                        }else {
                            echo "<h3>Password or Re-type Password doesn't match</h3>";
                        }
                    
                }

                // only image
                if( empty($password) && !empty($image) ){

                    // update image
                   if($imgType == "image/png" || $imgType == "image/jpeg"){
                       $img = rand(1, 99999) . "-" . $image;
                       move_uploaded_file($imageTmp, "assets/user-image/" . $img);
   
                           if( $userRole == 1 ){
   
                               $updateSql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id = '$updateUser'";
                               $updateDb = mysqli_query($db, $updateSql);
   
                               if($updateDb){
                                   header("Location: user.php?do=manage");
                                   }else {
                                     die();
                                   }
   
                           }else {
                               $updateSql = "UPDATE users SET name='$name', phone='$phone', address='$address', role='$userRole', status='$status', image='$img' WHERE id = '$updateUser'";
                               $updateDb = mysqli_query($db, $updateSql);
   
                               if($updateDb){
                                   header("Location: user.php?do=manage");
                                   }else {
                                   die();
                                   }
                           }
   
                       
                   }else {
                       echo "<h3>Please choose Png or Jpg version</h3>";
                   }
               }
                else {

                    if( $userRole == 1 ){

                        $updateSql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', role='$userRole', status='$status' WHERE id = '$updateUser'";
                        $updateDb = mysqli_query($db, $updateSql);

                        if($updateDb){
                            header("Location: user.php?do=manage");
                            }else {
                            die();
                            }

                    }else {
                        $updateSql = "UPDATE users SET name='$name', phone='$phone', address='$address', role='$userRole', status='$status' WHERE id = '$updateUser'";
                        $updateDb = mysqli_query($db, $updateSql);

                        if($updateDb){
                            header("Location: user.php?do=manage");
                            }else {
                                die();
                            }
                    }

                }

            }

        }

        else if( $do == 'delete' ){

            if(isset($_GET['did'])){
                $del_user = $_GET['did'];

                $delSql = "DELETE  FROM users WHERE id = '$del_user'";
                $delDb  = mysqli_query($db, $delSql);

                if($delDb){
                    header("Location: user.php?do=manage");
                }

            }

        }

        else {
            echo "<div class='alert alert-warning'> 404 page not found !!! </div>";
        }
    
    ?>

</div>
</div>
<!--end page wrapper -->


</div>
<!--end wrapper-->

<?php
include "inc/footer.php";
?>