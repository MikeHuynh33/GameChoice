<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['gameId'];
    require_once './database_connection.php';
    $database = 'assignment2';
    // Now Select the database
    $con->select_db($database);
    $sql = 'DELETE FROM GAMETABLE WHERE ID = ?';
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        echo 'Row deleted successfully.';
        header(
            'Location: http://localhost/Assignment2_GameChoice/pages/admin.php'
        );
        exit();
    } else {
        echo 'Error deleting row: ' . $con->error;
    }
}
echo $id;
?>
