
<!DOCTYPE html>
<html>
	<head>
		<title>upload_directory_page</title>
	</head>
	<body>
		<form method="post">
  			<label for="myfile">please type the location of ur file in the text box</label>
			<input type="text" id="myfile" name="myfile">
  			<input type="submit" name="submit">
		</form>
	       <a href="table-fina.php">click_here_to_go_to_tabular page</a>
		<?php
			session_start();
                         $_SESSION['activity']= $_SESSION['activity']." action :upload,";
			if(isset($_POST['submit']))
				{
                                 
        			include "s3-check.php";

        			echo "finished uplading to s3 <br/>";

        			include "sns-check.php";
				}

		?>


  
	</body>
</html>

