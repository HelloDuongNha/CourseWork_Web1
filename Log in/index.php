<?php  
session_start()
?>
<h1>welcome back <?=$_SESSION['username']?></h1>
<a href="logout.php">logout</a>