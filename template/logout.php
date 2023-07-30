<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['username'])
{
    session_unset();
}    
header("Location:../index.html");

?>