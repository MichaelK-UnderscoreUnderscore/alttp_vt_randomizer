<?php

namespace ALttP\Region\Inverted\DarkWorld\DeathMountain;

use ALttP\Region;
use ALttP\World;

/**
 * Dark World Region and it's Locations contained within
 */
class West extends Region\Standard\DarkWorld\DeathMountain\West
{
    /**
     * Create a new Dark World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->shops->removeItem("Dark Death Mountain Fairy");
    }

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
