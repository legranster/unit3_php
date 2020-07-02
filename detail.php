<?php
include('inc/header.php');
include('inc/functions.php');   

if (isset($_GET['id'])){
    list($title, $date, $time_spent, $learned, $resources, $id, $tag) = get_specific_entry(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if(isset($_POST['delete'])){
    if(delete_entry(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
        header('Location:index.php?msg=Entry+deleted');
        exit;
    } else {
        header('Location:index.php?msg=Unable+to+delete+entry');
    }
}
?>
<div class="container">
    <div class="entry-list single">
        <article>
            <h1><?php echo $title?></h1>
            <?php echo "<time datetime='" . strtotime($date) . "'>" . date('F d, Y', strtotime($date)) . "</time><br />";?> 
            <div class="entry">
                <h3>Time Spent: </h3>
                <p><?php echo $time_spent;?></p>
            </div>
            <div class="entry">
                <h3>What I Learned:</h3>
                <p><?php echo nl2br($learned)?></p>
            </div>
            <div class="entry">
                <h3>Resources to Remember:</h3>
                <ul>
                    <li><?php echo nl2br($resources);?></li>
                </ul>
            </div>
            <div>
                <p class='tag'>Tag: <a href='index.php?tag=<?php echo $tag?>'><?php echo $tag;?></a></p>
            </div>
            <div class="delete">
                <form method='post' action='detail.php' onsubmit="return confirm('Are you sure you want to delete this task?')">
                    <input type='hidden' value='<?php echo $id;?>' name='delete' />
                    <input type='submit' class="buton button-delete" value='Delete Entry' />
                </form>
            </div>
        </article>
    </div>
</div>
<div class="edit">
    <p><a href='edit.php?id=<?php echo $id; ?>'> Edit Entry </a></p>
</div>
<?php
include('inc/footer.php');
?>