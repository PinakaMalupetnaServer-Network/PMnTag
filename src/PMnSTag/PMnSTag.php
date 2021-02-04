<?php

namespace PMnSTag;

use pocketmine\{
	scheduler\Task,
	utils\Textformat as C,
	Server,
};;
class PMnSTag extends Task
{
	public function onRun(int $currentTask){
		foreach(Server::getInstance()->getOnlinePlayers() as $player){
			if($player->getHealth() >= 10){
				$health = C::GREEN . round($player->getHealth());
			}else if($player->getHealth() >= 5 && $player->getHealth() < 10){
				$health = C::YELLOW . round($player->getHealth());
			}else if($player->getHealth() < 5){
				$health = C::RED . round($player->getHealth());
			}
			if($player->getPing() <= 119){
				$ping = C::GREEN . $player->getPing() . "ms";
			}else if($player->getPing() > 119 and $player->getPing() <= 179){
				$ping = C::YELLOW . $player->getPing() . "ms";
			}else if($player->getPing() > 179){
				$ping = C::RED . $player->getPing() . "ms";
			}
			$player->setScoreTag($health . " ❤ - " . $ping . " - " . C::LIGHT_PURPLE . Main::getInstance()->getUos($player)); // Health, Ping and Device
		}
	}
}