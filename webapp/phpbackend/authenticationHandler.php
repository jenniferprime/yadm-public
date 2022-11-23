<?php

include_once ('../phpfrontendhandlers/presentation-common.php');

class authenticationHandler
{
    private bool $shortSessionReady = false;

    private bool $shortSessionAuthenticated = false;

    public function initShortSession() : void
    {
        if($this->shortSessionReady) { return; }
        session_start();
        $this->shortSessionReady = true;
        //TODO: make a better check
        if(isset($_SESSION) && isset($_SESSION['sUsername']) && isset($_SESSION['sRole']))
        {
            $this->shortSessionAuthenticated = true;
            return;
        }
        $this->shortSessionAuthenticated = false;
    }

    public function closeShortSession() : void
    {
        if($this->shortSessionReady) {
            session_abort();//TODO: check if this is the correct function
            $this->shortSessionReady = false;
            $this->shortSessionAuthenticated = false;
        }
    }

    public function clearShortSession() : void
    {
        if(true) {
            $_SESSION['sUsername'] = "zero";
            $_SESSION['sRole'] = "zero";

            unset($_SESSION['sUsername']);
            unset($_SESSION['sRole']);

            session_unset();
            $this->shortSessionReady = false;
            $this->shortSessionAuthenticated = false;
        }
    }

    public function isShortSessionReady() : bool
    {
        return $this->shortSessionReady;
    }

    public function checkAuthenticationStatus() : bool
    {
        return $this->shortSessionAuthenticated;
    }

    public function authenticateShortSession(string $username, string $role) : void
    {
        if(!$this->shortSessionReady) { return; }
        $_SESSION['sUsername'] = $username;
        $_SESSION['sStatus'] = 1;
        $_SESSION['sRole'] = $role;
        $this->shortSessionAuthenticated = true;
    }

    public function getUsername() : string {
        if($this->shortSessionAuthenticated) { return $_SESSION['sUsername'];}
        return "";
    }

    public function getRole() : string {
        if($this->shortSessionAuthenticated) { return $_SESSION['sRole'];}
        return "";
    }

    public function authorizePage($minimumRole) : bool {
        if( $this->getRole() == $minimumRole)
        {
            return true;
        }

        //header('Location: '.getSubPageURL("Login"));
        die("401" . $this->getRole());
    }
}

//TODO: check for possible mixups between shortSessionReady and shortSessionAuthenticated