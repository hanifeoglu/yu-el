
<?php
// core configuration
include_once "config/core.php";

// set page title
$page_title="File Upload System";


// include login checker
$require_login=true;
include_once "login_checker.php";

// include page header HTML
include_once 'layout_head.php';

$dir = "uploads/";
$files = scandir($dir);
rsort($files);


    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>Files Name</th>";
    //echo "<th></th>";
    echo "</tr>";

    foreach ($files as $file) {
    if ($file != '.' && $file != '..' ) {

        echo "<tr>";
        echo "<td><a href='table.php?FilesName=$file'> $file </a></td>";

        echo "</tr>";


    }


}
echo "</table>";



include_once "layout_foot.php";