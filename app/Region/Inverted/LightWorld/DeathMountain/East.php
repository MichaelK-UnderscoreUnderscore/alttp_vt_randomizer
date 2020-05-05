<?php

namespace ALttP\Region\Inverted\LightWorld\DeathMountain;

use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * East Death Mountain Region and it's Locations contained within
 */
class East extends Region\Standard\LightWorld\DeathMountain\East
{
    /**
     * Create a new Death Mountain Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations->addItem(new Location\Drop\Ether("Ether Tablet", [0x180016], null, $this));
        $this->locations->addItem(new Location\Standing("Spectacle Rock", [0x180140], null, $this));
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