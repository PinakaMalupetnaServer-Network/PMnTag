<?php

namespace PMnSTag;

use pocketmine\{
	Player,
	plugin\PluginBase,
	event\Listener,
	event\server\DataPacketReceiveEvent,
	network\mcpe\protocol\ServerSettingsRequestPacket,
	network\mcpe\protocol\ServerSettingsResponsePacket,
};;

class Main extends PluginBase implements Listener{
	
	private static $instance;
	
	public function onLoad(){
		self::$instance = $this;
	}
	public static function getInstance(){
		return self::$instance;
	}
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getScheduler()->scheduleRepeatingTask(new PMnSTag(), 20);
	}
	public function onPacketReceived(DataPacketReceiveEvent $event){
		if($event->getPacket() instanceof \pocketmine\network\mcpe\protocol\LoginPacket){
			if($event->getPacket()->clientData["DeviceOS"] !== null){
				$this->os[$event->getPacket()->username] = $event->getPacket()->clientData["DeviceOS"];
				$this->device[$event->getPacket()->username] = $event->getPacket()->clientData["DeviceModel"];
			}
		}
	}
	public function getUos(Player $player){
		if(!isset($this->os[$player->getName()])) return 404;
		if($this->os[$player->getName()] == null) return 404;
		$hirss = $this->os[$player->getName()];
		if(is_int($hirss)) return $this->translateVersion($hirss);
		else return $hirss;
	}
	
	public function translateVersion($fdp){
		switch($fdp){
		    case 1:
				$akha = "Android";
		    break;
		    case 2:
				$akha = "IOS";
			break;
		    case 3:
				$akha = "Mac"; 
			break;
		    case 4:
				$akha = "FireOS";
			  break;
		    case 5:
				$akha = "GearVR"; 
			break;
			case 6:
				$akha = "Hololens";
			break;
			case 7:
				$akha = "Windows 10";
			break;
			case 8:
				$akha = "Windows_32,Educal_version";
			break;
			case 9:
				$akha = "XBOX";
			break;
			case 10:
				$akha = "Playstation 4";
			break;
			case 11:
				$akha = "NX";
			break;
			default:
				$akha = "Unknown"; 
			break;
		}
		return $akha;
	}
}