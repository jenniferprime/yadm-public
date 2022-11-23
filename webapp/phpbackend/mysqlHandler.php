<?php
include_once ('backendSettings.php');
class mysqlHandler
{
    /* Config: credentials */
    protected string $mysqlServer = "127.0.0.1";
    protected string $mysqlUsername = "yadm-dev";
    protected string $mysqlPassword = "yadm";
    protected string $mysqlDatabase = "yadm-dev";

    /* Includes */


    /* locals */
    private bool $mysqlInitialized = false;

    private mysqli $mysqlConnection;

    /* connection handling */
    public function setMySQLCredentials($mysqlServer, $mysqlUsername, $mysqlPassword, $mysqlDatabase) : void
    {
        $this->mysqlServer = $mysqlServer;
        $this->mysqlUsername = $mysqlUsername;
        $this->mysqlPassword = $mysqlPassword;
        $this->mysqlDatabase = $mysqlDatabase;
    }

    public function openMySQL() : void
    {
        if(!$this->isInitialized())   {
            $this->mysqlConnection = new mysqli($this->mysqlServer, $this->mysqlUsername, $this->mysqlPassword, $this->mysqlDatabase);
            $this->mysqlConnection->set_charset('utf8mb4'); //this is the default cuz that's all I know

            if ($this->mysqlConnection->connect_error) {
                $this->mysqlInitialized = false;
                die();
            }
            $this->mysqlInitialized = true;
        }
    }

    public function closeMySQL() : void
    {
        if($this->isInitialized()) {
            unset($this->mysqlConnection);
            $this->mysqlInitialized = false;
        }
    }

    /* getters/setters */
    public function isInitialized() : bool
    {
        return $this->mysqlInitialized;
    }


    /* actual helpers */
    public function mysqlEscapeString(string $param) : string {
        if(!$this->mysqlInitialized) { return "null"; }
        return mysqli_real_escape_string($this->mysqlConnection, $param);
    }

    public function mysqlQuery(string $query) {
        if(!$this->mysqlInitialized) { return "null"; }
        $result = mysqli_query($this->mysqlConnection, $query);
        return $result;
    }

}