<?php
require "includes/header.php";

if (!file_exists("students.txt")) {
    echo "<p>No students found.</p>";
    require "includes/footer.php";
    exit;
}

$students = file("students.txt");
?>

<h3>Student List</h3>

<?php foreach ($students as $student): ?>
    <?php
        list($name, $email, $skills, $photo) = explode("|", trim($student));
        $skillsArray = explode(",", $skills);
    ?>
    <div class="student-card">
        <img src="uploads/<?php echo $photo; ?>" alt="Student Photo">
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Skills:</strong></p>
        <ul>
            <?php foreach ($skillsArray as $skill): ?>
                <li><?php echo $skill; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>

<?php require "includes/footer.php"; ?>
