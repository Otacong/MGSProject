<?php

namespace Otacong;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;

class MGS_System extends PluginBase implements Listener
{

	public function onEnable()
	{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("§a【§eMGS§a】 §bプラグインを読み込みました。");
	}

	public function onJoin(PlayerJoinEvent $event)
	{
		$player = $event->getPlayer();
		$player->addTitle("§eWelcome to MGS !!","§6ようこそ!MGSへ!");
    }


    public function onCommand(CommandSender $sender, Command $command, $label, array $args) : bool
    {
   		switch ($label) {

   			case "adminlogin":

                if (!isset($args[0])) return false;
 				if (!$sender->isOp()) {

 					$sender->sendMessage("§cあなたはOPではないのでこのコマンドを実行する権利がありません。");

 				} else {

 					$data = [
 						"type" => "custom_form",
 						"title" => "AdminLogin: 権限者ログイン",
 						"content" => [
 							[
 								"type" => "input",
 								"text" => "ユーザー名 - プレイヤー名を入力してください。",
 								"placeholder" => "ユーザー名を入力",
 								"default" => ""
 							],
 							[
 								"type" => "input",
 								"text" => "パスワード - 鯖主から教えてもらったパスワードを入力してください。",
 								"placeholder" => "パスワードを入力",
 								"default" => ""
 							]
 						]
 					];

					$pk = new ModalFormRequestPacket();

					$pk->formId = 1221;
					$pk->formData = json_encode($data);

					$sender->dataPacket($pk);

				}

				return true;
				break;
		}
	}
}