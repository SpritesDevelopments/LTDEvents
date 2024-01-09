# LTDEvents

LTDEvents is a PocketMine-MP plugin designed to relay server events to a Discord channel using webhooks. This plugin notifies Discord about player joins, quits, and in-game chat messages in real-time.

## Features

- Relays player join and quit events to a specified Discord channel.
- Sends in-game chat messages to Discord, distinguishing commands from regular chat.

## Setup

- Add pluigin to plugins file
- Then restart the server
- Go to plugin_data and Enter Discord Webhook

### Requirements

- PocketMine-MP server
- Discord server with webhook access

### Installation

1. Download the plugin from [here](link_to_download) or build it from the source.
2. Place the `LTDEvents.phar` file in the `plugins` folder of your PocketMine-MP server.
3. Start or reload your server.

### Configuration

- Open `plugins/LTDEvents/config.yml`.
- Set the `discord_webhook_url` field to your Discord webhook URL.
- Customize other settings if needed.

## Usage

LTDEvents works seamlessly once configured. The plugin automatically sends notifications to the specified Discord channel whenever a player joins, quits, or sends a message in the game.

### Commands

- No in-game commands are provided by this plugin.

## Contributing

Feel free to fork this repository, make changes, and submit pull requests. Bug fixes, improvements, and additional features are always welcome!

## Our Discord
[Support Server](https://discord.gg/6sH3EDRsUk)

## Credits

This plugin was developed by [SpritesNetwork](https://github.com/SpritesNetwork).

## License

This project is licensed under the [MIT License](LICENSE).

---

**Powered By PowerCraft**
