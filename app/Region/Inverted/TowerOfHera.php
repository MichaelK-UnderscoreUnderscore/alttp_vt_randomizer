<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Tower of Hera Region and it's Locations contained within
 */
class TowerOfHera extends Region\Standard\TowerOfHera
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
