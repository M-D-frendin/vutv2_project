<?php
include_once('system/common.php');
include_once('includes/classes/Post.class.php');
include_once('includes/classes/User.class.php');

//header & sidemenu
include('includes/header.php');
include('includes/sidemenu.php');

//inloggad användare
$loggedInUser = User::getLoggedInUser();

//aktuell sida för pagination, 1 som standard
$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}

//antal rader per sida, 50 som standard
$pagesize = 1;
if (isset($_GET['pagesize'])) {
    $pagesize = intval($_GET['pagesize']);
}

//användare att hämta Posts från, id från $_GET eller inloggad användare om id från $_GET inte existerar
if (isset($_GET['userid'])) {
    $user = User::getUnique(intval($_GET['userid']));
} else {
    $user = User::getLoggedInUser();
}

//hämta alla Posts från vald användare
$posts = $user->getPosts($page, $pagesize);
?>
<table class="table">
    <thead>
        <th>
            Titel
        </th>
        <th>
            Skapad
        </th>
        <th>
            Innehåll
        </th>
        <th></th>
    </thead>
    <tbody>
<?php
foreach($posts as $post) {
    ?>

<tr>
    <td>
        <?= mb_strimwidth($post->title, 0, 50, "..."); ?>
    </td>
    <td>
        <?= $post->created; ?>
    </td>
    <td>
        <?= mb_strimwidth($post->content, 0, 50, "..."); ?>
    </td>
    <td>
        <a class="readbtn" href="./posts.php?id=<?= $post->id; ?>">Läs mer</a>
        <?php
        if ($loggedInUser->id === $user->id)
        {
        ?>
        |
        <a class="changebtn" href="./changePost.php?id=<?= $post->id; ?>">Ändra</a>
        <?php
        }
        ?>
    </td>
</tr>
    
    <?php
}

?>
    </tbody>
</table>


<ul class="pagination">
<?php
//pagination - visa navigation för pages
$numberOfPages = Post::postPagesByUserId($user->id, $pagesize);
echo '<li><a href="?page=1">|<</a></li>';
for ($i = 1; $i <= $numberOfPages; $i++) {
    echo '<li>';
    $class = '';
    if ($i == $page) {
        $class = 'current';
    }
    echo '<a href="?page=' . $i . '" class="' . $class . '">' . $i . '</a>';
    echo '</li>';
}
echo '<li><a href="?page=' . $numberOfPages . '">>|</a></li>';
?>
</ul>


<?php
//footer
include('includes/footer.php');
?>