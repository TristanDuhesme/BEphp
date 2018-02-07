<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="../html/connexion.html">Login</a>';