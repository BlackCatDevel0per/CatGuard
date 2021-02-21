<?php namespace cat\guard\command\argument;

 #  _   _       _   _           _____             
 # | \ | |     | | (_)         |  __ \            
 # |  \| | __ _| |_ ___   _____| |  | | _____   __
 # | . ` |/ _` | __| \ \ / / _ \ |  | |/ _ \ \ / /
 # | |\  | (_| | |_| |\ V /  __/ |__| |  __/\ V / 
 # |_| \_|\__,_|\__|_| \_/ \___|_____/ \___| \_/  
 # Больше плагинов в https://vk.com/native_dev
 # По вопросам native.dev@mail.ru
 # Плагин основан на https://bit.ly/3pp6Krw

use cat\guard\Manager;


use pocketmine\Player;


abstract class Argument
{
	const NAME = '';


	/**
	 * @var Manager
	 */
	private $main;


	/**
	 * @param Manager $main
	 */
	function __construct( Manager $main )
	{
		$this->main = $main;
	}


	/**
	 * @return string
	 */
	function getName( )
	{
		return static::NAME;
	}


	/**
	 * @return Manager
	 */
	function getManager( )
	{
		return $this->main;
	}


	/**
	 *                                          _
	 *   __ _ _ ____ _ _   _ _ __ _   ___ _ ___| |_
	 *  / _' | '_/ _' | | | | '  ' \ / _ \ '_ \   _\
	 * | (_) | || (_) | |_| | || || |  __/ | | | |_
	 *  \__,_|_| \__, |\___/|_||_||_|\___|_| |_|\__\
	 *           /___/
	 *
	 * @param  Player   $sender
	 * @param  string[] $args
	 *
	 * @return bool
	 */
	abstract function execute( Player $sender, array $args ): bool;
}