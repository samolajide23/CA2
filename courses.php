 <?php require_once('database.php');

    // Get category ID
    if (!isset($category_id)) {
        $category_id = filter_input(
            INPUT_GET,
            'category_id',
            FILTER_VALIDATE_INT
        );
        if ($category_id == NULL || $category_id == FALSE) {
            $category_id = 1;
        }
    }

    // Get name for current category
    $queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
    $statement1 = $db->prepare($queryCategory);
    $statement1->bindValue(':category_id', $category_id);
    $statement1->execute();
    $category = $statement1->fetch();
    $statement1->closeCursor();
    $category_name = $category['categoryName'];

    // Get all categories
    $queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
    $statement2 = $db->prepare($queryAllCategories);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();

    // Get records for selected category
    $queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY categoryID";
    $statement3 = $db->prepare($queryRecords);
    $statement3->bindValue(':category_id', $category_id);
    $statement3->execute();
    $records = $statement3->fetchAll();
    $statement3->closeCursor();
    ?>
 <!DOCTYPE html>
 <!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
 <html>

 <head>
     <title>Signup Form</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/mystyle.css" />
     <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 </head>

 <body>
     <header>
         <div class="nav-container">
             <nav class="navbar">
                 <h1 id="navbar-logo">CAO DATABASE</h1>

                 <!-- display a list of categories -->
                 <div class="sidenav">
                     <?php foreach ($categories as $category) : ?>
                         <a href="?category_id=<?php echo $category['categoryID']; ?>">
                             <?php echo $category['categoryName']; ?>
                         </a>
                     <?php endforeach; ?>

                 </div>


                 <ul class="nav-menu">
                     <a href="index.php" class="nav-links nav-links-btn">Sign Out</a>
                 </ul>
             </nav>
         </div>
     </header>
     <div class="courseContainer" id="courseContainer">

         <div class="container">


             <section>
                 <!-- display a table of records -->
                 <h1 class="title"><?php echo $category_name; ?></h1>
                 <table>
                     <tr>
                         <th>Course Code</th>
                         <th>Category</th>
                         <th>Course Name</th>
                         <th>Level</th>
                         <th>Years</th>

                     </tr>
                     <?php foreach ($records as $record) : ?>
                         <tr>
                             <td><?php echo $record['courseCode']; ?></td>
                             <td class="right"><?php echo $category_name; ?></td>
                             <td class="right"><?php echo $record['courseName']; ?></td>
                             <td class="right"><?php echo $record['level']; ?></td>
                             <td class="right"><?php echo $record['years']; ?></td>
                         </tr>
                     <?php endforeach; ?>
                 </table>
                 <p></p>
             </section>
         </div>
         <script src="main.js"></script>
 </body>

 </html>