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

use pocketmine\event\plugin\PluginEvent;


class FlagCheckEvent extends RegionEvent
{
	/**
	 * @var string
	 */
	private $flag;

	/**
	 * @var bool
	 */
	private $need_cancel = FALSE;


	/**
	 * @param Manager $main
	 * @param Region  $region
	 * @param string  $flag
	 */
	function __construct( Manager $main, Region $region, string $flag )
	{
		parent::__construct($main, $region);

		$this->flag = strtolower($flag);
	}


	/**
	 *                        _
	 *   _____    _____ _ __ | |__
	 *  / _ \ \  / / _ \ '_ \|  _/
	 * |  __/\ \/ /  __/ | | | |_
	 *  \___/ \__/ \___|_| |_|\__\
	 *
	 *
	 * @return string
	 */
	function getFlag( )
	{
		return $this->flag;
	}


	/**
	 * @return bool
	 */
	function isMainEventCancelled( )
	{
		return $this->need_cancel;
	}


	/**
	 * @param bool $value
	 */
	function setMainEventCancelled( bool $value = TRUE )
	{
		$this->need_cancel = $value;
	}
}