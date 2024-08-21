<?php
// Database configuration
    $servername = getenv('MYSQL_HOST');
    $username = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    $dbname = getenv('MYSQL_DATABASE');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to create a new user
function createUser($conn, $username, $email) {
    $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully.<br>";
    } else {
        echo "Error creating user: " . $conn->error . "<br>";
    }
}

// Function to read user data
function readUser($conn, $id) {
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Username: " . $row["username"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "No user found with ID $id.<br>";
    }
}

// Function to update user data
function updateUser($conn, $id, $username, $email) {
    $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully.<br>";
    } else {
        echo "Error updating user: " . $conn->error . "<br>";
    }
}

// Function to delete a user
function deleteUser($conn, $id) {
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully.<br>";
    } else {
        echo "Error deleting user: " . $conn->error . "<br>";
    }
}

// Function to display all users
function displayUsers($conn) {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Username: " . $row["username"]. " - Email: " . $row["email"]. "<br>";
        }
    } else {
        echo "No users found.<br>";
    }
}

// Example usage of CRUD operations

// Create a new user
createUser($conn, 'john_doe', 'john@example.com');

// Read user data
readUser($conn, 1);

// Update user data
updateUser($conn, 1, 'jane_doe', 'jane@example.com');

// Delete a user
deleteUser($conn, 1);

// Display all users
displayUsers($conn);

// Close connection
$conn->close();
?>

