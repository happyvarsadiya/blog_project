<?php 

		session_start();

		// session_unset('userid');

		session_destroy();
		header("location:index.php");

	 ?>