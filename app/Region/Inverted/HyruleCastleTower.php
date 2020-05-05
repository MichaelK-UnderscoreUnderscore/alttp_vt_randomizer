<?php

namespace ALttP\Region\Inverted;

use ALttP\Region;

/**
 * Hyrule Castle Tower Region and it's Locations contained within
 */
class HyruleCastleTower extends Region\Standard\HyruleCastleTower
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
