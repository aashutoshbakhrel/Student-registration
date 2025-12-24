<?php
require "includes/header.php";
require "includes/functions.php";

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST['name']);
        $email = $_POST['email'];
        $skillsInput = $_POST['skills'];

        if (empty($name) || empty($email) || empty($skillsInput)) {
            throw new Exception("All fields are required.");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email address.");
        }

        $skillsArray = cleanSkills($skillsInput);
        $photoName = uploadPortfolioFile($_FILES['photo']);

        saveStudent($name, $email, $skillsArray, $photoName);

        $message = "Student added successfully.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<h3>Add Student</h3>

<form method="post" enctype="multipart/form-data">
    <label>Name</label>
    <input type="text" name="name">

    <label>Email</label>
    <input type="text" name="email">

    <label>Skills (comma separated)</label>
    <input type="text" name="skills">

    <label>Profile Picture (JPG / PNG)</label>
    <input type="file" name="photo">

    <button type="submit">Save Student</button>
</form>

<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="message error"><?php echo $error; ?></div>
<?php endif; ?>

<?php require "includes/footer.php"; ?>
