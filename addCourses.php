<?php
include('includes/header.php');
require('config.php');
$con = config::connect();
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $con->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
<?php

if(isset($_POST['submit'])){

$con = config::connect();

    // Add the product to the database 
    $query = "INSERT INTO records
                 (categoryID, courseCode, courseName, level, years)
              VALUES
                 (:categoryID, :courseCode, :courseName, :level, :years)";

    $statement = $con->prepare($query);
    $statement->execute(
        array(
            'categoryID' =>  $_POST['categoryId'],
            'courseCode' =>  $_POST['courseCode'],
            'courseName' =>  $_POST['courseName'],
            'level' =>  $_POST['level'],
            'years' =>  $_POST['years'],
        )
    );

    // Display the Product List page
    header("Location: adminCourses.php");
}
?>

<head>
    <title>My PHP CRUD App</title>

    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <script src="JS/script.js"></script>
    <script src="JS/validation.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">

</head>
<div class="courseFormContainer">
    <h1>Add Record</h1>
    <form method="post" enctype="multipart/form-data" id="add_record_form">

        <label>Category:</label>

        <select name="categoryId">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Course Name:</label>
        <input required type="input" name="courseName">
        <br>

        <label>Course Code:</label>
        <input required type="input" name="courseCode">
        <br>

        <label>Level:  (6 - 8)</label>
        <input required type="number" name="level" min="6" max="8" >
        <br>

        <label>Years:  (1 - 5)</label>
        <input required type="number" name="years" min="1" max="5" >
        <br>

        <label>&nbsp;</label>
        <input type="submit" name="submit" value="Add Record">
        <label>&nbsp;</label>
        <input type="button" onclick="location.href='adminCourses.php';" value="Cancel" />
        <br>
    </form>
</div>
<?php
?>