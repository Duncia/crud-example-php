<?php

// Require database (separate file)

require 'includes/database.php';
$conn = getDB();

// Empty arrays for each day declared
$mondayAll = [];
$tuesdayAll = [];
$wednesdayAll = [];
$thursdayAll = [];
$fridayAll = [];
$weekendAll = [];

// With SQL all entries taken from table "weekentries"
$sql = "SELECT *
        FROM weekentries
        ORDER BY id;";

// Results are are saved and processed further
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $entries = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

// Loop foreach sorts each entry to separate array of the day
foreach ($entries as $entry) {
    if ($entry['weekDay'] == "Monday") {
        $mondayAll[] = $entry;
    }
    if ($entry['weekDay'] == "Tuesday") {
        $tuesdayAll[] = $entry;
    }
    if ($entry['weekDay'] == "Wednesday") {
        $wednesdayAll[] = $entry;
    }
    if ($entry['weekDay'] == "Thursday") {
        $thursdayAll[] = $entry;
    }
    if ($entry['weekDay'] == "Friday") {
        $fridayAll[] = $entry;
    }
    if ($entry['weekDay'] == "Weekend") {
        $weekendAll[] = $entry;
    }
}

// Function to generate all records of the arrray from database
function getDailyEntry($arr) {

    if (empty($arr)) {
        echo "<h3>Not entries for this day.</h3>";
    } else {
        foreach ($arr as $el) {
            $url = "\"entry.php?id={$el['id']}\"";
            $title = htmlspecialchars($el['title']);
            $content = htmlspecialchars($el['content']);
            echo "<ul><li><h3>&#9745; {$title}</h3><p>{$content}</p><button class=\"viewEntryBtn\"><a href={$url}>View more</a></button></li></ul>";
        }
    }
}

?>

<!-- Headar and footer separated to different PHP file -->
<?php require 'includes/header.php'; ?>

        <article class="entries">
            <section class="intro">
                <p>Create, read, update, delete (CRUD) using PHP, HTML, CSS, SQL. Weekly tasks as entries are shown for each day. Each entry can be read separately. It is possible to add, delete, update entry and view all entries here.</p>
                <button class="formSaveBtn"><a href="new-entry.php">NEW ENTRY</a></button>
            </section>
<!-- Every day of the week has separate records from DB with a function call -->
            <section class="singleEntry">
                <h2>Monday</h2>
                <?= getDailyEntry($mondayAll); ?>
            </section>

            <section class="singleEntry">
                <h2>Tuesday</h2>
                <?= getDailyEntry($tuesdayAll); ?>
            </section>

            <section class="singleEntry">
                <h2>Wednesday</h2>
                <?= getDailyEntry($wednesdayAll); ?>
            </section>

            <section class="singleEntry">
                <h2>Thursday</h2>
                <?= getDailyEntry($thursdayAll); ?>
            </section>

            <section class="singleEntry">
                <h2>Friday</h2>
                <?= getDailyEntry($fridayAll); ?>
            </section>

            <section class="singleEntry">
                <h2>Weekend</h2>
                <?= getDailyEntry($weekendAll); ?>
            </section>

        </article>

<?php require 'includes/footer.php'; ?>
