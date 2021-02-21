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


class RegionOwnerChangeEvent extends RegionEvent implements Cancellable
{
	static $handlerList = null;


	/**
	 * @var string
	 */
	private $old_owner;

	/**
	 * @var string
	 */
	private $new_owner;


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
	 * @param string  $old
	 * @param string  $new
	 */
	function __construct( Manager $main, Region $region, string $old, string $new )
	{
		parent::__construct($main, $region);

		$this->old_owner = strtolower($old);
		$this->new_owner = strtolower($new);
	}


	/**
	 * @return string
	 */
	function getOldOwner( )
	{
		return $this->old_owner;
	}


	/**
	 * @return string
	 */
	function getNewOwner( )
	{
		return $this->new_owner;
	}
}