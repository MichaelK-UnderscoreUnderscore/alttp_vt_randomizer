<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region\Standard\DesertPalace
{
    /**
     * Initalize the requirements for Entråy and Completetion of the Region as
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
