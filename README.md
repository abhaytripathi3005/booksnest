# Project Name: booksnest
# Description: Browse and filter through a collection of fascinating books!


<--------------- ***********Installation Steps************------------>

*************In This Project Config files like config.php & database.php are available but In case project is running in more than 1 Environment then these files can be added in .gitignore file***************

#Step 1: Change base URL in application/config/config.php From `$config['base_url'] = 'http://localhost/booksnest';` to `$config['base_url'] = '[Your URL/Path to Project]';`

#Step 2: If Using database then update your DB cred in application/config/database.php
		If Don't see database.php file then create one and paste this code with your updated DB creds
		<?php
			defined('BASEPATH') OR exit('No direct script access allowed');

			$active_group = 'default';
			$query_builder = TRUE;

			$db['default'] = array(
				'dsn'	=> '',
				'hostname' => 'localhost',
				'username' => '',
				'password' => '',
				'database' => '',
				'dbdriver' => 'mysqli',
				'dbprefix' => '',
				'pconnect' => FALSE,
				'db_debug' => (ENVIRONMENT !== 'production'),
				'cache_on' => FALSE,
				'cachedir' => '',
				'char_set' => 'utf8',
				'dbcollat' => 'utf8_general_ci',
				'swap_pre' => '',
				'encrypt' => FALSE,
				'compress' => FALSE,
				'stricton' => FALSE,
				'failover' => array(),
				'save_queries' => TRUE
			);

		?>



# How to Access the Website?
Website can be accessed by: 
		`http://localhost/booksnest` 
                    OR 
		URL mentioned in application/config/config.php 
		`$config['base_url'] = Your_base_url`


