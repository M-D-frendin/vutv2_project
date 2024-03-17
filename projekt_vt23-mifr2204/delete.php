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
    <h1>Radera</h1>



<form action="./delete.php" method="post">

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Titel</th>
            <th>Skapad</th>
            <th>Innehåll</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($posts as $post) {
?>
        <tr class="table-select">
            <td>
                <input type="hidden" name="id[]" value="<?=$post->id?>">
                <input type="checkbox" name="checkboxn[]" class="checkbox" id="<?=$post->id?>" value="<?=$post->id?>">
            </td>
            <td>
                <?= $post->title; ?>
            </td>
            <td>
                <?= $post->created; ?>
            </td>
            <td>
                <?= mb_strimwidth($post->content, 0, 50, "..."); ?>
            </td>
        </tr>
<?php
}
?>
    </tbody>
</table>
    
    <div class="form-field">
        <input id="deletebtn" type="submit" value="Ta bort inlägg" class="button flat" />
    </div>
    
</form>

<?php
//footer
include('includes/footer.php');
?>