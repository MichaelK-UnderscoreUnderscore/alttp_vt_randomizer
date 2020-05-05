<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region
{
    protected $name = 'Swamp Palace';
    public $music_addresses = [
        0x155B7,
    ];

    protected $map_reveal = 0x0400;

    protected $region_items = [
        'BigKey',
        'BigKeyD2',
        'Compass',
        'CompassD2',
        'Key',
        'KeyD2',
        'Map',
        'MapD2',
    ];

    /**
     * Create a new Swamp Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Arrghus", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Swamp Palace - Entrance", [0xEA9D], null, $this),
            new Location\BigChest("Swamp Palace - Big Chest", [0xE989], null, $this),
            new Location\Chest("Swamp Palace - Big Key Chest", [0xEAA6], null, $this),
            new Location\Chest("Swamp Palace - Map Chest", [0xE986], null, $this),
            new Location\Chest("Swamp Palace - West Chest", [0xEAA3], null, $this),
            new Location\Chest("Swamp Palace - Compass Chest", [0xEAA0], null, $this),
            new Location\Chest("Swamp Palace - Flooded Room - Left", [0xEAA9], null, $this),
            new Location\Chest("Swamp Palace - Flooded Room - Right", [0xEAAC], null, $this),
            new Location\Chest("Swamp Palace - Waterfall Room", [0xEAAF], null, $this),
            new Location\Drop("Swamp Palace - Boss", [0x180154], null, $this),

            new Location\Prize\Crystal("Swamp Palace - Prize", [null, 0x120A0, 0x53F6C, 0x53F6D, 0x180055, 0x180071, 0xC701], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Swamp Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Swamp Palace - Entrance"]->setFillRules(function ($item, $locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Map Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - West Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Compass Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function ($locations, $items) {
            return true;
        });
        
        $this->can_complete = function ($locations, $items) {
            return $this->locations["Swamp Palace - Boss"]->canAccess($items);
        };

        $this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
