<?php
namespace TransferUI;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
class Main extends PluginBase implements Listener {
	
    public function onEnable() {
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		if($api === null){
			$this->getServer()->getPluginManager()->disablePlugin($this);			
		}
    }
	
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
		switch($cmd->getName()){
			case "servers":
				if($sender instanceof Player) {
					$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
					$form = $api->createSimpleForm(function (Player $sender, array $data){
					$result = $data[0];
					
					if($result === null){
						return true;
					}
						switch($result){
							case 1:
								$command = "transferserver voidprisonspe.ml 25647";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
							break;
								
							case 2:
								$command = "transferserver voidfactionspe.ml 19132";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
						        break;
							
							case 3:
								$command = "transferserver voidkitpvppe.ml 25625";
								$this->getServer()->getCommandMap()->dispatch($sender, $command);
							break;
              
								
						}
					});
					$form->setTitle("§a§lServer Selector!");
					$form->setContent("§bPlease choose a server to teleport to!");
					$form->addButton(TextFormat::BOLD . "§6§lVoid§bPrisons§cPE (§dTap Me!)");
					$form->addButton(TextFomat::BOLD . "§6§lVoid§bFactions§cPE (§dTap Me!)");
					$form->addButton(TextFormat::BOLD . "§6§lVoid§bKitPvP§cPE (§dTap me!)");
					$form->sendToPlayer($sender);
				}
				else{
					$sender->sendMessage(TextFormat::RED . "Use this Command in-game.");
					return true;
				}
			break;
		}
		return true;
    }
}
