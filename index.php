<?php 
include('inc/header.php');
include('inc/functions.php');

if (isset($_GET['msg'])){
    $error_message = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);
}
$tag = null;
if (isset($_GET['tag'])){
    $tag = $_GET['tag'];
}
?>
<div class="container">
    <div class="entry-list">
        <?php 
        if (isset($error_message)){
            echo "<h3 class='error-message animate__animated animate__fadeOut animate__delay-2s'>$error_message</h3>\n" ;
        }
        foreach(get_entries($tag) as $entry){
            echo "<article>";
            echo "<h2><a href='detail.php?id=" . $entry['id'] . "'>" . $entry['title'] . "</a></h2>";
            echo "<time datetime='" . strtotime($entry['date']) . "'>" . date('F d, Y', strtotime($entry['date'])) . "</time>";
            echo "<p class='tag'><a href='index.php?tag=".$entry['tag']."'>" .$entry['tag']."</a></p>";
            echo "</article>";
        }
        ?>
    </div>
</div>
<?php 
include('inc/footer.php');
?>