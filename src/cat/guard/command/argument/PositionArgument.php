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


class PositionArgument extends Argument
{
	const NAME = 'pos';


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
		
		if( count($args) < 1 )
		{
			$sender->sendMessage($main->getValue('pos_help'));
			return FALSE;
		}
		
		$pos = new Position(
			$sender->getFloorX(),
			$sender->getFloorY(),
			$sender->getFloorZ(),
			$sender->getLevel()
		);

		$region = $main->getRegion($pos);
		
		if( $region !== NULL and !$sender->hasPermission('catguard.all') )
		{
			if( $region->getOwner() != $nick )
			{
				$sender->sendMessage($main->getValue('rg_override'));
				return FALSE;
			}
		}
		
		if( $args[0] == '1' )
		{
			if( isset($main->position[1][$nick]) )
			{
				unset($main->position[1][$nick]);
			}
			
			$main->position[0][$nick] = $pos;
			
			$sender->sendMessage($main->getValue('pos_1_set'));
			return TRUE;
		}

		elseif( $args[0] == '2' )
		{
			if( !isset($main->position[0][$nick]) )
			{
				$sender->sendMessage($main->getValue('pos_help'));
				return FALSE;
			}
			
			if( $main->position[0][$nick]->getLevel()->getName() != $sender->getLevel()->getName() )
			{
				unset($main->position[0][$nick]);
				$sender->sendMessage($main->getValue('pos_another_world'));
				return FALSE;
			}
			
			$val  = $main->getGroupValue($sender);
			$size = $main->calculateSize($main->position[0][$nick], $pos);
			
			if( $size > $val['max_size'] and !$sender->hasPermission('catguard.all') )
			{
				$sender->sendMessage(str_replace('{max_size}', $val['max_size'], $main->getValue('rg_maxsize')));
				return FALSE;
			}
			
			$main->position[1][$nick] = $pos;
			
			$sender->sendMessage($main->getValue('pos_2_set'));
			return TRUE;
		}

		else
		{
			
			$sender->sendMessage($main->getValue('pos_help'));
			return FALSE;
		}
	}
}