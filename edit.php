<?php 
include('inc/header.php');
include('inc/functions.php');

if (isset($_GET['id'])){
    list($title, $date, $time_spent, $learned, $resources, $id) = get_specific_entry(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    echo $id;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    $time_spent = trim(filter_input(INPUT_POST, 'timeSpent', FILTER_SANITIZE_STRING));
    $learned = trim(filter_input(INPUT_POST, 'whatILearned', FILTER_SANITIZE_STRING));
    $resources = trim(filter_input(INPUT_POST, 'ResourcesToRemember', FILTER_SANITIZE_STRING));
    $id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));

    if(empty($title) || empty($date) || empty($time_spent) || empty($learned) || empty($resources)){
        $error_message = 'Please fill in all required fields: Title, Date, Time Spent, Learned, Resources';
    } else {
        if(edit_entry($id, $title, $date, $time_spent, $learned, $resources)){
            header('Location:index.php?msg=Entry+updated');
            exit;
        } else {
            $error_message = 'Could not add entry';
        }
    }
}

?>
<div class="container">
    <div class="edit-entry">
        <h2>Edit Entry</h2>
        <form action='edit.php' method='POST'>
            <label for="title"> Title</label>
            <input id="title" type="text" name="title" value="<?php echo $title;?>"><br>
            <label for="date">Date</label>
            <input id="date" type="date" name="date" value="<?php echo $date;?>"><br>
            <label for="time-spent"> Time Spent</label>
            <input id="time-spent" type="text" name="timeSpent" value="<?php echo $time_spent;?>"><br>
            <label for="what-i-learned">What I Learned</label>
            <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $learned;?></textarea>
            <label for="resources-to-remember">Resources to Remember</label>
            <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo $resources;?></textarea>
            <?php 
            if (!empty($id)){
                echo '<input type="hidden" name="id" value="' . $id . '" />';
            }
            ?>
            <input type="submit" value="Publish Entry" class="button">
            <a href="#" class="button button-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php 
include('inc/footer.php');
?>