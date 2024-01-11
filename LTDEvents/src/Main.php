<?php

declare(strict_types=1);

namespace SpritesNetwork\LTDEvents;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\Internet;

class Main extends PluginBase implements Listener{

    private $discordWebhookUrl;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->reloadConfig();
        $this->loadConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    private function loadConfig(): void {
        $config = $this->getConfig();
        $this->discordWebhookUrl = $config->get("discord_webhook_url");

        if (empty($this->discordWebhookUrl)) {
            $this->getLogger()->warning("discord_webhook_url is missing or empty in config.yml. Setting default value.");
            $config->set("discord_webhook_url", "YOUR_DISCORD_WEBHOOK_URL_HERE");
            $config->save();
            $this->discordWebhookUrl = "YOUR_DISCORD_WEBHOOK_URL_HERE";
        }
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        $this->sendToDiscord("**{$player->getName()}** joined the game.", 0x00FF00);
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void{
        $player = $event->getPlayer();
        $this->sendToDiscord("**{$player->getName()}** left the game.", 0xFF0000);
    }

    public function onPlayerChat(PlayerChatEvent $event): void{
        $player = $event->getPlayer();
        $message = $event->getMessage();

        // Check if the message is a command (you can change the command prefix)
        if (substr($message, 0, 1) === '/') {
            // Process the command here
            $this->sendToDiscord("**{$player->getName()}** executed command: $message", 0xFFFF00);
        } else {
            // Handle regular chat messages
            $this->sendToDiscord("**{$player->getName()}** said: $message", 0x0000FF);
        }
    }

    private function sendToDiscord(string $message, int $color): void {
        if ($this->discordWebhookUrl !== null && filter_var($this->discordWebhookUrl, FILTER_VALIDATE_URL) !== false) {
            $data = [
                "embeds" => [
                    [
                        "title" => "Server Event",
                        "description" => $message,
                        "color" => $color,
                        "footer" => [
                            "text" => "Powered By PowerCraft"
                        ]
                    ]
                ]
            ];
            $options = ["Content-Type: application/json"];
            Internet::postURL($this->discordWebhookUrl, json_encode($data), 5, $options);
        } else {
            $this->getLogger()->warning("Invalid Discord webhook URL provided.");
        }
    }
}
