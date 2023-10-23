<?php 
    function conectarDB(){ // return connection
        // Database credentials
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "bienesraices_crud";
    
        // Create a new connection
        $conn = new mysqli($host, $user, $password, $database);
    
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        return $conn;
    }
    function login($username, $password){ // log in with given parameters
        $conn = conectarDB();
    
        $sql = "SELECT * FROM Usuarios WHERE Nombre = ?"; // SQL query with placeholder
        $stmt = $conn->prepare($sql); // Prepare the SQL statement
        $stmt->bind_param("s", $username); // Bind the parameter
        $stmt->execute(); // Execute the prepared statement
        $result = $stmt->get_result(); // Get the result
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) { // Assuming Password is a column in your Usuarios table
                return true;
            }
        }
    
        return false;
    }
    
    function signup($username, $password){ // sign up with given parameters
        $conn = conectarDB();
    
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    
        $sql = "INSERT INTO Usuarios (Nombre, Password) VALUES (?, ?)"; // Assuming Password is a column in your Usuarios table
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed_password);
        return $stmt->execute();
    }
    
    function logout(){ // log user out
        // Normally you'd unset session variables or destroy the session
        session_start();
        session_unset();
        session_destroy();
    }
    
    function customQuery($query, $params, $types){ // create a Query with given parameters like columns to fetch or table
        $conn = conectarDB();
        $stmt = $conn->prepare($query);
        $stmt->bind_param($types, ...$params); // Using the splat operator to pass an array of arguments
        $stmt->execute();
        return $stmt->get_result();
    }
    
?>