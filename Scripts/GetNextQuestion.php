<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interviewapplication";

$userAnswer = $_POST["userAnswer"];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$command = escapeshellcmd('D:\xampp\htdocs\interviewapplication\rakeModel.py '.$userAnswer);
$questionToAsk = shell_exec($command); 
$questionToAsk = utf8_encode($questionToAsk);

// $questionToAsk = rand(1,300);

$sql = "SELECT questions, answers FROM questionanswer WHERE qid=$questionToAsk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo $row["questions"];
      echo "$";
      echo $row["answers"];
  }
} else {
  echo "0 results";
}

$conn->close();

?>