<!DOCTYPE html>
<?php
	if (isset($_POST['user'])) {
		setcookie("user", $_POST['user']);
		header("Location: index.php"); //REFRESH PAGE BY REDIRECTING TO ITSELF
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>ASSIGNMENT 15</title>
	</head>
	<body>
		<h1 id="title">ASSIGNMENT 15 FORM COMMENTS</h1>
		<div class="comments">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
				USER:<input type="text" name="user">
				<input type="submit" value="Submit"> 
			</form>
		</div>
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
					$comment_table = "CREATE TABLE Comments
					( userID   INT,
					  Comments text
					 )";
					$user_table = "CREATE TABLE Users
						( userID INT NOT NULL AUTO_INCREMENT,
					 	  PRIMARY KEY(userID),
						  NAME char(50) NOT NULL UNIQUE
						)";
					mysqli_query($con,$comment_table);
					mysqli_query($con,$user_table);

					echo "<p class='message' style='color:red'> Database: ". $db ." and Table: Comments ". "created.</p>";
				}
				//ELSE CONNECT TO THE DATABASE
				else {
					mysqli_select_db($con,$db);
					echo "<p class='message' style='color:red'>Connected To Database: ".$db." </p>";
				}
			}

			if (!empty($_POST['user'])) {
				$name = $_POST['user'];
				mysqli_query($con,"INSERT INTO Users (name)
									SELECT * FROM (SELECT '$name') AS tmp
									WHERE NOT EXISTS (
									    SELECT name FROM Users WHERE name = '$name'
									) LIMIT 1");
			}
			
	
		?>
		</div>

		<div class="comments">
		<h2>Comments:</h2>
		<!--Getting the comments and print them to the screen and store them to the selected database. -->
		<?php
			//PRINTING WELCOME MESSAGE AND GET USERID
			
			if (isset($_COOKIE["user"])) {
				$userID;
				echo "Hello " . $_COOKIE["user"] . "!<br>";
				$name = $_COOKIE["user"];
				
				//GET THE USER ID
				$query = "SELECT Users.userID ".
								"FROM Users ".
								"Where Users.name = '$name'";
				$result = mysqli_query($con,$query);
				//CHECK IF RESULT IS EMPTY
				if (mysqli_num_rows($result) == 0){
				   $userID = 0;
				}
				else {
					$row = mysqli_fetch_array($result);
					$userID = $row['userID'];
				}
				//echo $userID;
				//Print the comments from the selected database
				$query2 = "SELECT Comments.Comments ".
								"FROM Comments ".
								"Where Comments.userID = $userID";

				$comment = mysqli_query($con,$query2);

				while($row = mysqli_fetch_array($comment))
				{
				  echo "<p>".$row['Comments'] . "</p>";
				}

				//GETTING THE COMMENT DATA
				$comment = "";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST['comment'])) {
						$comment = $_POST["comment"];
					}
				}

				//Print and write comments to file, Creats new file if file doesn't exist.
				//if comment is whitespace don't print or write.
				if (trim($comment) != "") {
					echo "<p>".$comment."</p>";
					mysqli_query($con,"INSERT INTO Comments (Comments, userID) 
								VALUES ('$comment', $userID)");
				}
			}

			else {
				//MUST ENTER USERNAME TO USE CHAT
				echo "<p> PLEASE ENTER A USER NAME! </p> <br/>";
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