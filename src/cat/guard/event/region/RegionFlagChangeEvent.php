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


class RegionFlagChangeEvent extends RegionEvent implements Cancellable
{
	static $handlerList = null;


	/**
	 * @var string
	 */
	private $owner;

	/**
	 * @var string
	 */
	private $flag;

	/**
	 * @var bool
	 */
	private $new_value;


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
	 * @param bool    $value
	 */
	function __construct( Manager $main, Region $region, string $flag, bool $value )
	{
		parent::__construct($main, $region);

		$this->flag      = strtolower($flag);
		$this->new_value = $value;
	}


	/**
	 * @return string
	 */
	function getFlag( )
	{
		return $this->flag;
	}


	/**
	 * @return bool
	 */
	function getOldValue( )
	{
		return !$this->getNewValue();
	}


	/**
	 * @return bool
	 */
	function getNewValue( )
	{
		return $this->new_value;
	}
}