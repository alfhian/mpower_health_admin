<?php
    $target = $_SERVER['DOCUMENT_ROOT']."/../laravel/storage/app/publicsymlink.php";
    $link = $_SERVER['DOCUMENT_ROOT']."/storage";
    if(symlink( $target, $link )){
        echo "OK.";
    } else {
        echo "Gagal.";
    }
?>