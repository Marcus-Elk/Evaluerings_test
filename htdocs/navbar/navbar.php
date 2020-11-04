<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="./navbar/navbar.css">
  <title>Database System</title>
  <meta name="author" content="">
   
</head> 
<body>
<?php
require_once("./include/roles.php");
if(isset($_SESSION['user_id'])) {
  echo("<ul>");
    echo("<li><a class=\"active\" href=\"./index.php\">Home</a></li>");
      if(isStudent()){
        echo("<li><a href=\"./view_test.php\">Check Available Test</a></li>");
      }
      if(isTeacher()){
        echo("<li><a href=\"./create_test.php\">Create Test</a></li>");
      }
      if(isAdmin()){
        echo("<li><a id = \"import\">Import Data</a></li>");
      }
    echo("<li><a href=\"./account/logout.php\">Log out</a></li>");
  echo("</ul>");
} else {
  echo("<ul>");
    echo("<li><a class=\"active\" href=\"./index.php\">Home</a></li>");
    echo("<li><a href=\"./login.php\">Log in</a></li>");
    echo("<li><a href=\"./signup.php\">Sign up</a></li>");
  echo("</ul>");
}
?>
</body>
</html>
