<?php

require 'includes/database.php';
require 'includes/entry.php';
require 'includes/url.php';

$conn = getDB();

if (isset($_GET['id'])) {

    $entry = getEntry($conn, $_GET['id'], 'id');

    if ($entry) {
        $id = $entry['id'];

} else {
    die("Entry not found!");
}

} else {

        die("ID not supplied.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM weekentries
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {

        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {

            redirect("/phpcrud/index.php");
    } else {
        echo mysqli_stmt_error($stmt);
    }
    }
}
?>
<?php require 'includes/header.php'; ?>

<article class="entries">
        <section class="singleEntry buttonRow">
            <h4>Are you sure you want to delete entry?</h4>
            <form method="post">
                <button class="formDeleteBtn">Delete</button>
                <button ><a href="entry.php?id=<?= $entry['id']; ?>">Cancel</a></button>
            </form>
        </section>
</article>

<?php require 'includes/footer.php'; ?>
