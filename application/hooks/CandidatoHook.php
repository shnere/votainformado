<?php defined('BASEPATH') or die('No direct script access allowed');

class CandidatoHook{

    protected $fancy_url_name;
    protected $connection_method;
        
    protected $hostname;
    protected $username;
    protected $password;
    protected $database;

    public function __construct()
    {
        // Configure database connection
        include(APPPATH.'config/database'.EXT);
        $this->hostname = $db[$active_group]['hostname'];
        $this->username = $db[$active_group]['username'];
        $this->password = $db[$active_group]['password'];
        $this->database = $db[$active_group]['database'];
    }

    public function check_uri()
    {
		//revisar que la uri tenga dos segmentos ejemplo candidato/Josefina
		$request = explode('/',substr($_SERVER['REQUEST_URI'], 1));
		
		if (sizeof($request) == 2) {
			if( (strcmp( substr($_SERVER['REQUEST_URI'], 9) , 'candidato') )){
			
				// First, we need get the uri segment to inspect
				$request_uri = explode('/',substr($_SERVER['REQUEST_URI'], 1));
			
			
				$this->fancy_url_name = $request_uri[1];
				$this->connection_method = 'index';

				// Connect to database, and check the user table
				mysql_connect($this->hostname, $this->username, $this->password) AND mysql_select_db($this->database);
				$res = mysql_query("SELECT idCandidato, fancy_url FROM candidatos WHERE fancy_url='".$this->fancy_url_name."'");

				if ($row = mysql_fetch_object($res))
				{
					// If, there is a result, then we should modify server data
					// Below line means, we told CodeIgniter to load
					// 'User' controller on 'index', 'info' or any valid connection/method and we send 'id' parameter
					$_SERVER['REQUEST_URI'] = '/candidato/'.$this->connection_method.'/'.$row->idCandidato;
				}
				mysql_free_result($res);
			
			}
		}

    }
}