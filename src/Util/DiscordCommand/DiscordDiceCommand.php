<?php
namespace App\Util\DiscordCommand;

use App\Service\Discord;

/**
 * Description of DiscordDiceCommand
 *
 * @author lpu8er
 */
class DiscordDiceCommand extends DiscordCommand {
    public function help(Discord $discordService) {
        $hs = [];
        $hs[] = '`.dice` run a 6-face dice';
        $hs[] = '`.dice <face>` run a <face>-face dice (from 2 to 1000)';
        $discordService->talk(implode(PHP_EOL, $hs), $this->data['channel_id']);
    }
    
    public function execute(Discord $discordService) {
        $fc = 6;
        if(1 <= count($this->args)) {
            $fc = intval(preg_replace('`[^a-zA-Z0-9]`', '', array_shift($this->args)));
        }
        if(2 <= $fc && 1000 >= $fc) {
            $rnd = mt_rand(1, $fc);
            $discordService->talk(':game_die: **'.strval($rnd).'**', $this->data['channel_id']);
        } else {
            $this->help($discordService);
        }
    }
}
