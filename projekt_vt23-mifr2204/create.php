<?php
include_once('system/common.php');
include_once('includes/classes/User.class.php');
include_once('includes/classes/Post.class.php');

//header & sidemenu
include('includes/header.php');
include('includes/sidemenu.php');

//användare måste vara inloggad för att på se sidan
if(!User::isAuthenticated()) {
    header('location: login.php?message=Du måste vara inloggad');
    die();
}

//om formulär har skickats, försök skapa ny Post
if(isset($_POST['title'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $newPostArgs = array('title' => $_POST['title'], 'content' => $_POST['content']);

    try {
        $post = Post::newPost($newPostArgs);
        $message = "<div class='status'>✔️ Sidan är skapad</div>";
        ?>
        <a href="./create.php">Skapa Nytt inlägg</a>
        <?php
    } catch (Exception $e) {
        $message = '<div class="alert">' . $e->getMessage() . '</div>';
    }
}
?>

<h2>Skapa Blogginlägg</h2>
<?php
//visa dynamiskt meddelande
if(isset($message)) {
    echo $message;
}

//visa formulär om formulär inte har skickats
if(!isset($_POST['title'])) {
?>
<div id="createForm">
    <form action="./create.php" method="post">
        <div class="form-field">
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" />
        </div>
        <div class="form-field">
            <label for="content">Innehåll</label>
            <textarea name="content" id="content" rows="15"></textarea>
        </div>

        <div class="form-field">
            <input id="createbtn" type="submit" value="Skapa" />
        </div>
    </form>
</div>
<?php
}
?>
<script>
    CKEDITOR.replace( 'content' );
</script>
<?php
//footer
include('includes/footer.php');
?>