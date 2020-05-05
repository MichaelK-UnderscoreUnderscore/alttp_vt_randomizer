<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * South Light World Region and it's Locations contained within
 */
class South extends Region\Standard\LightWorld\South
{
    /**
     * Create a new Light World Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::initalize();
        return $this;
    }
}
