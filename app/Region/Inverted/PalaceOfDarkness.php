<?php

namespace ALttP\Region\Inverted;

use ALttP\Region;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region\Standard\PalaceOfDarkness
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
