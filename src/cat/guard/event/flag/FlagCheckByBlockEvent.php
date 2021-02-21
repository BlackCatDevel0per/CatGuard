<?php namespace cat\guard\event\flag;


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
use cat\guard\data\Region;
use cat\guard\event\RegionEvent;

use pocketmine\event\Cancellable;
use pocketmine\block\Block;
use pocketmine\Player;


class FlagCheckByBlockEvent extends FlagCheckEvent implements Cancellable
{
	static $handlerList = null;


	/**
	 * @var Block
	 */
	private $block;

	/**
	 * @var Player
	 */
	private $player;


	/**
	 *                        _
	 *   _____    _____ _ __ | |__
	 *  / _ \ \  / / _ \ '_ \|  _/
	 * |  __/\ \/ /  __/ | | | |_
	 *  \___/ \__/ \___|_| |_|\__\
	 *
	 *
	 * @param Manager $main
	 * @param Region  $region
	 * @param string  $flag
	 * @param Block   $block
	 * @param Player  $player
	 */
	function __construct( Manager $main, Region $region, string $flag, Block $block, Player $player = NULL )
	{
		parent::__construct($main, $region, $flag);

		$this->block  = $block;
		$this->player = $player;
	}


	/**
	 * @return Block
	 */
	function getBlock( )
	{
		return $this->block;
	}


	/**
	 * @return Player
	 */
	function getPlayer( )
	{
		return $this->player;
	}
}