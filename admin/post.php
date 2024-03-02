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
                        <h5 style="padding: 15px 0 10px;">Manage All Post</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Thumbnails</th>
                                        <th>Post Title</th>
                                        <th>Category Name</th>
                                        <th>Author</th>
                                        <th>Post Date</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $post        = "SELECT id as 'pId', title as 'title', description as 'pDec', image as 'thumb', category_id as 'cId', author_id as 'authId', post_date as 'date', status as 'pStatus' FROM post WHERE status = 1 ORDER BY id DESC";

                                    $postDb      = mysqli_query($db, $post);
                                    $total_row       = mysqli_num_rows($postDb);
                                    $sl              = 0;

                                    if( $total_row != 0 ){

                                        while( $postRow = mysqli_fetch_assoc($postDb) ){

                                           extract($postRow);
                                         
                                            $sl +=1;

                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td>
                                                        <img src="assets/post-image/<?php echo $thumb;?>" alt="" class="image">
                                                    </td>
                                                    <td class="title"><?php echo $title; ?></td>
                                                    <td class="title"><?php 
                                                        $category = "SELECT * FROM category WHERE id = '$cId'";
                                                        $catDb    = mysqli_query($db, $category);

                                                        while( $catRow = mysqli_fetch_assoc($catDb) ){
                                                            $catName = $catRow['name'];
                                                            echo $catName;
                                                        }
                                                    ?></td>
                                                    <td class="title"><?php 
                                                        $author = "SELECT * FROM users WHERE id = '$authId' ";
                                                        $authordb = mysqli_query($db, $author);

                                                        while( $row = mysqli_fetch_assoc($authordb) ){
                                                            $authName = $row['name'];
                                                            echo $authName;
                                                        }
                                                    ?></td>
                                                    <td class="title"><?php echo $date; ?></td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                        <li>
                                                            <a href="post.php?do=edit&id=<?php echo $pId; ?>">
                                                            <i class="bx bx-pencil"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="post.php?do=delete" type="button" data-bs-toggle="modal" data-bs-target="#delP<?php echo $pId; ?>" >
                                                            <i class="bx bx-trash"></i>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delP<?php echo $pId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-danger">
                                                        <a href="post.php?do=delete&did=<?php echo $pId; ?>">Confirm</a>
                                                    </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php

                                    
                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No Post Found </div>";
                                    }
                                
                                ?>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <a href="post.php?do=trash" class="trash">
                    View Trash  <i class="bx bx-right-arrow-alt"></i>
                </a>

            <?php

        } 

        else if( $do == 'add' ){

            ?>

            <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Add New Post</h3>
            </div>
            
            <div class="card-body" style="display: block;">
                <form action="post.php?do=store" method="POST" enctype="multipart/form-data">
                    <div class="row g-lg-5">

                    <div class="col-lg-5">

                        <div class="form-group mb-4">
                            <label for="name">Post Title</label>
                            <input type="text" name="title" id="name" placeholder="Write post title" class="form-control" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="pc">Select The Category</label>
                            <select name="category" id="pc" class="form-control" required>
                                <option value=''> Select The Category </option>
                                <?php
                                
                                $category =  "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
                                $cDb      = mysqli_query($db, $category);

                                while($cRow = mysqli_fetch_assoc($cDb)){
                                    $cid   = $cRow ['id'];
                                    $cName = $cRow ['name'];
                                    ?>
                                        <option value=" <?php echo $cid; ?>">
                                            <?php echo $cName;?>
                                        </option>
                                    <?php
                                    
                                    $subCategory   =  "SELECT * FROM category WHERE is_parent = '$cid' AND status = 1 ORDER BY name ASC";
                                    $subcDb           = mysqli_query($db, $subCategory);

                                    while($subcRow = mysqli_fetch_assoc($subcDb)){
                                        $subcid    = $subcRow ['id'];
                                        $subName   = $subcRow ['name'];
                                        ?>
                                            <option value=" <?php echo $subcid; ?>">
                                                <?php echo "&nbsp;&nbsp; -- " . $subName;?>
                                            </option>
                                        <?php
                                    }

                                }
                                
                                ?>
                                
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="name">Meta Tags [use (,) for each tag]</label>
                            <input type="text" name="tag" id="name" placeholder="meta tag" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Choose Thumbnails</label>
                            <input type="file" name="thumbnails" id="image" class="form-control" required>
                        </div>

                        <input type="submit" value="Publish" name="btnSubmit" class="form-control" style="width: 45%;">

                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" placeholder="Write Your Message..." class="form-control" required></textarea>
                        </div>
                    </div>
                        
                    </div>
                </form>
            </div>
            </div>

            <?php

        }

        else if( $do == 'store' ){

            if( isset($_POST['btnSubmit']) ){
                
                $title      = mysqli_real_escape_string($db, $_POST['title']);
                $category   = $_POST['category'];
                $author     = $_SESSION['id'];
                $metaTag    = mysqli_real_escape_string($db, $_POST['tag']);
                $dec        = mysqli_real_escape_string($db, $_POST['description']);
                $image      = $_FILES['thumbnails']['name'];
                $imageTmp   = $_FILES['thumbnails']['tmp_name'];
                $imgType    = $_FILES['thumbnails']['type'];
                $month      = date('M');
                $day        = date('d');
                $year       = date('Y');

                // thumbnails image
               if( $imgType == "image/png" || $imgType == "image/jpeg" ){
                    $img = rand(0, 99999) . "-" . $image;
                    move_uploaded_file($imageTmp, "assets/post-image/" . $img);

                    $postSql     = "INSERT INTO post (title, description, image, category_id, author_id, meta_tag, post_date, post_month, post_day, post_year) VALUES ('$title', '$dec', '$img', '$category', '$author', '$metaTag', now(), '$month', '$day', '$year') ";

                    $addPost     = mysqli_query($db, $postSql);
                    if($addPost){
                        header("Location: post.php?do=manage");
                    } else {
                        die();
                    }

               }else {
                    echo "<h3>Please choose Png or Jpg version</h3>";
               }
                
            }

        }

        else if( $do == 'edit' ){

            if( isset($_GET['id']) ){
                $postId = $_GET['id'];
                $editSql = "SELECT id as 'pId', title as 'title', description as 'pDec', image as 'thumb', category_id as 'cId', author_id as 'authId', meta_tag as 'tags', post_date as 'date', status as 'pStatus' FROM post WHERE id = '$postId' ";
                $editDb  = mysqli_query($db, $editSql);

                while($ctRow = mysqli_fetch_array($editDb)){

                   extract($ctRow);

                ?>

                    <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title"> Change Post Information </h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                <form action="post.php?do=update" method="POST" enctype="multipart/form-data">
                    <div class="row g-lg-5">

                    <div class="col-lg-5">
                        <input type="hidden" name="upPost" value="<?php echo $pId; ?>">
                        <div class="form-group mb-4">
                            <label for="name">Post Title</label>
                            <input type="text" name="upTitle" id="name" placeholder="Write post title" class="form-control" value="<?php echo $title; ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="pc">Select The Category</label>
                            <select name="category" id="pc" class="form-control" required>
                                <option value=''> Select The Category </option>
                                <?php
                                
                                $category =  "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
                                $cDb      = mysqli_query($db, $category);

                                while($cRow = mysqli_fetch_assoc($cDb)){
                                    $cid   = $cRow ['id'];
                                    $cName = $cRow ['name'];
                                    ?>
                                        <option value=" <?php echo $cid; ?>" <?php if($cid == $cId){ echo "selected"; } ?> >
                                            <?php echo $cName;?>
                                        </option>
                                    <?php
                                    
                                    $subCategory   =  "SELECT * FROM category WHERE is_parent = '$cid' AND status = 1 ORDER BY name ASC";
                                    $subcDb           = mysqli_query($db, $subCategory);

                                    while($subcRow = mysqli_fetch_assoc($subcDb)){
                                        $subcid    = $subcRow ['id'];
                                        $subName   = $subcRow ['name'];
                                        ?>
                                            <option value=" <?php echo $subcid; ?>" <?php if($subcid == $cId){ echo "selected"; } ?>>
                                                <?php echo "&nbsp;&nbsp; -- " . $subName;?>
                                            </option>
                                        <?php
                                    }

                                }
                                
                                ?>
                                
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="name">Meta Tags [use (,) for each tag]</label>
                            <input type="text" name="tag" id="name" placeholder="meta tag" value="<?php echo $tags; ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Choose Thumbnails</label>
                                <img src="assets/post-image/<?php echo $thumb; ?>" alt="" class="image-edit">
                            <input type="file" name="thumbnails" id="image" class="form-control">
                        </div>

                        <input type="submit" value="Save Changes" name="btnUpdate" class="form-control" style="width: 45%;">

                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" placeholder="Write Your Message..." class="form-control"  required>
                                <?php echo $pDec; ?>
                            </textarea>
                        </div>
                    </div>
                        
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

                $upId        = $_POST['upPost'];
                $title       = mysqli_real_escape_string($db, $_POST['upTitle']);
                $description = mysqli_real_escape_string($db, $_POST['description']);
                $category    = mysqli_real_escape_string($db, $_POST['category']);
                $tag         = mysqli_real_escape_string($db, $_POST['tag']);
                $image       = $_FILES['thumbnails']['name'];
                $imageTmp    = $_FILES['thumbnails']['tmp_name'];
                $imgType     = $_FILES['thumbnails']['type'];

               


                if(!empty($image)){
                    if( $imgType == "image/png" || $imgType == "image/jpeg" ){
                        $img = rand(0, 99999) . "-" . $image;
                        move_uploaded_file($imageTmp, "assets/post-image/" . $img);
        
                        $upPost_sql = "UPDATE post SET title='$title', description='$description', category_id='$category', meta_tag='$tag', image='$img' WHERE id = '$upId'";
                        $upDb       = mysqli_query($db, $upPost_sql);
                        
                        if($upDb){
                            header("Location: post.php?do=manage");
                        }
        
                   }else {
                        echo "<h3>Please choose Png or Jpg version</h3>";
                   }

                }else {
                    $upPost_sql = "UPDATE post SET title='$title', description='$description', category_id='$category', meta_tag='$tag' WHERE id = '$upId'";
                    $upDb       = mysqli_query($db, $upPost_sql);
                    
                    if($upDb){
                        header("Location: post.php?do=manage");
                    }
                }
            
            }

        }

        else if( $do == 'delete' ){

            if($_GET['did']){
                $delPost = $_GET['did'];
                
                $delSql = "UPDATE post SET status = 0 WHERE id = '$delPost' ";
                $delDb  = mysqli_query($db, $delSql);

                if($delDb){
                    header("Location: post.php?do=manage");
                }
                
            } else if ($_GET['subdid']){
                $subdelCat = $_GET['subdid'];
                
                $subdelSql = "UPDATE category SET status = 0 WHERE id = '$subdelCat' ";
                $subdelDb  = mysqli_query($db, $subdelSql);

                if($subdelDb){
                    header("Location: category.php?do=manage");
                }
            }

        }

        else if( $do == 'trash' ){

            ?>

                <div class="card">
                    <div class="card-body">
                        <h5 style="padding: 15px 0 10px;">Manage trash Post</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Thumbnails</th>
                                        <th>Post Title</th>
                                        <th>Category Name</th>
                                        <th>Author</th>
                                        <th>Post Date</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $post        = "SELECT id as 'pId', title as 'title', description as 'pDec', image as 'thumb', category_id as 'cId', author_id as 'authId', post_date as 'date', status as 'pStatus' FROM post WHERE status = 0 ORDER BY id DESC";

                                    $postDb          = mysqli_query($db, $post);
                                    $total_row       = mysqli_num_rows($postDb);
                                    $sl              = 0;

                                    if( $total_row != 0 ){

                                        while( $postRow = mysqli_fetch_assoc($postDb) ){

                                           extract($postRow);
                                         
                                            $sl +=1;

                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td>
                                                        <img src="assets/post-image/<?php echo $thumb;?>" alt="" class="image">
                                                    </td>
                                                    <td class="title"><?php echo $title; ?></td>
                                                    <td class="title"><?php 
                                                        $category = "SELECT * FROM category WHERE id = '$cId'";
                                                        $catDb    = mysqli_query($db, $category);

                                                        while( $catRow = mysqli_fetch_assoc($catDb) ){
                                                            $catName = $catRow['name'];
                                                            echo $catName;
                                                        }
                                                    ?></td>
                                                    <td class="title"><?php 
                                                        $author = "SELECT * FROM users WHERE id = '$authId' ";
                                                        $authordb = mysqli_query($db, $author);

                                                        while( $row = mysqli_fetch_assoc($authordb) ){
                                                            $authName = $row['name'];
                                                            echo $authName;
                                                        }
                                                    ?></td>
                                                    <td class="title"><?php echo $date; ?></td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                            <li style="display:block">
                                                                <a href="post.php?do=trash&rid=<?php echo $pId; ?>" class="btn btn-info restore">
                                                                    Restore
                                                                </a>
                                                                </li>

                                                                <li style="display:block">
                                                                <a href="post.php?do=trash&pid=<?php echo $pId; ?>" class="btn btn-info permanent">
                                                                    Permanent Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                                <?php
                                                
                                                if( isset($_GET['rid']) ){
                                                    $restoreId = $_GET['rid'];
                  
                                                    $restoreSql    = "UPDATE post set status = 1 WHERE id = '$restoreId'";
                                                    $restorePost   = mysqli_query($db,$restoreSql);
                  
                                                    if($restorePost){
                                                      header("Location: post.php?do=manage");
                                                    }else {
                                                      die();
                                                    }
                  
                                                  }

                                                  if(isset($_GET['pid'])){
                                                    $permantId = $_GET['pid'];

                                                    $permantSql    = "DELETE FROM post WHERE id = '$permantId'";
                                                    $permantPost   = mysqli_query($db,$permantSql);
                  
                                                    if($permantPost){
                                                      header("Location: post.php?do=trash");
                                                    }else {
                                                      die();
                                                    }
                                                  }
                          
                                                
                                                ?>
                                                

                                            <?php

                                    
                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No Post Found </div>";
                                    }
                                
                                ?>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <a href="post.php?do=manage" class="trash">
                   Go Back  <i class="bx bx-right-arrow-alt"></i>
                </a>

            <?php

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