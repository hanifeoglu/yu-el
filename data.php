
<?php
// core configuration
include_once "config/core.php";
//Content Title
$pageTitle = "Data Show";

// set page title
$page_title="Table in Data Showing";

// include login checker
$require_login=true;
include_once "login_checker.php";

// include page header HTML
include_once 'layout_head.php';


// set page header
include_once "layout_head.php";

// include database and object files
include_once 'config/database.php';
include_once 'objects/ornek.php';


// instantiate database and objects
$database = new Database();
$db = $database->getConnection();

$ornek = new Ornek($db);

// query to ornek table
$stmt = $ornek->readAll();
$num = $stmt->rowCount();

echo "Ornek Record Count ". $num;

// display the products if there are any
if($num>0){

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>id</th>";
    echo "<th>Email</th>";
    echo "<th>Telefon</th>";
    echo "<th>Şehir</th>";
    echo "<th>Tarih</th>";
    echo "<th>Tutar</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$email}</td>";
        echo "<td>{$telefon}</td>";
        echo "<td>{$sehir}</td>";
        echo "<td>{$tarih}</td>";
        echo "<td>{$tutar}</td>";


        echo "</tr>";

    }

    echo "</table>";


}

// tell the user there are no products
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}



include_once "layout_foot.php";

