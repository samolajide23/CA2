<?php
include('includes/header.php');

require("config.php");
$con = config::connect();
$record_id = filter_input(INPUT_POST, 'record_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM records
          WHERE recordID = :record_id';
$statement = $con->prepare($query);
$statement->bindValue(':record_id', $record_id);
$statement->execute();
$records = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

if (isset($_POST['submit'])) {

       $con = config::connect();

       // Add the product to the database 
       $query = 'UPDATE records

           SET
           courseName = :courseName,
           courseCode = :courseCode,
           level = :level,
           years = :years
           
           WHERE 
           recordID = :recordId';


       $statement = $con->prepare($query);
       $statement->execute(
              array(
                     'recordId' =>  $_POST['recordId'],
                     'courseCode' =>  $_POST['courseCode'],
                     'courseName' =>  $_POST['courseName'],
                     'level' =>  $_POST['level'],
                     'years' =>  $_POST['years']
              )
       );
       // Display the Product List page
       header("Location: adminCourses.php");
}
?>

<!-- the head section -->

<head>
       <title>My PHP CRUD App</title>

       <link rel="stylesheet" type="text/css" href="css/mystyle.css">
       <script src="JS/script.js"></script>
       <script src="JS/validation.js"></script>
       <link rel="preconnect" href="https://fonts.gstatic.com">

</head>
<div class="courseFormContainer">
       <h1>Edit Product</h1>
       <form method="post" enctype="multipart/form-data" id="add_record_form">

              <input type="hidden" name="recordId" value="<?php echo $records['recordID']; ?>">

              <label>Course Name:</label>
              <input required type="input" name="courseName" value="<?php echo $records['courseName']; ?>">
              <br>

              <label>Course Code:</label>
              <input required type="input" name="courseCode" value="<?php echo $records['courseCode']; ?>">
              <br>

              <label>Level:  (6 - 8)</label>
              <input required type="number" min="6" max="8" name="level" value="<?php echo $records['level']; ?>">
              <br>

              <label>years:  (1 - 5)</label>
              <input required type="number" min="1" max="5" name="years" value="<?php echo $records['years']; ?>">
              <br>

              <label>&nbsp;</label>
              <input name="submit" type="submit" value="Save Changes">
              <label>&nbsp;</label>
              <input type="button" onclick="location.href='adminCourses.php';" value="Cancel" />
              <br>
       </form>