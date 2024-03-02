
<?php

    ob_start();
    session_start();
    session_unset();
    session_destroy();
    if( isset($_GET['lg']) ){
        $logOut = $_GET['lg'];
        header("Location: single.php?pId=$logOut");

    }else if( isset($_GET['lgc']) ){
        $ClogOut = $_GET['lgc'];
        header("Location: category.php?id=$ClogOut");
    }
    else {
        header("Location: index.php");
    }
    
    ob_end_flush();
        
?>

