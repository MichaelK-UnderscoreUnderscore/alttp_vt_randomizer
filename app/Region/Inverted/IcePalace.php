<?php

namespace ALttP\Region\Inverted;

use ALttP\Region;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region\Standard\IcePalace
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
