<?php
// Namespace
namespace Command;

/**
 * Parts the specified channel.
 * arguments[0] == Channel to part.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Super3 <admin@wildphp.com>
 */
class Part extends \Library\IRC\Command\Base {
	/**
	 * The command's help text.
	 *
	 * @var string
	 */
	protected $help = 'Make the bot leave a channel.';
	 
	/**
	 * How to use the command.
	 *
	 * @var string
	 */
	protected $usage = 'part [#channel]';

	/**
	 * The number of arguments the command needs.
	 *
	 * You have to define this in the command.
	 *
	 * @var integer
	 */
	protected $numberOfArguments = 1;
	
	/**
	 * Verify the user before executing this command.
	 *
	 * @var bool
	 */
	protected $verify = true;

	/**
	 * Parts the specified channel.
	 *
	 * IRC-Syntax: JOIN [#channel]
	 */
	public function command() {
		$this->connection->sendData('PART '.$this->arguments[0]);
	}
}
