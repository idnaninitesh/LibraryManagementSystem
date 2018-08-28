<?php
require 'core.inc.php';

unset($_SESSION['user_name']);
header('Location: index.php');
?>