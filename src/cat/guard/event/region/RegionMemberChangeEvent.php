<?php namespace cat\guard\event\region;


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


class RegionMemberChangeEvent extends RegionEvent implements Cancellable
{
	const TYPE_ADD    = 0;
	const TYPE_REMOVE = 1;


	static $handlerList = null;


	/**
	 * @var string
	 */
	private $member;

	/**
	 * @var int
	 */
	private $type;


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
	 * @param string  $member
	 * @param int     $type
	 */
	function __construct( Manager $main, Region $region, string $member, int $type )
	{
		parent::__construct($main, $region);

		$this->member = strtolower($member);
		$this->type   = $type == self::TYPE_ADD ? self::TYPE_ADD : self::TYPE_REMOVE;
	}


	/**
	 * @return string
	 */
	function getMember( )
	{
		return $this->member;
	}


	/**
	 * @return int
	 */
	function getType( )
	{
		return $this->type;
	}
}