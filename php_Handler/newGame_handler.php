<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $platform = $_POST['platform'];
    $company = $_POST['company'];
    $release_date = $_POST['release_date'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];

    //upload image
    $targetDir = '../photos/';
    $targetFile = $targetDir . basename($_FILES['uploadImage']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetFile)) {
        require_once './database_connection.php';
        $database = 'assignment2';
        // Now Select the database
        $con->select_db($database);
        $sql =
            'INSERT INTO gametable (Title, Description, Platform, Company, Release_date, Rating, Image, Price, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'sssssdssi',
            $title,
            $description,
            $platform,
            $company,
            $release_date,
            $rating,
            $targetFile,
            $price,
            $category_id
        );
        if ($stmt->execute()) {
            echo 'Inserted successfully.';
            // Redirect to another page
            header(
                'Location: http://localhost/Assignment2_GameChoice/pages/admin.php'
            );
            exit();
        } else {
            echo 'Error inserting game entry: ' . $stmt->error;
        }
    }
}

?>
