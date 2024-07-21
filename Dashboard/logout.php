<?php
session_start();
session_destroy();
header('Location: ../Voter login Form/login.html');
exit();
?>
