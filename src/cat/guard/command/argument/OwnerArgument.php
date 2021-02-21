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


use pocketmine\level\Position;
use pocketmine\Player;


class OwnerArgument extends Argument
{
	const NAME = 'owner';


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

		if( count($args) < 2 )
		{
			$sender->sendMessage($main->getValue('owner_help'));
			return FALSE;
		}

		$region = $main->getRegionByName($args[0]);

		if( !isset($region) )
		{
			$sender->sendMessage($main->getValue('rg_not_exist'));
			return FALSE;
		}

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

		$owner = $args[1];

		if( !isset($owner) )
		{
			$sender->sendMessage($main->getValue('owner_help'));
			return FALSE;
		}

		$player = $main->getServer()->getPlayerExact($owner);

		if( !($player instanceof Player) )
		{
			$sender->sendMessage($main->getValue('player_not_exist'));
			return FALSE;
		}

		$val = $main->getGroupValue($player);

		if( count($main->getRegionList($owner)) > $val['max_count'] )
		{
			$sender->sendMessage(str_replace('{max_count}', $val['max_count'], $main->getValue('rg_maxcount')));
			return FALSE;
		}

		$region->setOwner($owner);
		$region->addMember($nick);

		$sender->sendMessage(str_replace(['{player}', '{region}'], [$owner, $args[0]], $main->getValue('owner_change')));
		$player->sendMessage(str_replace(['{player}', '{region}'], [$nick,  $args[0]], $main->getValue('owner_got_region')));
		return TRUE;
	}
}