<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit;
}

if (isset($_POST['create'])) {
    $author = htmlspecialchars($_POST['author'], ENT_QUOTES, 'UTF-8');

    try {
        $sql = "INSERT INTO tblauthors (AuthorName) VALUES (:author)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->execute();

        if ($dbh->lastInsertId()) {
            $_SESSION['msg'] = "Author added successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database Error: " . $e->getMessage();
    }

    header('location:manage-authors.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Online Library Management System | Add Author</title>
    
    <!-- Bootstrap & Custom Styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>

    <!-- Header -->
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Add Author</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">Author Info</div>
                        <div class="panel-body">
                            
                            <!-- Display Success/Error Message -->
                            <?php if (!empty($_SESSION['msg'])) { ?>
                                <div class="alert alert-success"><?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
                            <?php } ?>
                            
                            <?php if (!empty($_SESSION['error'])) { ?>
                                <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                            <?php } ?>

                            <!-- Author Form -->
                            <form method="post">
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <input type="text" class="form-control" name="author" required>
                                </div>
                                <button type="submit" name="create" class="btn btn-info">Add</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- JavaScript -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>
