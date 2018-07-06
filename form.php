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

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if(isset($_POST["submit"])) {

    $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(in_array($_FILES['fileToUpload']['type'],$mimes)){
        $uploadOk = 1;
    } else {
        echo "File is not an csv."  . " - ";
        $uploadOk = 0;
    }


// Allow certain file formats
    if($imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "csv"
        && $imageFileType != "doc" ) {
        echo "Sorry, only xls, xlsx, csv & doc files are allowed.".'</br>';
        header("Refresh:5; url=form");
        echo 'You\'ll be redirected in about 5 secs. If not, click <a href="form">here</a>.';
        $uploadOk = 0;
        exit;
    }


// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.".'</br>';
        header("Refresh:5; url=form");
        echo 'You\'ll be redirected in about 5 secs. If not, click <a href="form">here</a>.';
        $uploadOk = 0;
        exit;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.".'</br>';
        header("Refresh:5; url=form");
        echo 'You\'ll be redirected in about 5 secs. If not, click <a href="form">here</a>.';
        $uploadOk = 0;
        exit;
    }

// make sure the 'uploads' folder exists
// if not, create it
    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.".'</br>';
        header("Refresh:5; url=form");
        echo 'You\'ll be redirected in about 5 secs. If not, click <a href="form">here</a>.';
        exit;
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded".'</br>';
            header("Location: table.php?FilesName=$filename");


        } else {
            echo "Sorry, there was an error uploading your file.".'</br>';
            header("Refresh:5; url=form");
            echo 'You\'ll be redirected in about 5 secs. If not, click <a href="form">here</a>.';
        }
    }
}


?>
<form action="form" method="post" enctype="multipart/form-data">


    <table class="table table-hover table-responsive table-bordered">

        <tbody>

        <tr>
            <td>Files</td>
            <td><input type="file" id="fileToUpload" name="fileToUpload" /></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary" value="Upload File" name="submit">
                    <span class="glyphicon glyphicon-plus"></span> Upload File
                </button>
            </td>
        </tr>

        </tbody>
    </table>
</form>



<?php
// footer HTML and JavaScript codes
include 'layout_foot.php';

?>
