<?php namespace cat\guard\event;


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

use pocketmine\event\plugin\PluginEvent;


class RegionEvent extends PluginEvent
{
	/**
	 * @var Region
	 */
	private $region;


	/**
	 * @param Manager $main
	 * @param Region  $region
	 */
	function __construct( Manager $main, Region $region )
	{
		parent::__construct($main);

		$this->region = $region;
	}


	/**
	 *                        _
	 *   _____    _____ _ __ | |__
	 *  / _ \ \  / / _ \ '_ \|  _/
	 * |  __/\ \/ /  __/ | | | |_
	 *  \___/ \__/ \___|_| |_|\__\
	 *
	 *
	 * @return Region
	 */
	function getRegion( )
	{
		return $this->region;
	}
}