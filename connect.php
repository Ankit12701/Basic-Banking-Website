<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'Ankit', 'Spark@_111', 'Sparkle');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>