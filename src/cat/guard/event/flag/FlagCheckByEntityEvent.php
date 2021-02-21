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
use pocketmine\entity\Entity;


class FlagCheckByEntityEvent extends FlagCheckEvent implements Cancellable
{
	static $handlerList = null;


	/**
	 * @var Entity
	 */
	private $entity;

	/**
	 * @var Entity
	 */
	private $target;


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
	 * @param Entity  $entity
	 * @param Entity  $target
	 */
	function __construct( Manager $main, Region $region, string $flag, Entity $entity, Entity $target = NULL )
	{
		parent::__construct($main, $region, $flag);

		$this->entity = $entity;
		$this->target = $target;
	}


	/**
	 * @return Entity
	 */
	function getEntity( )
	{
		return $this->entity;
	}


	/**
	 * @return Entity
	 */
	function getTarget( )
	{
		return $this->target;
	}
}