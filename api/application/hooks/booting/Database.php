<?php
/**
 * @package Codeigniter
 * @subpackage Database
 * @category Hook
 * @author Agung Dirgantara <agungmasda29@gmail.com>
 */

namespace Booting;

require_once(BASEPATH.'database/DB.php');

class Database
{
	/**
	 * Check database connection
	 */
	public function connection($group = ACTIVE_DATABASE_GROUP)
	{
		log_message('info','Check the database connection in from hook');

		if (!file_exists($database_config = APPPATH.'config/'.ENVIRONMENT.'/database.php') && !file_exists($database_config = APPPATH.'config/database.php'))
		{
			show_error('The configuration file database.php does not exist.');
		}

		include ($database_config);

		if (!isset($db[$group]))
		{
			if (!is_cli())
			{
				show_error('No active group database.');
				log_message('No active group database.');
			}
			else
			{
				log_message('error','Database connection failed');
				echo 'Database connection failed'.PHP_EOL;
			}
		}
		else
		{
			if (class_exists('\Illuminate\Database\Capsule\Manager'))
			{
				// initialize Eloquent ORM
				$capsule = new \Illuminate\Database\Capsule\Manager;

				foreach ($db as $db_group => $config)
				{
					// SQLITE DB
					if (preg_match('/sqlite/', $config['dbdriver']))
			        {
			            $capsule->addConnection([
			                'driver'    => 'sqlite',
			                'database'  => $config['database'],
			                'prefix'    => $config['dbprefix']
			            ],$db_group);
			        }
			        // MySQL or Other DB
			        else
			        {
			            $capsule->addConnection([
			                'driver'    => (preg_match('/mysql/',$config['dbdriver']))?'mysql':$config['dbdriver'],
			                'host'      => $config['hostname'],
			                'database'  => $config['database'],
			                'username'  => $config['username'],
			                'password'  => $config['password'],
			                'charset'   => $config['char_set'],
			                'collation' => $config['dbcollat'],
			                'prefix'    => $config['dbprefix']
			            ],$db_group);
			        }
				}

				$capsule->setAsGlobal();
				$capsule->bootEloquent();

				if (!preg_match('/sqlite/', $db[$group]['dbdriver']))
				{
					try
					{
						$capsule->getConnection($group)->getPdo();
						$GLOBALS['database_initialized'] = TRUE;

						log_message('info','Database connection success');
					}
					catch (\Exception $e)
					{
						$GLOBALS['database_initialized'] = FALSE;

						if (!is_cli())
						{
							show_error('Eloquent initialize database error in hook.');
							log_message('Eloquent initialize database error in hook.');
						}
						else
						{
							log_message('error','Database connection failed');
							echo 'Database connection failed'.PHP_EOL;
						}
					}
				}
				else
				{
					DB($group);
					try
					{
						$capsule->getConnection($group)->getPdo();
						$GLOBALS['database_initialized'] = TRUE;

						log_message('info','Database connection success');
					}
					catch (\Exception $e)
					{
						$GLOBALS['database_initialized'] = FALSE;

						if (!is_cli())
						{
							show_error('Eloquent initialize database error in hook.');
							log_message('Eloquent initialize database error in hook.');
						}
						else
						{
							log_message('error','Database connection failed');
							echo 'Database connection failed'.PHP_EOL;
						}
					}
					log_message('info','Database using SQLITE');
				}
			}
			else
			{
				DB($group);
				log_message('info','Database initialized by Codeigniter');
			}
		}
	}

	/**
	 * Load models
	 */
	public function models()
	{
		if (class_exists('\Illuminate\Database\Capsule\Manager'))
		{
			require_once(FCPATH.'../application/core/Eloquent_Model.php');

			foreach (ELOQUENT_MODEL_LOCATIONS as $location)
			{
				$this->require_eloquent_models($location);
			}

			log_message('info','Load eloquent model');
		}
	}

	/**
	 * Installation system database
	 */
	public function system()
	{
		$ci =& get_instance();
		$ci->load->model('_installation/System_tables');
		$ci->load->helper('database');
		db_install_tables('model', '_installation/System_tables', 'system');
	}

	/**
	 * Load file model
	 * 
	 * @param  string  $dir
	 * @param  integer $depth
	 */
	private function require_eloquent_models($dir, $depth = 1)
	{
		$scan = glob("$dir/*");

		foreach ($scan as $path)
		{
			if (preg_match('/\.php$/', $path))
			{
				require_once($path);
			}
			elseif (is_dir($path))
			{
				$this->require_eloquent_models($path, $depth+1);
			}
		}
	}
}

/* End of file Database.php */
/* Location : ./application/hooks/booting/Database.php */