<?php 
	
	namespace X\Sys;

	class DB extends \PDO
	{
		static $instance;

		public function __construct()
		{
			//recuperar configuracion de config.json
			$config = Registry::getInstance();
			$dbconf=(array)$config->dbconf;
			$dsn = $dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];;
			$usr = $dbconf['dbuser'];
			$pass = $dbconf['dbpass'];
			try
			{
				parent::__construct($dsn,$usr,$pass);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		static function singleton()
		{
			if(!(self::$instance instanceof self))
			{
				self::$instance=new self();

			}
				return self::$instance;
			
		}
	}