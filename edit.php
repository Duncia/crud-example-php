<?php

require 'includes/database.php';
require 'includes/entry.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {
    $entry = getEntry($conn, $_GET['id']);

    if ($entry) {
        $id = $entry['id'];
        $title = $entry['title'];
        $content = $entry['content'];
        $weekDay = $entry['weekDay'];

        } else {
            die("Entry not found!");
        }

} else {

        die("ID not supplied.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $weekDay = $_POST['weekDay'];

// Validation function if not empty title and content
    $errors = validateEntry($title, $content);

// If no errors, DB function called and with sql entry saved
if (empty($errors)) {

    $sql = "UPDATE weekentries
        SET weekDay = ?,
            title = ?,
            content = ?
        WHERE id = ?";

// Prepare/bind param is used to escape sql (html) injection
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {

        mysqli_stmt_bind_param($stmt, "sssi", $weekDay, $title, $content, $id);

        if (mysqli_stmt_execute($stmt)) {

// Redirection is taken place using url from separate php file
            redirect("/phpcrud/entry.php?id=$id");
    } else {
        echo mysqli_stmt_error($stmt);
    }
    }
    }

}
?>
<?php require 'includes/header.php'; ?>

<article class="entries">
        <section class="intro">
            <p>Make updates to the entry.</p>
        </section>
        <section class="singleEntry">
<!-- Form html structure is save in diferrent file -->
            <?php require 'includes/entry-form.php'; ?>
        </section>
</article>

<?php require 'includes/footer.php'; ?>