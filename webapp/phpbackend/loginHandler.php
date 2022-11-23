<?php
include_once ('backendSettings.php');
include_once ('authenticationHandler.php');
include_once ('mysqlHandler.php');


class loginHandler
{
    private mysqlHandler $mysqlHandler;

    private authenticationHandler $authenticationHandler;

    private bool $handlerReady = false;

    public function startLoginHandler() : void
    {
        //$this->mysqlHandler->setMySQLCredentials();
        $this->mysqlHandler = new mysqlHandler();
        $this->mysqlHandler->openMySQL();

        //$this->authenticationHandler = new authenticationHandler();
        $this->handlerReady = true;
    }

    public function closeLoginHandler() : void
    {
        $this->mysqlHandler->closeMySQL();
        $this->authenticationHandler->closeShortSession();
        //TODO: properly dispose auth handler
        $this->handlerReady = false;
    }

    public function isInitialized() : bool
    {
        return $this->handlerReady;
    }

    public function login(string $username, string $password) : array
    {
//        $this->authenticationHandler->initShortSession();

        $qUsername = $this->mysqlHandler->mysqlEscapeString($username);
        $qPassword = $this->mysqlHandler->mysqlEscapeString($password);

        $mQuery = "SELECT * FROM users WHERE username='$qUsername' AND password='$qPassword' LIMIT 1";

        $query = $this->mysqlHandler->mysqlQuery($mQuery);
        if($query->num_rows===1)
        {
            $qRow = $query->fetch_assoc();
            if($qRow["username"] === $qUsername)
            {
                //$this->authenticationHandler->authenticateShortSession($qRow['username'], $qRow['role']);
                return array(true,$qRow['username'],$qRow['role']);
            }
        }

        return array(false,"","");
    }
}