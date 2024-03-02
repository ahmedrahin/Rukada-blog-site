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
                        <h5 style="padding: 15px 0 10px;">Manage All Category</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Parent / Sub Category</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $category        = "SELECT id as 'ctId', name as 'ctName', description as 'ctDec', is_parent as 'parentCat', status as 'ctStatus' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
                                    $categoryDb      = mysqli_query($db, $category);
                                    $total_row       = mysqli_num_rows($categoryDb);
                                    $sl              = 0;

                                    if( $total_row != 0 ){

                                        while( $ctRow = mysqli_fetch_assoc($categoryDb) ){

                                           extract($ctRow);
                                         
                                            $sl +=1;

                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td class="title"><?php echo $ctName; ?></td>
                                                    <td><?php 
                                                    if(!empty($ctDec)){
                                                        echo substr($ctDec, 0, 62) . $dot = ( strlen($ctDec) >= 62 ) ?  ".." : ''; echo $dot; 
                                                    }else {
                                                        echo "<span class='empty'>empty description</span>";
                                                    }
                                                    ?></td>
                                                    <td align="center">
                                                        <?php
                                                            if( $parentCat == 0 ){
                                                                echo '<div class="btn btn-info"> Parent Category </div>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                        <li>
                                                            <a href="category.php?do=edit&id=<?php echo $ctId; ?>">
                                                            <i class="bx bx-pencil"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="category.php?do=delete" type="button" data-bs-toggle="modal" data-bs-target="#delCt<?php echo $ctId; ?>" >
                                                            <i class="bx bx-trash"></i>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delCt<?php echo $ctId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-danger">
                                                        <a href="category.php?do=delete&did=<?php echo $ctId; ?>">Confirm</a>
                                                    </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php

                                            // sub category
                                            $subcatSql = "SELECT * FROM category WHERE is_parent = '$ctId' AND status = 1 ORDER BY name ASC ";
                                            $subcatDb  = mysqli_query($db, $subcatSql);

                                            while( $subCat      = mysqli_fetch_assoc($subcatDb) ){
                                                $subcatId       = $subCat['id'];
                                                $subcatName     = $subCat['name'];
                                                $subcatDes      = $subCat['description'];
                                                $parentCat      = $subCat['is_parent'];
                                                $subcatStatus   = $subCat['status'];
                                                $sl++;

                                                ?>
                                                    <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td class="title"><?php echo "&nbsp;&nbsp;&nbsp;<i class='lni lni-arrow-right' style='color: #11cdef;'></i>&nbsp; " . $subcatName; ?></td>
                                                    <td><?php 
                                                        if(!empty($subcatDes)){
                                                            echo substr($subcatDes, 0, 70) . $dot2 = ( strlen($subcatDes) >= 70 ) ?  "..." : ''; echo $dot2; 
                                                        }else {
                                                            echo "<span class='empty'>empty description</span>";
                                                        }
                                                    ?></td>
                                                    <td align="center">
                                                        <?php
                                                            if( $parentCat > 0 ){
                                                                echo '<div class="btn btn-outline-primary"> Child Category </div>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                        <li>
                                                            <a href="category.php?do=edit&id=<?php echo $subcatId; ?>">
                                                            <i class="bx bx-pencil"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="" type="button" data-bs-toggle="modal" data-bs-target="#delCt<?php echo $subcatId; ?>" >
                                                            <i class="bx bx-trash"></i>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delCt<?php echo $subcatId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-danger">
                                                        <a href="category.php?do=delete&subdid=<?php echo $subcatId; ?>">Confirm</a>
                                                    </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>
                                                <?php

                                            }

                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No Category Found </div>";
                                    }
                                
                                ?>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <a href="category.php?do=trash" class="trash">
                    View Trash  <i class="bx bx-right-arrow-alt"></i>
                </a>

            <?php

        } 

        else if( $do == 'add' ){

            ?>

            <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title"> Add New Category</h3>
            </div>
            
            <div class="card-body" style="display: block;">
                <form action="category.php?do=store" method="POST">
                    <div class="row g-lg-5">

                    <div class="col-lg-5">

                        <div class="form-group mb-4">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" placeholder="Write Category Name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="pc">Select The Parent Category [If Any]</label>
                            <select name="parentCat" id="pc" class="form-control">
                                <option> Select The Parent Category </option>

                                <?php

                                    $parentCtSql = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
                                    $sendDb      = mysqli_query($db, $parentCtSql);

                                    while( $parentCt = mysqli_fetch_assoc($sendDb) ){
                                        $pcId   = $parentCt['id'];
                                        $pcName = $parentCt['name'];

                                        ?>
                                            <option value="<?php echo $pcId; ?>">
                                                <?php echo $pcName; ?>
                                            </option>
                                        <?php

                                    }


                                ?>
                            </select>
                        </div>

                        <input type="submit" value="Submit" name="btnSubmit" class="form-control" style="width: 45%;">

                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" placeholder="Write Your Message..." class="form-control" maxlength="100"></textarea>
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
                
                $ctName     = mysqli_real_escape_string($db, $_POST['name']);
                $parentCat  = $_POST['parentCat'];
                $dec        = mysqli_real_escape_string($db, $_POST['description']);

                $catSql     = "INSERT INTO category (name, description, is_parent) VALUES ('$ctName', '$dec', '$parentCat') ";
                $addCat     = mysqli_query($db, $catSql);

                if($addCat){
                    header("Location: category.php?do=manage");
                } else {
                    die();
                }
                
            }

        }

        else if( $do == 'edit' ){

            if( isset($_GET['id']) ){
                $catId = $_GET['id'];
                $editSql = "SELECT name as 'ctName', description as 'catDes', is_parent as 'parentsubCat' FROM category WHERE id = '$catId'";
                $editDb  = mysqli_query($db, $editSql);

                while($ctRow = mysqli_fetch_array($editDb)){

                   extract($ctRow);

                ?>

                    <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title"> Change Category Information </h3>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <form action="category.php?do=update" method="POST" enctype="multipart/form-data" class="addUser">

                        <input type="hidden" name="updateId" value="<?php echo $catId; ?>">
                            <div class="row g-lg-5">

                            <div class="col-lg-5">

                                <div class="form-group mb-4">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" id="name" placeholder="Write Your Name" class="form-control" value="<?php echo $ctName; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="pc">Select The Parent Category [If Any]</label>
                                    <select name="parentCat" id="pc" class="form-control">
                                        <option> Select The Parent Category </option>

                                        <?php

                                            $parentCtSql = "SELECT * FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC";
                                            $sendDb      = mysqli_query($db, $parentCtSql);

                                            while( $parentCt = mysqli_fetch_assoc($sendDb) ){
                                                $pcId   = $parentCt['id'];
                                                $pcName = $parentCt['name'];

                                                ?>
                                                    <option value="<?php echo $pcId; ?>" <?php if($pcId == $parentsubCat){echo "selected";} ?> >
                                                        <?php echo $pcName; ?>
                                                    </option>
                                                <?php

                                            }


                                        ?>
                                    </select>
                                </div>

                                <input type="submit" value="Save Changes" class="form-control" name="btnUpdate" style="width: 45%;">

                                </div>

                                <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" placeholder="Write Your Message..." class="form-control" maxlength="100">
                                        <?php echo trim($catDes, " "); ?>
                                    </textarea>
                                </div>
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

                $updateCat          = $_POST['updateId'];
                $name               = mysqli_real_escape_string($db, $_POST['name']);
                $catDes             = mysqli_real_escape_string($db, $_POST['description']);
                $parentsubCat       = $_POST['parentCat'];

                $upSql  = "UPDATE category SET name = '$name', description = '$catDes', is_parent = '$parentsubCat' WHERE id = '$updateCat'";
                $upCat  = mysqli_query($db, $upSql);

                if($upCat){
                    header("Location: category.php?do=manage");
                } else {
                    die();
                }

            }

        }

        else if( $do == 'delete' ){

            if($_GET['did']){
                $delCat = $_GET['did'];
                
                $delSql = "UPDATE category SET status = 0 WHERE id = '$delCat' ";
                $delDb  = mysqli_query($db, $delSql);

                if($delDb){
                    header("Location: category.php?do=manage");
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
                        <h5 style="padding: 15px 0 10px;">Manage Trash Category</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Parent / Sub Category</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $category        = "SELECT id as 'ctId', name as 'ctName', description as 'ctDec', is_parent as 'parentCat', status as 'ctStatus' FROM category WHERE status = 0 ORDER BY name ASC";
                                    $categoryDb      = mysqli_query($db, $category);
                                    $total_row       = mysqli_num_rows($categoryDb);
                                    $sl              = 0;

                                    if( $total_row != 0 ){

                                        while( $ctRow = mysqli_fetch_assoc($categoryDb) ){

                                           extract($ctRow);
                                         
                                            $sl +=1;

                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td class="title"><?php echo $ctName; ?></td>
                                                    <td><?php 
                                                    if(!empty($ctDec)){
                                                        echo substr($ctDec, 0, 70) . $dot = ( strlen($ctDec) >= 70 ) ?  ".." : ''; echo $dot; 
                                                    }else {
                                                        echo "<span class='empty'>empty description</span>";
                                                    }
                                                    ?></td>
                                                    <td align="center">
                                                        <?php
                                                            if( $parentCat == 0 ){
                                                                echo '<div class="btn btn-info"> Parent Category </div>';
                                                            }else{
                                                                echo '<div class="btn btn-outline-primary"> Child Category </div>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <ul class="actionBtn">
                                                            <li style="display:block">
                                                                <a href="category.php?do=trash&rid=<?php echo $ctId; ?>" class="btn btn-info restore">
                                                                    Restore
                                                                </a>
                                                                </li>
                                                                <li style="display:block">
                                                                <a href="category.php?do=trash&pid=<?php echo $ctId; ?>" class="btn btn-info permanent">
                                                                    Permanent Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>


                                                <?php
                                                
                                                if( isset($_GET['rid']) ){
                                                    $restoreId = $_GET['rid'];
                  
                                                    $restoreSql    = "UPDATE category set status = 1 WHERE id = '$restoreId'";
                                                    $restoreCat    = mysqli_query($db,$restoreSql);
                  
                                                    if($restoreCat){
                                                      header("Location: category.php?do=manage");
                                                    }else {
                                                      die();
                                                    }
                  
                                                  }

                                                  if(isset($_GET['pid'])){
                                                    $permantId = $_GET['pid'];

                                                    $permantSql    = "DELETE FROM category WHERE id = '$permantId'";
                                                    $permantCat    = mysqli_query($db,$permantSql);
                  
                                                    if($permantCat){
                                                      header("Location: category.php?do=trash");
                                                    }else {
                                                      die();
                                                    }
                                                  }
                          
                                                
                                                ?>

                                            <?php                       

                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No Category Found </div>";
                                    }
                                
                                ?>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <a href="category.php?do=manage" class="trash">
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