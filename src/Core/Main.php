<?php

namespace Core\Main;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\Server;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info("§aThank you for installing this plugin by Steellgold");
    }

    public function onCommand(CommandSender $player, Command $command, String $label, array $args) : bool {
       switch($command->getName()){


        case 'gm0':
            $player->addTitle("§6Gamemode Update", "§fSurvival");
            $player->setGamemode(0);
            $player->setHealth(20);
            $player->setFood(20);
            return true;
        break; // gamemode 0


        case 'gm1':
            $player->addTitle("§6Gamemode Update", "§fCreative");
            $player->setGamemode(1);
            return true;
        break; // gamemode 1


        case 'gm2':
            $player->addTitle("§6Gamemode Update", "§fAdventure");
            $player->setGamemode(2);
            $player->setHealth(1);
            $player->setFood(1);
            return true;
        break; // gamemode 2


        case 'gm3':
            $player->addTitle("§6Gamemode Update", "§fSpectator");
            $player->setGamemode(3);
            return true;
        break; // gamemode 3

		case 'tpall':
			$message = implode(" ", $args);
				foreach (Server::getInstance()->getOnlinePlayers() as $pl) {
				$pl->teleport($player);
				$pl->addTitle("§f[§3Moderator Tools TP§f]§r", "$message");

			}
			return true;
		break;


        case 'vanish':
                if ($player->isInvisible()) {
                    $player->setInvisible(false);
                    $player->addTitle("§f[§3Moderator Tools§f]§r","§fYou are visible");
                }else{
                    $player->setInvisible(true);
                    $player->addTitle("§f[§3Moderator Tools§f]§r","§fYou are invisible");
                }
            return true;
        break;


        case 'fly':

                if ($player->getAllowFlight()) {
                    $player->setAllowFlight(false);
                    $player->addTitle("§f[§3Moderator Tools§f]§r","§fYou can not fly anymore");
                }else{
                    $player->setAllowFlight(true);
                    $player->addTitle("§f[§3Moderator Tools§f]§r","§fYou can fly");
                }
            return true;
        break;


        case 'kickall':
                $message = implode(" ", $args);
                foreach (Server::getInstance()->getOnlinePlayers() as $pl) {
                $pl->kick("You have been kicked form this server for $message");
            }
            return true;
        break;


        }
        return true;
    }


    public function onDisable(){
        $this->getLogger()->info("§cThe plugin is not load");
    }


}
