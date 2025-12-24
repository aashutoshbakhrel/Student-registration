<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    return array_map('trim', explode(",", $string));
}

function uploadPortfolioFile($file) {
    $allowedTypes = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024;

    if ($file['error'] !== 0) {
        throw new Exception("Image upload failed.");
    }

    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception("Only JPG and PNG images allowed.");
    }

    if ($file['size'] > $maxSize) {
        throw new Exception("Image exceeds 2MB limit.");
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = "student_" . time() . "." . $extension;

    if (!move_uploaded_file($file['tmp_name'], "uploads/" . $newName)) {
        throw new Exception("Could not save image.");
    }

    return $newName;
}

function saveStudent($name, $email, $skillsArray, $photo) {
    $line = $name . "|" . $email . "|" . implode(",", $skillsArray) . "|" . $photo . PHP_EOL;
    file_put_contents("students.txt", $line, FILE_APPEND);
}
