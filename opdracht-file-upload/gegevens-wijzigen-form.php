<?php

    session_start();

    function relocate( $url )
    {
        header('location: ' . $url );
    }

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    if ( isset($_SESSION['registration']['email']))
    {
        $email = $_SESSION['registration']['email'];
    }else
    {
        $email = '';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
    
    $message    =   false;

    if ( Message::hasMessage() )
    {
        $message = Message::getMessage();

        Message::remove();
    }

    $db = new PDO('mysql:host=localhost;dbname=opdracht_file_upload', 'root', ''); // Connectie maken

    $databaseWrapper    =   new Database( $db );

    $user = new User( $databaseWrapper );

    if ( !$user->validate() )
    {
        new Message( "U moet eerst inloggen", "error" );
        relocate("gegevens-wijzigen-form.php");
    }
    
    $email = $_SESSION['registration']['email'];
    
    var_dump($_SESSION);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>opdraht file upload</title>
        <style>
            html
            {
                font-family:sans-serif;
            }


            .modal
            {
                margin:5px 0px;
                padding:5px;
                border-radius:5px;
            }
            
            .success
            {
                color:#468847;
                background-color:#dff0d8;
                border:1px solid #d6e9c6;
            }
            
            .error
            {
                color:#b94a48;
                background-color:#f2dede;
                border:1px solid #eed3d7;
            }
            
            .warning
            {
                color:#3a87ad;
                background-color:#d9edf7;
                border:1px solid #bce8f1;
            }

            label img
            {
                max-width:300px;
                display:block;
            }

        </style>
    </head>
    <body>

    <p><a href="<?= HOST ?>file-upload-dashboard.php">Dashboard</a> | Ingelogd als <?= $user->getEmail() ?> | <a href="<?= HOST ?>file-upload-logout-process.php">uitloggen</a></p>

    <?php if ( $message ): ?>
        <div class="modal <?= $message['type'] ?>">
            <?= $message['text'] ?>
        </div>
    <?php endif ?>

    <h1>Gegevens</h1>

    <form action="<?= HOST ?>file-upload-gegevens-process.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="profilePicture">
                    profielfoto</label>
                    <img src="<?= HOST ?>img/<?= ( $user->getProfilePicture() !== '' ) ? $user->getProfilePicture() : 'profile-placeholder.gif' ?>" alt="">
                <input type="file" id="profilePicture" name="profilePicture">
            </li>
            <li>
                <label for="email">e-mail</label>
                <input type="text" id="email" name="email" value="<?= $email ?>">
            </li>
        </ul>
        <input type="submit" value="Wijzigen" name="submit">
    </form>

    
    </body>
</html>