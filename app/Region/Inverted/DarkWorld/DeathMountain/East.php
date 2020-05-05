<?php

namespace ALttP\Region\Inverted\DarkWorld\DeathMountain;

use ALttP\Region;

/**
 * Dark World Region and it's Locations contained within
 */
class East extends Region\Standard\DarkWorld\DeathMountain\East
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();
        return $this;
    }
}
