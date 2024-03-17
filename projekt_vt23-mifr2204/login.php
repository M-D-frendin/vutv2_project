<?php
include_once('system/common.php');
include_once('includes/classes/User.class.php');

//header & sidemenu
include('includes/header.php');


//om formulär är postat, försök logga in
if(isset($_POST['username']) && isset($_POST['password'])) {

    try {
        $user = User::tryLogin($_POST['username'], $_POST['password']);
        header("Location: ./index.php");
        die();
    } catch (Exception $e) {
        $message = '<div class="alert">' . $e->getMessage() . '</div>';
    }
}


//om sidan har ?action=logout, visa meddelande att användaren har loggat ut 
if (isset($_REQUEST['action']) && $_REQUEST['action'] === 'logout') {
    echo '<div class="status">✔️ Du har nu loggat ut.</div>';
}
?>
  <h1>Logga in</h1>

</div>
    </section>

<main id="loginmain">
<?php
include('includes/sidemenu.php');
?>
    <form id="loginform" action="./login.php" method="post">
        <div class="form-field">
            <label for="username">Användarnamn</label>
            <input type="text" name="username" id="username" />
        </div>
        <div class="form-field">
            <label for="password">Lösenord</label>
            <input type="password" name="password" id="password" />
        </div>
        <?php
            //dynamiskt meddelande
            if(isset($message)) {
                echo $message;
            }
        ?>
        <div class="form-field">
            <input type="submit" value="Logga in" />
        </div>

        <div class="form-field">
            <p>Har du inget konto? Skapa ett <a href="./newuser.php">HÄR</a></p>
        </div>
    </form>
</main>
<?php
//footer
include('includes/footer.php');
?>