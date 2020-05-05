<?php

namespace ALttP\Region\Inverted;

use ALttP\Region;

/**
 * Thieves Town Region and it's Locations contained within
 */
class ThievesTown extends Region\Standard\ThievesTown
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
