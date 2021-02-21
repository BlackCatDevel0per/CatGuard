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


use pocketmine\Player;


class FlagArgument extends Argument
{
	const NAME = 'flag';


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
		$nick = strtolower($sender->getName());
		$main = $this->getManager();
		$list = $main->getAllowedFlag();

		if( count($args) < 2 )
		{
			$sender->sendMessage(str_replace('{flag_list}', implode(' ', $list), $main->getValue('flag_help')));
			return FALSE;
		}

		$region = $main->getRegionByName($args[0]);

		if( !isset($region) )
		{
			$sender->sendMessage($main->getValue('rg_not_exist'));
			return FALSE;
		}

		if( $region->getOwner() != $nick and !$sender->hasPermission('catguard.all') )
		{
			$sender->sendMessage($main->getValue('player_not_owner'));
			return FALSE;
		}

		$flag = $args[1];

		if( !in_array($flag, $list) )
		{
			$sender->sendMessage($main->getValue('flag_not_exist'));
			return FALSE;
		}

		if( $region->getFlagValue($flag) )
		{
			$region->setFlag($flag, FALSE);
			$sender->sendMessage(str_replace('{flag}', $flag, $main->getValue('flag_off')));
		}

		else
		{
			$region->setFlag($flag, TRUE);
			$sender->sendMessage(str_replace('{flag}', $flag, $main->getValue('flag_on')));
		}

		return TRUE;
	}
}