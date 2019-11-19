<?php
namespace flowy\concept;

use flowy\Flowy;
use function flowy\listen;

use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerJoinEvent;

class ConceptPlugin extends PluginBase {
	function onEnable() {
		$flow = Flowy::run($this, \Closure::fromCallable(function() {
			$event = yield listen(PlyerJoinEvent::class);
			$player = $event->getPlayer();
			$player->sendMessage("Wellcome!!!");
			$event = yield listen(PlayerChatEvent::class)->filter(function($ev) use ($player) {
				return $ev->getPlayer() === $player;
			});
			//do $event = yield listen(PlayerChatEvent::class); while($event->getPlayer() !== $player);

			$event->setMessage($player->getName() . "'s message is Replaced");
		}));
	}
}
