<!DOCTYPE html>
<html>
<head>
    <title>My PHP Web App</title>
</head>
<body>
     <a href="pages/admin.php">Go to Admin Panel</a>
    <h1>Welcome to My PHP Web App!</h1>
    <p>This is a basic example of an index.php file.</p>

    <?php
    // If we would like to connect to database, we can call database handler php
    require_once 'php_handler/database_connection.php';
    $database = 'assignment2';
    // Now Select the database
    $con->select_db($database);
    $sql = 'SELECT * FROM gametable';
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo 'GameTable has data ';
    } else {
        echo 'GameTable is empty , u should add something on it';
    }
    ?>
</body>
</html>