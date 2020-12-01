<?php
/*
* Form with POST method where name binds the value to enter it in SQL.
*/
if (! empty($errors)): ?>
    <section class="errorMessage">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<form method="post">
    <section>
        <label for="title"><p>Title</p></label>
        <input name="title" id="title" type="text" placeholder="Short title here" value="<?= htmlspecialchars($title); ?>" />
    </section>
    <section>
        <label for="weekd"><p>Day of week</p></label>
        <select name="weekDay" id="weekd">
            <option value="Monday" <?php if($weekDay == 'Monday'){echo 'selected="selected"';}?>>Monday</option>
            <option value="Tuesday" <?php if($weekDay == 'Tuesday'){echo 'selected="selected"';}?>>Tuesday</option>
            <option value="Wednesday" <?php if($weekDay == 'Wednesday'){echo 'selected="selected"';}?>>Wednesday</option>
            <option value="Thursday" <?php if($weekDay == 'Thursday'){echo 'selected="selected"';}?>>Thursday</option>
            <option value="Friday" <?php if($weekDay == 'Friday'){echo 'selected="selected"';}?>>Friday</option>
            <option value="Weekend" <?php if($weekDay == 'Weekend'){echo 'selected="selected"';}?>>Weekend</option>
        </select>
    </section>
    <section>
        <label for="content"><p class="textAreaPar">Content</p></label>
        <textarea name="content" rows=4 type="text" id="content" placeholder="Enter details of the task here"><?= htmlspecialchars($content); ?></textarea>
    </section>
    <section class="buttonRow">
        <button class="formSaveBtn">Save</button>
        <button><a href="index.php">Back</a></button>
    </section>

</form>