<?php

    include_once ('../phpfrontendhandlers/presentation-settings.php');
    include_once ('../phpfrontendhandlers/presentation-common.php');

    include_once ('../phpbackend/mysqlHandler.php');
    include_once ('../phpbackend/authenticationHandler.php');

    $username = "";

    $authenticationHandler = new authenticationHandler();

    $authenticationHandler->initShortSession();

    $authed = $authenticationHandler->authorizePage('A');

    $username = $authenticationHandler->getUsername();
    $role = $authenticationHandler->getRole();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>yaDM</title>
    <link rel="stylesheet" href="../style/style-common.css">
    <link rel="stylesheet" href="../style/style-desktop.css">
    <link rel="stylesheet" href="../style/style-minimaterial.css">
    <script src="../script/presentation-script.js"></script>
</head>
<body>
<?=generateHeader("Dashboard", $username);?>

<main class="yadm-main">
    <div class="yadm-dash-header">
        <h1>yaDM</h1>
        <h2>Yet-Another-oh shit something fell on my keyboarD-Manager</h2>
        <h3>Version: 0.0.0f</h3>
        <h3><?="Logged in as $username, with role $role and permission $authed"?></h3>
    </div>
    <div class="yadm-dash-container yadm-dash-gauge-container">
        <div class="yadm-gauge yadm-gauge-bignumber">
            <span class="yadm-gauge-title">Online Systems</span>
            <span class="yadm-gauge-value">326</span>
        </div>

        <div class="yadm-gauge yadm-gauge-bignumber">
            <span class="yadm-gauge-title">Uptime</span>
            <span class="yadm-gauge-value">80%</span>
        </div>

        <div class="yadm-gauge yadm-gauge-roundbar">
            <span class="yadm-gauge-title">Raid Restore</span>
            <span class="yadm-gauge-value">80%</span>
        </div>

        <!--        <div class="yadm-gauge">-->

        <!--        </div>-->

        <!--        <div class="yadm-gauge">-->

        <!--        </div>-->

        <!--        <div class="yadm-gauge">-->

        <!--        </div>-->
    </div>

    <div class="yadm-dash-container yadm-dash-summary">
        <div class="yadm-table-container">
            <table class="yadm-table yadm-table-invisible">
                <thead>
                <tr>
                    <th colspan="2">yaDM Systems</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>foo</td>
                    <td>bar</td>
                </tr>
                <tr>
                    <td>foo</td>
                    <td>bar</td>
                </tr>
                <tr>
                    <td>foo</td>
                    <td>bar</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="yadm-dash-container yadm-dash-system-list">
        <div class="yadm-button-container"><input type="button" value="Systems" class="yadm-button yadm-button-righticon" onclick="showHideID('yadm-systemlist-container');"></div>
        <div class="yadm-dash-system-list-table-container" id="yadm-systemlist-container">
            <div class="yadm-table-container">
                <table class="yadm-table yadm-table-invisible">
                    <thead>
                    <tr>
                        <th colspan="2">yaDM Systems</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>foo</td>
                        <td>bar</td>
                    </tr>
                    <tr>
                        <td>foo</td>
                        <td>bar</td>
                    </tr>
                    <tr>
                        <td>foo</td>
                        <td>bar</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</body>
</html>
