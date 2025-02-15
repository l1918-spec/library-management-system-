# 📚 Library Management System  

A simple Library Management System developed using **PHP** and **MySQL**. This project demonstrates essential library management functionalities, including managing books, users, and transactions.  

## 🚀 Features  

- 📖 Add, edit, and delete books  
- 👥 Add, edit, and delete users  
- 📌 Issue and return books  
- 📜 View transaction history  

## 🛠 Prerequisites  

- XAMPP (or any similar local server)  
- Basic knowledge of PHP and MySQL  

## 🏗 Installation  

### 1️⃣ Set Up XAMPP  
- Download and install [XAMPP](https://www.apachefriends.org/index.html).  
- Start the **Apache** and **MySQL** modules from the XAMPP Control Panel.  

### 2️⃣ Clone the Repository  
```bash
git clone https://github.com/l1918-spec/library-management-system-.git
```

### 3️⃣ Move Project to `htdocs`  
Move the project folder to the `htdocs` directory in your XAMPP installation:  

- **Windows:** `C:\xampp\htdocs\`  
- **macOS/Linux:** `/opt/lampp/htdocs/`  

### 4️⃣ Import the Database  
- Open **phpMyAdmin** in your browser (`http://localhost/phpmyadmin`).  
- Create a new database named **`library_management_system`**.  
- Import the `library_management_system.sql` file from the `database` folder.  

### 5️⃣ Configure the Database Connection  
- Open `config.php` and update the database configuration if needed:  
```php
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
```

## 🔹 Usage  

1. Open your web browser and navigate to:  
   ```
   http://localhost/library-management-system-
   ```
2. You should now see the homepage of the Library Management System.  

## 🤝 Contributing  

Contributions are welcome! If you'd like to improve the project:  

1. Fork the repository.  
2. Create a new branch (`git checkout -b feature-branch`).  
3. Commit your changes (`git commit -m "Add new feature"`).  
4. Push to the branch (`git push origin feature-branch`).  
5. Open a pull request.  

## 📜 License  

This project is licensed under the **MIT License**. See the `LICENSE` file for more details.  

## 📩 Contact  

For questions or suggestions, feel free to open an issue or contact the project maintainer:  
📧 **l_charif@estin.dz**

