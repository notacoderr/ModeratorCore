<?php

namespace Core\Hesuvia;

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
use jojoe77777\FormAPI;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use many1337\task\GuardianTask;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info("§aConnexion Reussie à Hesuvia");
    }

    public function onCommand(CommandSender $player, Command $command, String $label, array $args) : bool {
       switch($command->getName()){


        case 'nether':
                if (!$this->getServer()->isLevelLoaded("nether")) {
                    $this->getServer()->loadLevel("nether");
                } 

                $player->teleport(new Position (856,49,134,$this->getServer()->getLevelByName("nether")));
                $player->addTitle("§f[§3Hesuvia TP§f]§r", "Vous avez été téléporter au Nether");
            return true;
        break; // se tp au nether


        case "spawn":
                    $player->teleport(new Position (424,73,425,$this->getServer()->getLevelByName("world")));
                    $player->addTitle("§f[§3Hesuvia§f]§r", "Hola !");
            return true;
        break; // se teleporter au spawn


        case "crafts":
                    $player->teleport(new Position (451,71,449,$this->getServer()->getLevelByName("world")));
                    $player->addTitle("§f[§3Hesuvia§f]§r", "Bon crafting !");
            return true;
        break; // teleporter a la grotte des crafts


        case "heal":
            $player->sendMessage("§f[§3Hesuvia§f]§r Tu a été soigner");
            $player->addTitle("§f[§3Hesuvia§f]§r","§fVous vous santé mieux ?");
            $player->setHealth(20);
            return true;
        break; // se heal


        case 'feed':
            $player->sendMessage("§f[§3Hesuvia§f]§r Tu a été nourri(e)");
            $player->addTitle("§f[§3Hesuvia§f]§r","§fVous avez bien mangé ?");
            $player->setFood(20);
            return true;
        break; // se feed


        case "clear":
            $player->addTitle("§f[§3Hesuvia§f]§r", "§fTa pas froid ?");
            $player->getInventory()->clearAll();
            $player->getArmorInventory()->clearAll();
            $player->setHealth(20);
            $player->setFood(20);
            return true;
        break; // se clear


        case "boussole":
                $x = $player->getFloorX();
                $y = $player->y;
                $z = $player->getFloorZ();

                $player->addTitle("§f[§3Hesuvia Boussole§f]§r", "X : $x | Y : $y | Z: $z");
            return true;
        break; // avoir ses coordonnée


		case 'tpall':
			$message = implode(" ", $args);
				foreach (Server::getInstance()->getOnlinePlayers() as $pl) {
				$pl->teleport($player);
				$pl->addTitle("§f[§3Hesuvia TP§f]§r", "$message");

			}
			return true;
		break; // teleporter tout le monde a sois


        case 'hesuviatower':
				$player->teleport(new Position (851,63,171,$this->getServer()->getLevelByName("world")));
				$player->addTitle("§f[§3Hesuvia TP§f]§r", "Vous avez été téléporter à l'Hesuvia Tower");
            return true;
        break; // se teleport a l'ht // staff


        case "annonce":
                $message = implode(" ", $args);

                foreach (Server::getInstance()->getOnlinePlayers() as $news) {
                    $news->addTitle("§f[§3Hesuvia New's§f]§r", "$message");
                }
            return true;
        break; // faire une annonce en title


        case 'gm0':
            $player->addTitle("§6Mode de Jeu", "§fVous êtes en Survie.");
            $player->setGamemode(0);
            $player->setHealth(20);
            $player->setFood(20);
            return true;
        break; // gamemode 0


        case 'gm1':
            $player->addTitle("§6Mode de Jeu", "§fVous êtes en Créatif");
            $player->setGamemode(1);
            return true;
        break; // gamemode 1


        case 'gm2':
            $player->addTitle("§6Mode de Jeu", "§fVous êtes en Aventure");
            $player->setGamemode(2);
            $player->setHealth(1);
            $player->setFood(1);
            return true;
        break; // gamemode 2


        case 'gm3':
            $player->addTitle("§6Mode de Jeu", "§fVous êtes en Spectateur");
            $player->setGamemode(3);
            return true;
        break; // gamemode 3


        case 'test':
            if ($player instanceof Player) {

                $player->addActionBarMessage("Test");
            }else{
                $player->sendMessage("Dring Dring ! té po un joueur wsh kes tu fai ?");
            }
                return true;
        break; // commande de test


        case 'vanish':
                if ($player->isInvisible()) {
                    $player->setInvisible(false);
                    $player->addTitle("§f[§3Hesuvia§f]§r","§fVous êtes visible");
                }else{
                    $player->setInvisible(true);
                    $player->addTitle("§f[§3Hesuvia§f]§r","§fVous êtes invisible");
                }
            return true;
        break; // activer le vanish / desactiver


        case 'fly':

                if ($player->getAllowFlight()) {
                    $player->setAllowFlight(false);
                    $player->addTitle("§f[§3Hesuvia§f]§r","§fVous ne pouvez plus fly");
                }else{
                    $player->setAllowFlight(true);
                    $player->addTitle("§f[§3Hesuvia§f]§r","§fVous pouvez fly");
                }
            return true;
        break; // activer le fly / desactiver


        case 'kickall':
                $message = implode(" ", $args);
                foreach (Server::getInstance()->getOnlinePlayers() as $pl) {
                $pl->kick($message);
            }
            return true;
        break; // expulser tout les membres du serveur

        case 'faction';
            if ($player instanceof Player) {

                $player->transfert('hesuvia.cf','19132');
            }else {
                $player->sendMessage("Dring Dring ! té po un joueur wsh kes tu fai ?");
            }
            return true;
        break;

        case 'testserveur';
               if ($player instanceof Player) {

                   $player->transfert('hesuvia.cf','19132');
               }else {
                  $player->sendMessage("Dring Dring ! té po un joueur wsh kes tu fai ?");
            }
            return true;
        break;


        case "starterkit":
                $item = Item::get(272,0,1);
                    $item->setCustomName("§cStarterKit Sword");
                    $item->setLore([
                        "§eÉpée en Pierre",
                        "§eCombattez votre ennemi en corp à corp"
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(274,0,1);
                    $item->setCustomName("§cStarterKit Pickaxe");
                    $item->setLore([
                        "§ePioche en Pierre",
                        "§eMiner sans transpiré(é)"
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(275,0,1);
                    $item->setCustomName("§cStarterKit Axe");
                    $item->setLore([
                        "§eHache en Pierre",
                        "§eCasser du Bois en étant beau"
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(298,0,1);
                    $item->setCustomName("§cStarterKit Helmet");
                    $item->setLore([
                        "§eCasque en Cuire",
                        "§eProtegez vous des pierres qui tombes..."
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(299,0,1);
                    $item->setCustomName("§cStarterKit Chesplate");
                    $item->setLore([
                        "§ePlastron en Cuire",
                        "§eProtegez vous des assasins..."
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(300,0,1);
                    $item->setCustomName("§cStarterKit Leggins");
                    $item->setLore([
                        "§ePantalon en Cuire",
                        "§eProtegez vous des fleches qui vous empecheront de courrir"
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(301,0,1);
                    $item->setCustomName("§cStarterKit Boots");
                    $item->setLore([
                        "§eBottes en Cuire",
                        "§eProtegez vous des agrafeuses qui sont au sol..."
                    ]);
                
                $player->getInventory()->addItem($item);

                $item = Item::get(Item::STEAK,0,64);
                    $item->setCustomName("§3Steak");
                    $item->setLore([
                        "§eBoeuf Cuit",
                        "§eHmmmmm..."
                    ]);
                
                $player->getInventory()->addItem($item);

                $player->setHealth(20);
                $player->setFood(20);
            return true;
        break; // avoir le kit de depart






































        }
        return true;
    }


    public function onDisable(){
        $this->getLogger()->info("§cDéconnexion de Hesuvia");
    }


}