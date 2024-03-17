<?php
include_once('system/common.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');

//header & sidemenu
include('includes/header.php');
include('includes/sidemenu.php');

//användare måste vara inloggad för att på se sidan
if(!User::isAuthenticated()) {
    header('location: login.php?message=Du måste vara inloggad');
    die();
}

//om formulär har skickats, radera valda Posts
if(isset($_POST['checkboxn'])) {
    foreach($_POST['checkboxn'] as $id)
    {
        try {
            $post = Post::getUnique($id);
            $post->delete();
        } catch (Exception $e) {
            $message = '<div class="alert">' . $e->getMessage() . '</div>';
        }
    }
}

//hämta alla posts för inloggad användare
$user = User::getLoggedInUser();
$posts = $user->getPosts();


//felmeddelande
if(isset($message)) {
    echo $message;
}
?>


<form action="./delete.php" method="post">
    <ul>
    
    <?php
foreach($posts as $post) {
    ?>
    <input type="hidden" name="id[]" value="<?=$post->id?>">
    <input type="checkbox" name="checkboxn[]" id="<?=$post->id?>" value="<?=$post->id?>">
    <li>
    <h3><?= $post->title; ?></h3>
    <p>________________________ </p>
    <p>Skapad <?= $post->created; ?> </p>
    <div class="by">
    <p>Av</p>
    <p class="username"> <?= $user->username; ?></p>
    <p class="underscore">________________________ </p>
    <h4><?= $post->content; ?></h4>
    </li>
    </ul>
    <?php
}
?>
    
    <div class="form-field">
        <input id="deletebtn" type="submit" value="Ta bort inlägg" />
    </div>
    
</form>

<?php
//footer
include('includes/footer.php');
?>