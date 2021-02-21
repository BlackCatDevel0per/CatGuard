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

use cat\guard\command\argument\Argument;


use pocketmine\item\Item;
use pocketmine\Player;


class ListArgument extends Argument
{
	const NAME = 'list';


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
	function execute( Player $sender, array $args ): bool
	{
		$main = $this->getManager();
		$list = $main->getRegionList($sender->getName());

		if( count($list) < 1 )
		{
			$sender->sendMessage($main->getValue('list_empty'));
			return TRUE;
		}

		$name = [];

		foreach( $list as $region )
		{
			$name[] = $region->getRegionName();
		}

		$message = $main->getValue('list_success');
		$message = str_replace('{list}', implode(', ', $name), $message);

		$sender->sendMessage($message);
		return TRUE;
	}
}