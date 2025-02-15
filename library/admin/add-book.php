<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit;
} 

if (isset($_POST['add'])) {
    $bookname = $_POST['bookname'];
    $category = $_POST['category'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $price = $_POST['price'];
    $bookimg = $_FILES['bookpic']['name'];
    
    // Get the image extension
    $extension = strtolower(pathinfo($bookimg, PATHINFO_EXTENSION));
    // Allowed extensions
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
    } else {
        // Rename the image file
        $imgnewname = md5($bookimg . time()) . "." . $extension;
        // Move image into directory
        move_uploaded_file($_FILES['bookpic']['tmp_name'], "bookimg/" . $imgnewname);

        $sql = "INSERT INTO tblbooks (BookName, CatId, AuthorId, ISBNNumber, BookPrice, bookImage) 
                VALUES (:bookname, :category, :author, :isbn, :price, :imgnewname)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':imgnewname', $imgnewname, PDO::PARAM_STR);
        
        if ($query->execute()) {
            echo "<script>alert('Book Listed successfully');</script>";
            echo "<script>window.location.href='manage-books.php'</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";    
            echo "<script>window.location.href='manage-books.php'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Online Library Management System | Add Book</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function checkisbnAvailability() {
            $("#loaderIcon").show();
            $.ajax({
                url: "check_availability.php",
                type: "POST",
                data: {isbn: $("#isbn").val()},
                success: function(data) {
                    $("#isbn-availability-status").html(data);
                    $("#loaderIcon").hide();
                }
            });
        }
    </script>
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add Book</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">Book Info</div>
                        <div class="panel-body">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" required />
                                </div>
                                <div class="form-group">
                                    <label>Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required>
                                        <option value="">Select Category</option>
                                        <?php 
                                        $status = 1;
                                        $sql = "SELECT * FROM tblcategory WHERE Status = :status";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->id); ?>">
                                                <?php echo htmlentities($result->CategoryName); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Author<span style="color:red;">*</span></label>
                                    <select class="form-control" name="author" required>
                                        <option value="">Select Author</option>
                                        <?php 
                                        $sql = "SELECT * FROM tblauthors";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->id); ?>">
                                                <?php echo htmlentities($result->AuthorName); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn" id="isbn" required onblur="checkisbnAvailability()" />
                                    <span id="isbn-availability-status" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group">
                                    <label>Price<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="price" required />
                                </div>
                                <div class="form-group">
                                    <label>Book Picture<span style="color:red;">*</span></label>
                                    <input class="form-control" type="file" name="bookpic" required />
                                </div>
                                <button type="submit" name="add" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
