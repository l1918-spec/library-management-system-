Library Management System

A simple Library Management System developed using PHP and MySQL. This project demonstrates the basic functionalities of a library system, including managing books, users, and transactions.

Features

Add, edit, and delete books
Add, edit, and delete users
Issue and return books
View transaction history
Prerequisites

XAMPP (or any similar local server)
Basic knowledge of PHP and MySQL

Installation:

1. Set Up XAMPP
Download and install XAMPP.
Start the Apache and MySQL modules from the XAMPP Control Panel.

2. Clone the Repository:
git clone https://github.com/l1918-spec/library-management-system-.git

3. Move Project to htdocs
Move the entire project folder to the htdocs directory of your XAMPP installation. This is typically located at:

Windows: C:\xampp\htdocs\
macOS/Linux: /opt/lampp/htdocs/
4. Import the Database
Open phpMyAdmin in your browser.
Create a new database named library_management_system.
Import the library_management_system.sql file located in the database folder of the project.
--------------------------------------
5. Configure the Database Connection
Open the config.php file in the project root and update the database configuration settings if needed:
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

------------------------------
Usage

Open your web browser and navigate to http://localhost/library-management-system-.
You should see the homepage of the Library Management System.
Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

License

This project is licensed under the MIT License. See the LICENSE file for more details.

Contact

If you have any questions or suggestions, feel free to open an issue or contact the project maintainer at l_charif@estin.dz
