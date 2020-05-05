<?php

namespace ALttP\Region\Inverted\DarkWorld;

use ALttP\Region;

/**
 * North West Dark World Region and it's Locations contained within
 */
class NorthWest extends Region\Standard\DarkWorld\NorthWest
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as
     * well as access to all Locations contained within for No Glitches.
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();
        return $this;
    }
}
