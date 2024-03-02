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
                        <h5 style="padding: 15px 0 10px;">Manage All Comment</h5>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Comment</th>
                                        <th>Post Name</th>
                                        <th>User Name</th>
                                        <th>Comment Date</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                    $cmt        = "SELECT id as 'cId', comments as 'comment', post_id as 'postId', user_id as 'userId', date as 'date' FROM comment ORDER BY id DESC";

                                    $cmtDb            = mysqli_query($db, $cmt);
                                    $total_row       = mysqli_num_rows($cmtDb);
                                    $sl              = 0;

                                    if( $total_row != 0 ){

                                        while( $cmtRow = mysqli_fetch_assoc($cmtDb) ){

                                           extract($cmtRow);
                                         
                                            $sl +=1;

                                            ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td class="cmt"><?php 
                                                        echo substr($comment, 0, 70) . $dot = ( strlen($comment) >= 70 ) ?  ".." : ''; echo $dot; 
                                                    ?></td>
                                                    <td class="title"><?php 
                                                        $post_id  = "SELECT * FROM post WHERE id = '$postId'";
                                                        $pDb      = mysqli_query($db, $post_id);

                                                        while( $pRow = mysqli_fetch_assoc($pDb) ){
                                                            $pName = $pRow['title'];
                                                            echo $pName;
                                                        }
                                                    ?></td>

                                                    <td class="title"><?php 
                                                        $author   = "SELECT * FROM users WHERE id = '$userId' ";
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
                                                            <a href="comment.php?do=delete" type="button" data-bs-toggle="modal" data-bs-target="#delC<?php echo $cId; ?>" >
                                                            <i class="bx bx-trash"></i>
                                                            </a>
                                                        </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="delC<?php echo $cId; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-danger">
                                                        <a href="comment.php?do=delete&did=<?php echo $cId; ?>">Confirm</a>
                                                    </button>
                                                    </div>
                                                    </div>
                                                    </div>
                                                </div>

                                            <?php
                                   
                                        }

                                    } else {
                                        echo "<div class='alert alert-warning'> No Comment Found </div>";
                                    }
                                
                                ?>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

            <?php

        } 

        else if( $do == 'delete' ){

            if($_GET['did']){
                $delCmt = $_GET['did'];
                $delSql = "DELETE FROM comment WHERE id = '$delCmt'";
                $delDb  = mysqli_query($db, $delSql);

                if($delDb){
                    header("Location: comment.php?do=manage");
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