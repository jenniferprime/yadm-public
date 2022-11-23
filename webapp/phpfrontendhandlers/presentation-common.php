<?php

    include_once ('presentation-settings.php');

    function getLoginIcon(bool $loggedIn) : string
    {
        return $loggedIn ? "logout" : "login";
    }

    function generateHeader(string $page, string $username = "") : string
    {

        $links_left = "";

        if($username) {
            $links_left .= generateNavLink("Dashboard", $page) . "\n";
            $links_left .= generateNavLink("Systems", $page) . "\n";
        }

        $login_icon = getLoginIcon($username > 0);
        if($username) { $login_icon = "logout";  $username = "<span class=\"yadm-nav-icon-description\">$username</span>" ;}

        $login_url = getLoginURL($username > 0);

        return <<< HEADEREND
<header class="yadm-nav-container">
    <nav class="yadm-nav">
        <ul class="yadm-nav-menu yadm-nav-menu-left">
            <li class="nav-menu-item nav-menu-textbtn"><a href="#">yaDM</a></li>
            $links_left
        </ul>
        <ul class="yadm-nav-menu yadm-nav-menu-right">
            <li class="nav-menu-item nav-menu-iconbtn"><a href="#"><span class="yadm-nav-icon">info</span></a></li>
            <li class="nav-menu-item nav-menu-iconbtn"><a href="$login_url">$username<span class="yadm-nav-icon">$login_icon</span></a></li>
        </ul>
    </nav>
</header>
HEADEREND;

    }

    function generateNavLink(string $pageButton, string $currentPage) : string
    {
        $pageURL = getSubPageURL($pageButton);
        $pageActive = "";
        if($pageButton === $currentPage) {$pageActive = " nav-menu-active"; }
        return <<< ENDLINK
<li class="nav-menu-item nav-menu-textbtn$pageActive"><a href="$pageURL">$pageButton</a></li>
ENDLINK;
    }

    function generateFooter() : string
    {
        return "not implemented";
    }

    function generateCredits() : string
    {
        //TODO: make dynamic
        return <<< ENDCREDITS
<span class="yadm-background-credit"><span>Image: Seashore Scenery</span> <span>Author: Greg</span> <span>https://www.pexels.com/photo/seashore-scenery-2418664</span></span>
ENDCREDITS;

    }

    function getLoginURL(bool $loggedIn) : string
    {
        return $loggedIn ? DOCUMENT_ROOT . "/login.php?a=logout" : DOCUMENT_ROOT . "/login.php";
    }

    function getSubPageURL(string $page) : string
    {
        //TODO: this is very ugly
        return match ($page) {
            "Dashboard" => DOCUMENT_ROOT . "/dash.php",
            "Systems" => DOCUMENT_ROOT . "/systems.php",
            "Login" => DOCUMENT_ROOT. "/login.php",
            default => DOCUMENT_ROOT . "/index.php",
        };
    }