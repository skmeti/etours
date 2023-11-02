<?php
$connection=mysqli_connect("localhost", "root", "Dca1xifkJd", "etours_test");
				if (mysqli_connect_errno())
				  {
				  echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
$connection->set_charset("utf8");

?>