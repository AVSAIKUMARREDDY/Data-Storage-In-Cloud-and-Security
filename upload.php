
<!DOCTYPE html>
<html>
	<head>
		<title>upload_directory_page</title>
	</head>
	<body>
		   <form method="post" enctype="multipart/form-data">
			<label for="myfile">please select the items below by clicking browse files button</label>
			<p><input name="upload[]" type="file" multiple="multiple" /></p>
			<p><input type="submit" name="submit" value="upload"></input></p>
		   </form>
		<a href="table-fina.php">click_here_to_go_to_tabular page</a>
		
		 <form method="post">
			<p><input type="submit" name="lambda" value="format_it"></input></p>
		</form>

	<?php
			session_start();
                         $_SESSION['activity']= $_SESSION['activity']." action :upload,";
			if(isset($_POST['submit']))
				{
                                 
					include "s3-check.php";
				}
                       if(isset($_POST['lambda']))
                                {
                                 
                                        include "sns-check.php";
                                }
			



		?>


  
	</body>
</html>

