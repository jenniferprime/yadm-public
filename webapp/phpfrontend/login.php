<?php

//    ini_set("display_errors", 1);

    include_once ('../phpfrontendhandlers/presentation-settings.php');
    include_once ('../phpfrontendhandlers/presentation-common.php');

    include_once ('../phpbackend/mysqlHandler.php');
    include_once ('../phpbackend/authenticationHandler.php');


    $postUsername = "";
    $postPassword = "";

    $loginState = "";
    $username = "";

    $authenticationHandler = new authenticationHandler();
    $authenticationHandler->initShortSession();

    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        $postUsername = $_POST['postUsername'];
        $postPassword = $_POST['postPassword'];

        include_once ('../phpbackend/loginHandler.php');
        $loginHandler = new loginHandler();
        $loginHandler->startLoginHandler();
        list($success, $username, $role) = $loginHandler->login($postUsername, $postPassword);
        if($success)
        {
            $authenticationHandler->authenticateShortSession($postUsername, $role);
            $loginState = "logged in as $username";
            header('Location: '.getSubPageURL("Dashboard"));
        }
        else {
            $loginState = "login failed";
        }
    }
    else if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['a']) && $_GET['a'] == "logout") {
        $authenticationHandler->clearShortSession();
        $authenticationHandler->closeShortSession();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - yaDM</title>
    <link rel="stylesheet" href="../style/style-common.css">
    <link rel="stylesheet" href="../style/style-desktop.css">
    <link rel="stylesheet" href="../style/style-minimaterial.css">
</head>
<body class="yadm-login-body">
    <?=generateHeader("login", $username);?>

    <main class="yadm-main yadm-main-darktransparent">

        <div class="yadm-login-container">

            <form action="login.php" method="post">

                <h1>Login - yaDM</h1>
                <h2><?=$loginState?></h2>

                <div class="material-form-field-container">
                    <div class="material-text-container" id="material-input-password"> <label class="material-textbox-label" for="postUsername">Username</label><input class="material-input-element material-textbox" type="text" placeholder="text" name="postUsername" id="postUsername" required value="<?=$postUsername?>" autofocus="autofocus" autocomplete="username"><hr /></div>
                    <div class="material-text-container" id="material-input-username"> <label class="material-textbox-label" for="postPassword">Password</label><input class="material-input-element material-textbox" type="password" placeholder="text" name="postPassword" id="postPassword" required autocomplete="current-password"><hr /></div>
                    <div class="material-input-container material-button-container" id="material-input-submit"><input class="material-input-element material-textbox" type="submit" value="login"></div>
                </div>

            </form>

        </div>

    </main>

    <?=generateCredits()?>

</body>
</html>
