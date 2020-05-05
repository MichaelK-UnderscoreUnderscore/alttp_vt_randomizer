<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Desert Palace Region and it's Locations contained within
 */
class DesertPalace extends Region
{
    protected $name = 'Desert Palace';
    public $music_addresses = [
        0x1559B,
        0x1559C,
        0x1559D,
        0x1559E,
    ];

    protected $map_reveal = 0x1000;

    protected $region_items = [
        'BigKey',
        'BigKeyP2',
        'Compass',
        'CompassP2',
        'Key',
        'KeyP2',
        'Map',
        'MapP2',
    ];

    /**
     * Create a new Desert Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        // set a default boss
        $this->boss = Boss::get("Lanmolas", $world);

        $this->locations = new LocationCollection([
            new Location\BigChest("Desert Palace - Big Chest", [0xE98F], null, $this),
            new Location\Chest("Desert Palace - Map Chest", [0xE9B6], null, $this),
            new Location\Dash("Desert Palace - Torch", [0x180160], null, $this),
            new Location\Chest("Desert Palace - Big Key Chest", [0xE9C2], null, $this),
            new Location\Chest("Desert Palace - Compass Chest", [0xE9CB], null, $this),
            new Location\Drop("Desert Palace - Boss", [0x180151], null, $this),

            new Location\Prize\Pendant("Desert Palace - Prize", [null, 0x1209E, 0x53F1C, 0x53F1D, 0x180053, 0x180078, 0xC6FF], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Desert Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Desert Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Desert Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Desert Palace - Compass Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Desert Palace - Torch"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Desert Palace - Boss"]->canAccess($items);
        };

        $this->locations["Desert Palace - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
