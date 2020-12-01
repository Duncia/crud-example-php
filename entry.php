<?php

require 'includes/database.php';

$conn = getDB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $sql = "SELECT *
            FROM weekentries
            WHERE id = " . $_GET['id'];

    $results = mysqli_query($conn, $sql);

    if ($results === false) {

        echo mysqli_error($conn);

    } else {

        $entry = mysqli_fetch_assoc($results);

    }

} else {
    $entry = null;
}

?>

<?php require 'includes/header.php'; ?>

<?php if ($entry === null): ?>
    <article class="entries">
        <section class="singleEntry">
            <h2>No entry found.</h2>
        </section>
    </article>
<?php else: ?>

    <article class="entries">
        <section class="intro">
            <p>Now viewing single entry.</p>
        </section>
        <section class="singleEntry">
            <h2><?= $entry['weekDay']; ?></h2>
            <h3>&#9745; <?= $entry['title']; ?></h3>
            <p><?= $entry['content']; ?></p>
            <form method="post" action="delete-entry.php?id=<?= $entry['id']; ?>">
            <section class="buttonRow">
                <button class="formDeleteBtn"><a href="delete-entry.php?id=<?= $entry['id']; ?>">Delete</a></button>
                <button class="formSaveBtn"><a href="edit.php?id=<?= $entry['id']; ?>">Edit</a></button>
                <button><a href="index.php">Back</a></button>
            </section>
            </form>
        </section>
    </article>

<?php endif; ?>

<?php require 'includes/footer.php'; ?>