<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['logout'])) { 
    session_destroy(); 
    unset($_SESSION['username']); 
    header("location: login.php"); 
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

<!-- the body section -->

<body>
    <header><header>
           <div class="nav-container">
               <nav class="navbar">
                   <h1 id="navbar-logo">CAO DATABASE</h1>
                   
                   <ul class="nav-menu">
                       <li><a href="index.php" class="nav-links nav-links-btn">Sign Out</a></li>

                   </ul>
               </nav>
           </div>
       </header>

</body>