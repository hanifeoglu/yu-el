<?php
// core configuration
include_once "config/core.php";


// set page title
$page_title="Table in Data Showing";

// include login checker
$require_login=true;
include_once "login_checker.php";

// include page header HTML
include_once 'layout_head.php';



//get url in files name
$url = $_GET["FilesName"];

//read  it upload folder in grt url in files name
$file = file_get_contents('uploads/'.$url);

//explode it pear with space after
$lines = explode("\n", $file);
//unset($lines[0]);

//start table here
echo '<table class=\'table table-hover table-responsive table-bordered\'>';
foreach ($lines as $key => &$line) {
    echo '<tr>';
    $line = explode(" ", $line);
    foreach ($line as $item) {
        if ($key)
            echo '<td>' .$item.'</td>';
        else

            echo '<th>' . $item. '</th>';
    }
    echo '</tr>'; // end td
}
echo '</table>'; // end table

include_once "layout_foot.php";
?>
