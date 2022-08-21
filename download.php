<?php
$conn = mysqli_connect("localhost", "root", "", "bca_5");
if (!$conn) {
	echo "Not connection establish";
}
if (isset($_POST['uploadfile'])) {
	$name = $_POST['txtname'];
	$file_name = $_FILES['selectfile']['name'];
	$file_temp_name = $_FILES['selectfile']['tmp_name'];
	$save_file_path = "files/" . $file_name;
	$temp_exte = explode('.', $file_name);
	$file_extention = end($temp_exte);
	$extentionarray = array("jpeg", "jpg", "png");

	$file_iquery = "INSERT INTO download_file VALUES(NULL,'$save_file_path','$name')";
	//echo $file_iquery;
	if (in_array($file_extention, $extentionarray) === true) {
		if (mysqli_query($conn, $file_iquery)) {

			if (move_uploaded_file($file_temp_name, $save_file_path)) {
				session_start();
				$_SESSION["filepath"] = $save_file_path;
				header("Location:index.php");
				$_SESSION["name"] = $name;
				if (isset($_SESSION['error'])) {
					unset($_SESSION['error']);
				}
			}
		}
	} else {
		session_start();
		$_SESSION["error"] = 1;
		header("Location:index.php");
	}
}
