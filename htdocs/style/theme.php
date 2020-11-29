<?php
    session_start();
    if($_POST['theme'] == 0) {
        unset($_SESSION['theme']);
    } else{
        $_SESSION['theme']=1;
    }
?>