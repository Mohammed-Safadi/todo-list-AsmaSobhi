<?php

$errors = "";
$db = mysqli_connect("localhost", "root", "", "todo");
if (isset($_POST['submit'])) {
    if (empty($_POST['task'])) {
        $errors = "You must fill in the task";
    }else{
        $task = $_POST['task'];
        $query = "INSERT INTO tasks (task) VALUES ('$task')";
        mysqli_query($db, $query);
        header('location: index.php');
    }
}
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
    header('location: index.php');
}
if (isset($_GET['done_task'])) {
    $id = $_GET['done_task'];
    mysqli_query($db, "UPDATE tasks SET status = 1 WHERE id=".$id);
    header('location: index.php');
}
$tasks = mysqli_query($db, "SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My To-do's list</title>
    <link rel="stylesheet" href="styl.css" type="text/css">
</head>

<body>
<div>
    <h1>My To-do's list</h1>
    <form method="post" action="index.php">

        <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>

        <input id="new-task" type="text" name="task" placeholder="add new task">
        <button type="submit" name="submit" class="add" id="add">Add to list</button>
    </form>

    <h3>To do</h3>

    <ul id="tasks">
        <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <li>

                <?php if ($row['status'] == 1) { ?>
                    <label style="color:green; text-decoration: line-through;"><?php echo $row['task']; ?></label>
                <?php }else {  ?>
                    <label><?php echo $row['task']; ?></label>
                <?php } ?>

                <div class="btn">
                    <?php if($row['status'] == 0){?>
                        <span>
							<a class="done" href="index.php?done_task=<?php echo $row['id'] ?>" style="text-decoration: none;">Mark as Done</a>
							<span class="dash"> | </span>
						</span>
                    <?php } ?>
                    <a class="delete" href="index.php?del_task=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure?')" style="text-decoration: none;">Delete</a>
                </div>
            </li>
            <?php $i++; } ?>
    </ul>
</div>
</body>
<script>

</script>
</html>