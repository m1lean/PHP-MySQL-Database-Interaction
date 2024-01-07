<?php
// Database connection
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created or already exists successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert data into the table
$sql_insert = "INSERT INTO users (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql_insert) === TRUE) {
    echo "New record added successfully.";
} else {
    echo "Error adding record: " . $conn->error;
}

// Retrieve data from the table
$sql_select = "SELECT id, firstname, lastname, email FROM users";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Display data
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
