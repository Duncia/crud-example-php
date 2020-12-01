<?php

/*
*Gets entry by connecting to DB and entering ID
*/

function getEntry($conn, $id) {
    $sql = "SELECT *
            FROM weekentries
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
     }
    }
}

/*
*Validate entry for not being empty
*/

function validateEntry($title, $content) {
    $errors = [];
    if ($title == '') {
        $errors[] = 'Title is required!';
    }
    if ($content == '') {
        $errors[] = 'Content is required!';
    }

    return $errors;
}