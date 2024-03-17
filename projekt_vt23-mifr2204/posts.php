<?php
/*Skapad av Mikaela Frendin mifr2204@student.miun.se*/

include_once('system/common.php');
include_once('includes/classes/Post.class.php');

//header & sidemenu
$page_title = $post->title;
include('includes/header.php');
include('includes/sidemenu.php');

//id för post måste vara angivet som parameter för sidan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location: ./index.php");
}

//hämta vald Post som variabel
$post = Post::getUnique($id);
?>

<h1><?= $post->title; ?></h1>


<?= $post->content; ?>

<div id="id">
<?= $id; ?>
</div>

<?php
//footer
include('includes/footer.php');
?>