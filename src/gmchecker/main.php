<?php
namespace gmchecker;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
class main extends PluginBase {
	public function onEnable(){
		$this->getLogger()->info("Loaded!");
	}
	public function onCommand(CommandSender $sender,Command $command, $label,array $args){
		switch (strtolower($command->getName())){
			case "gmcheck":
				if (!$sender->hasPermission("gmchecker.check")) return ;
				
				if (isset($args[0])){
					switch (strtolower($args[0])){
						case "s":
							$sender->sendMessage(TextFormat::GOLD.TextFormat::BOLD."Players in Survival:");
							foreach ($this->getServer()->getOnlinePlayers() as $p){
								if ($p instanceof Player){
									if ($p->getGamemode() === 0){
										$sender->sendMessage(TextFormat::GREEN."* ".$p->getName());
									}
								}
							}
							return ;
							
						case "c":
							$sender->sendMessage(TextFormat::GOLD.TextFormat::BOLD."Players in Creative:");
							foreach ($this->getServer()->getOnlinePlayers() as $p){
								if ($p instanceof Player){
									if ($p->getGamemode() === 1){
										$sender->sendMessage(TextFormat::GREEN."* ".$p->getName());
									}
								}
							}
							return ;
						default:
							$p = $this->getServer()->getPlayer($args[0]);
							if ($p instanceof Player){
								$gm = $p->getGamemode();
								$sender->sendMessage(TextFormat::GREEN.TextFormat::BOLD."Player: ".$p->getName()." is in Gamemode: ".$gm);
								return;
							}else{
								$sender->sendMessage(TextFormat::RED."Player not found");
							}
					}
				}else{
					$sender->sendMessage(TextFormat::AQUA.TextFormat::BOLD."USAGE: /gmcheck [s/c] \n will list player in specific game type! \n /gmcheck [playername] \n will check specific player gamemode");
				}
				
			break;
			case "opcheck":
				$sender->sendMessage(TextFormat::GOLD.TextFormat::BOLD."Players that are op and online:");
				foreach ($this->getServer()->getOnlinePlayers() as $p){
					if ($p instanceof Player){
						if ($p->isOp()){
							$sender->sendMessage(TextFormat::GREEN."* ".$p->getName());
						}}}
				
			break;
		}
	}
}