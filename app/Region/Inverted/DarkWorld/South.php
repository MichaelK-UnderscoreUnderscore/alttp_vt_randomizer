<?php

namespace ALttP\Region\Inverted\DarkWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * South Dark World Region and it's Locations contained within
 */
class South extends Region\Standard\DarkWorld\South
{
    /**
     * Create a new South Dark World Region and initalize it's locations.
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->shops["Dark World Lake Hylia Shop"]->clearInventory()
            ->addInventory(0, Item::get('BluePotion', $world), 160)
            ->addInventory(1, Item::get('BlueShield', $world), 50)
            ->addInventory(2, Item::get('TenBombs', $world), 50);

        $this->locations->addItem(new Location\Chest("Link's House", [0xE9BC], null, $this));
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as
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
