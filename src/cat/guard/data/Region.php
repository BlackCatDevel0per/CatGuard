<?php namespace cat\guard\data;


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

use cat\guard\event\region\RegionLoadEvent;
use cat\guard\event\region\RegionSaveEvent;
use cat\guard\event\region\RegionFlagChangeEvent;
use cat\guard\event\region\RegionOwnerChangeEvent;
use cat\guard\event\region\RegionMemberChangeEvent;

use pocketmine\level\Level;
use pocketmine\Server;


class Region
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @todo convert $property.
	 *
	 * @var  mixed[]
	 */
	private $property = [];


	/**
	 * @todo  construct without array.
	 *
	 * @param string  $name
	 * @param mixed[] $data
	 */
	function __construct( string $name, array $data )
	{
		$this->name     = $name;
		$this->property = $data;

		$event = new RegionLoadEvent(Manager::getInstance(), $this);

		Server::getInstance()->getPluginManager()->callEvent($event);
	}


	/**
	 *                _
	 *  _ _____  __ _(_) ___  _ __
	 * | '_/ _ \/ _' | |/ _ \| '_ \
	 * | ||  __/ (_) | | (_) | | | |
	 * |_| \___\\__, |_|\___/|_| |_|
	 *          /___/
	 *
	 * @param string $nick
	 */
	function addMember( string $nick )
	{
		$event = new RegionMemberChangeEvent(Manager::getInstance(), $this, $nick, RegionMemberChangeEvent::TYPE_ADD);

		Server::getInstance()->getPluginManager()->callEvent($event);

		if( $event->isCancelled() )
		{
			return;
		}

		$nick = strtolower($nick);

		if( in_array($nick, $this->property['member']) )
		{
			return;
		}

		$this->property['member'][] = $nick;
		
		$this->save();
	}


	/**
	 * @param string $nick
	 */
	function removeMember( string $nick )
	{
		$event = new RegionMemberChangeEvent(Manager::getInstance(), $this, $nick, RegionMemberChangeEvent::TYPE_REMOVE);

		Server::getInstance()->getPluginManager()->callEvent($event);

		if( $event->isCancelled() )
		{
			return;
		}

		$key = array_search(strtolower($nick), $this->property['member']);
		
		unset($this->property['member'][$key]);
		$this->save();
	}


	/**
	 * @param string $nick
	 */
	function setOwner( string $nick )
	{
		$event = new RegionOwnerChangeEvent(Manager::getInstance(), $this, $this->property['owner'], $nick);

		Server::getInstance()->getPluginManager()->callEvent($event);

		if( $event->isCancelled() )
		{
			return;
		}

		$this->property['owner'] = strtolower($nick);
		
		$this->save();
	}


	/**
	 * @param  string $flag
	 * @param  bool   $value
	 */
	function setFlag( string $flag, bool $value )
	{
		$event = new RegionFlagChangeEvent(Manager::getInstance(), $this, $flag, $value);

		Server::getInstance()->getPluginManager()->callEvent($event);

		if( $event->isCancelled() )
		{
			return;
		}

		$flag = strtolower($flag);
		
		if( isset($this->property['flag'][$flag]) )
		{
			$this->property['flag'][$flag] = $value;
			
			$this->save();
		}
	}


	/**
	 * @return string
	 */
	function getRegionName( ): string
	{
		return strtolower($this->name);
	}


	/**
	 * @return string
	 */
	function getOwner( ): string
	{
		return strtolower($this->property['owner']);
	}


	/**
	 * @return string[]
	 */
	function getMemberList( ): array
	{
		return $this->property['member'];
	}


	/**
	 * @param  string $coord
	 *
	 * @return int
	 */
	function getMin( string $coord ): int
	{
		return $this->property['min'][strtolower($coord)] ?? 0;
	}


	/**
	 * @param  string $coord
	 *
	 * @return int
	 */
	function getMax( string $coord ): int
	{
		return $this->property['max'][strtolower($coord)] ?? 0;
	}


	/**
	 * @return Level | NULL
	 */
	function getLevel( )
	{
		return Server::getInstance()->getLevelByName($this->property['level']);
	}


	/**
	 * @return string
	 */
	function getLevelName( ): string
	{
		return $this->property['level'] ?? 'undefined';
	}


	/**
	 * @param  string $flag
	 *
	 * @return bool
	 */
	function getFlagValue( string $flag ): bool
	{
		$flag = strtolower($flag);

		return $this->property['flag'][$flag] ?? Manager::DEFAULT_FLAG[$flag] ?? FALSE;
	}


	/**
	 * @todo remove save() method.
	 */
	private function save( )
	{
		$event = new RegionSaveEvent(Manager::getInstance(), $this);

		Server::getInstance()->getPluginManager()->callEvent($event);

		if( $event->isCancelled() )
		{
			return;
		}

		Manager::getInstance()->saveRegion($this);
	}


	/**
	 * @return mixed[]
	 */
	function toData( ): array
	{
		return $this->property;
	}
}