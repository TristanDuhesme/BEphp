<?php
session_start();
// Store Session Data
$_SESSION['login_user']= $username;  // Initializing Session with value of PHP Variable
echo $_SESSION['login_user'];
