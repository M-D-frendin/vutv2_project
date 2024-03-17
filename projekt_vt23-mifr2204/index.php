<?php
include_once('system/common.php');
include_once('includes/classes/Post.class.php');

//header
include('includes/header.php');



$posts = Post::allPostsWithLimit(5); //skapar en lista med Post instanser med alla posts GG
?>
    <h1>Blogginlägg</h1>

</div>
    </section>

<main >
    
    <?php
    //visa sidemenu
    include('includes/sidemenu.php');

    //visa alla Posts
    foreach($posts as $post) {
    ?>
        <article>

        <h2><?= $post->title; ?></h2>

        <p class="crebyp">Skapad <?= $post->created; ?> </p>
        <div class="by">
            <p>Av:: </p>
            <p class="username"> <?= $post->getUser()->username;?> </p>
        </div>
 
        <p><?= $post->content; ?></p>
        </article>
    <?php
    }

?>

</main>
<?php
//footer
include('includes/footer.php');
?>