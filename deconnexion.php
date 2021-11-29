<?php
session_start();
$_SESSION = array();

header("location: index.php");
session_destroy();