<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>ASSIGNMENT 14</title>
	</head>
	<body>
		<h1 id="title">ASSIGNMENT 14 FORM COMMENTS</h1>
		<div class="comments">
		<h2>MySQL Database Message:</h2>
		<!--CONNECTING TO MYSQL AND THE DATABASE-->
		<?php
			// Create connection to mysql
			$host = "localhost";
			$user = "user1";
			$pwd = "ics415";
			$db = "comment_db";
			$con=mysqli_connect($host,$user,$pwd);
			if (mysqli_connect_errno($con))
			{
			  echo "<p class='message' style='color:red'> Failed to connect to MySQL: " . mysqli_connect_error()."</p>";
			}
			else {
				echo "<p class='message' style='color:red'> Connected To Mysql:  " .$user. "</p>";
						//Check IF database exist, Create Database and tables.
				if (!mysqli_select_db($con,$db)) {
					echo "<p class='message' style='color:red'>No Database Found...... Creating Database!</p>";
					mysqli_query($con,'CREATE DATABASE '.$db);
					$dbcon = mysqli_select_db($con,$db);
					//CREATE THE TABLE
					$table = "CREATE TABLE Comments
					(PID INT NOT NULL AUTO_INCREMENT,
					 PRIMARY KEY(PID),
					 Comments text
						)";
					mysqli_query($con,$table);

					echo "<p class='message' style='color:red'> Database: ". $db ." and Table: Comments ". "created.</p>";
				}
				//ELSE CONNECT TO THE DATABASE
				else {
					mysqli_select_db($con,$db);
					echo "<p class='message' style='color:red'>Connected To Database: ".$db." </p>";
				}
			}

	
		?>
		</div>

		<div class="comments">
		<h2>Comments:</h2>
		<!--Getting the comments and print them to the screen and store them to the selected database. -->
		<?php
			//Print the comments from the selected database
			$comment = mysqli_query($con,"SELECT * FROM Comments");

			while($row = mysqli_fetch_array($comment))
			{
			  echo "<p>".$row['Comments'] . "</p>";
			}


			//GETTING THE COMMENT DATA
			$comment = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$comment = $_POST["comment"];
			}

			//Print and write comments to file, Creats new file if file doesn't exist.
			//if comment is whitespace don't print or write.
			if (trim($comment) != "") {
				echo "<p>".$comment."</p>";
				mysqli_query($con,"INSERT INTO Comments (Comments) 
							VALUES ('$comment')");
			}
			
			mysqli_close($con);
			
			
		?>
		</div>
		<div class="comments">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
			<h3>Enter Comments Here:</h3> 
			<textarea name="comment" rows="5" cols="40"></textarea><br /> 
			<input type="submit" value="Comment"> 
		</form> 
		</div>
	</body>
</html>
