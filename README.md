# telegramBot
*Tiny PHP class to setup webhook &amp; broadcast messaging*

**Installation**

 1. Create Telegram bot, refer to the page: https://core.telegram.org/bots
 2. Update the token in `config.php`
 3. To setup webhook, update the HTTPS url in `setwebhook.php`
 4. Run `setwebhook.php` to enable Telegram Webhook
 5. Use your own Telegram to add your bot, and send some message. You may customize feedback message by updating `webhook.php`.
 6. Run `broadcast.php` to broadcast message to users who registered your bot.
