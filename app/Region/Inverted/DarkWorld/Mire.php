<?php

namespace ALttP\Region\Inverted\DarkWorld;

use ALttP\Region;

/**
 * Mire Dark World Region and it's Locations contained within
 */
class Mire extends Region\Standard\DarkWorld\Mire
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
