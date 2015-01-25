<?php

/*
	WildPHP - a modular and easily extendable IRC bot written in PHP
	Copyright (C) 2015 WildPHP

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace WildPHP\Core;

/**
 * The main bot class. Creates a single bot instance.
 */
class Bot
{
	
	protected $configuration;
	protected $moduleManager;
	protected $connection;

	/**
	 * @param string $config_file Optionally load a custom config file
	 */
	public function __construct($config_file = WPHP_CONFIG)
	{
		// Load the configuration in memory.
		$this->configuration = new Configuration($config_file);
		
		// And fire up any existing modules.
		$this->moduleManager = new ModuleManager();
		
		// Set up a connection.
		$this->connection = new ConnectionManager();
		
		// For that, we need to set the connection parameters.
		// First up, server.
		$this->connection->setServer($this->configuration->get('server'));
		$this->connection->setPort($this->configuration->get('port'));
		
		// Then we insert the details for the bot.
		$this->connection->setNick($this->configuration->get('nick'));
		$this->connection->setName($this->configuration->get('nick'));
		
		// Optionally, a password, too.
		$this->connection->setPassword($this->configuration->get('password'));
		
		// And start the connection.
		$this->connection->connect();
		
		// Now let the main loop take over.
		$this->start();
	}
	
	public function start()
	{
		do
		{
			$data = $this->connection->getData();
			echo $data . PHP_EOL;
		}
		while ($this->connection->isConnected());
	}
}