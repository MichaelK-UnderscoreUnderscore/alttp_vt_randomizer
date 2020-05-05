<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Eastern Palace Region and it's Locations contained within
 */
class EasternPalace extends Region
{
    protected $name = 'Eastern Palace';
    public $music_addresses = [
        0x1559A,
    ];

    protected $map_reveal = 0x2000;

    protected $region_items = [
        'BigKey',
        'BigKeyP1',
        'Compass',
        'CompassP1',
        'Key',
        'KeyP1',
        'Map',
        'MapP1',
    ];

    /**
     * Create a new Eastern Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        // set a default boss
        $this->boss = Boss::get("Armos Knights", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Eastern Palace - Compass Chest", [0xE977], null, $this),
            new Location\BigChest("Eastern Palace - Big Chest", [0xE97D], null, $this),
            new Location\Chest("Eastern Palace - Cannonball Chest", [0xE9B3], null, $this),
            new Location\Chest("Eastern Palace - Big Key Chest", [0xE9B9], null, $this),
            new Location\Chest("Eastern Palace - Map Chest", [0xE9F5], null, $this),
            new Location\Drop("Eastern Palace - Boss", [0x180150], null, $this),

            new Location\Prize\Pendant("Eastern Palace - Prize", [null, 0x1209D, 0x53EF8, 0x53EF9, 0x180052, 0x18007C, 0xC6FE], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Eastern Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Eastern Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Eastern Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Eastern Palace - Boss"]->canAccess($items);
        };

        $this->locations["Eastern Palace - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
