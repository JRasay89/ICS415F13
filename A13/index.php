<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/myScript.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>ASSIGNMENT 13</title>
	</head>
	<body>
		<h1 id="title">ASSIGNMENT 13 FORM COMMENTS</h1>
		<h2>Your Comments:</h2>
		<?php
			//OPEN FILE AND READ IT, AND PRINT IT TO THE PAGE IF FILE EXIST
			$file = "formdata.txt";
			if (file_exists($file)) {
				$fh = fopen($file, "r");
				while(!feof($fh)) {
					echo fgets($fh);
				}
				fclose($fh);
			}

			//GETTING THE COMMENT DATA
			$comment = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$comment = $_POST["comment"];
			}

			//Print and write comments to file, Creats new file if file doesn't exist.
			//if comment is whitespace don't print or write.
			if (trim($comment) != "") {
				echo "<p>".date("m/d/Y, g : h : s").": ".$comment."</p>";
				$fp = fopen("formdata.txt","a");
				$savestring ="<p>".date("m/d/Y, G : H : s").": ".$comment."</p>";
				fwrite($fp,$savestring.PHP_EOL);
				fclose($fp);
			}
			
			
			
		?>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
		<h3>Enter Comments Here:</h3> 
		<textarea name="comment" rows="5" cols="40"></textarea><br /> 
		<input type="submit" value="Comment"> 
		</form> 

	</body>
</html>
