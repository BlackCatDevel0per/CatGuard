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


class MemberArgument extends Argument
{
	const NAME = 'member';


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

		if( count($args) < 3 or !in_array($args[0], ['add', 'remove']) )
		{
			$sender->sendMessage($main->getValue('member_help'));
			return FALSE;
		}

		$region = $main->getRegionByName($args[1]);

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

		$member = $args[2];

		if( $args[0] == 'add' )
		{
			if( in_array($member, $region->getMemberList()) )
			{
				$sender->sendMessage($main->getValue('player_already_member'));
				return FALSE;
			}

			$region->addMember($member);
			$sender->sendMessage(str_replace('{player}', $member, $main->getValue('member_add')));
		}

		else
		{
			if( !in_array($member, $region->getMemberList()) )
			{
				$sender->sendMessage($main->getValue('player_not_exist'));
				return FALSE;
			}

			$region->removeMember($member);
			$sender->sendMessage(str_replace('{player}', $member, $main->getValue('rm_member')));
		}

		return TRUE;
	}
}