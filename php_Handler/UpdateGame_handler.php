<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
    // check if the image input was empty or not IF it is not then inserted new image into folder and database
    if (!empty($_FILES['uploadImage']['tmp_name'])) {
        if (
            move_uploaded_file($_FILES['uploadImage']['tmp_name'], $targetFile)
        ) {
            require_once './database_connection.php';
            $database = 'assignment2';
            // Now Select the database
            $con->select_db($database);
            $sql =
                'UPDATE gametable SET Title=?, Description=?, Platform=?, Company=?, Release_date=?, Rating=?, Image=?, Price=?, category_id=? WHERE ID=?';

            // Assuming $id contains the ID of the record you want to update
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                'sssssdsdis',
                $title,
                $description,
                $platform,
                $company,
                $release_date,
                $rating,
                $targetFile,
                $price,
                $category_id,
                $id
            );
            if ($stmt->execute()) {
                echo 'Update successfully.';
                // Redirect to another page
                header(
                    'Location: http://localhost/Assignment2_GameChoice/pages/admin.php'
                );
                exit();
            } else {
                echo 'Error inserting game entry: ' . $stmt->error;
            }
        } else {
            echo 'error';
        }
    }
    //  IF it is then update all new data except for image.
    else {
        require_once './database_connection.php';
        $database = 'assignment2';
        // Now Select the database
        $con->select_db($database);
        $sql =
            'UPDATE gametable SET Title=?, Description=?, Platform=?, Company=?, Release_date=?, Rating=?, Price=?, category_id=? WHERE ID=?';

        $stmt = $con->prepare($sql);
        $stmt->bind_param(
            'sssssddis',
            $title,
            $description,
            $platform,
            $company,
            $release_date,
            $rating,
            $price,
            $category_id,
            $id
        );
        if ($stmt->execute()) {
            echo 'Update successfully.';
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
