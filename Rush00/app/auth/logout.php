<?php
    $_SESSION['logged_on_user'] = "";
    session_destroy();
    header("Location: index.php");