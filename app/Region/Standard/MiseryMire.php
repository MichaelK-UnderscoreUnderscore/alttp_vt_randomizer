<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Misery Mire Region and it's Locations contained within
 */
class MiseryMire extends Region
{
    protected $name = 'Misery Mire';
    public $music_addresses = [
        0x155B9,
    ];

    protected $map_reveal = 0x0100;

    protected $region_items = [
        'BigKey',
        'BigKeyD6',
        'Compass',
        'CompassD6',
        'Key',
        'KeyD6',
        'Map',
        'MapD6',
    ];

    /**
     * Create a new Misery Mire Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Vitreous", $world);

        $this->locations = new LocationCollection([
            new Location\BigChest("Misery Mire - Big Chest", [0xEA67], null, $this),
            new Location\Chest("Misery Mire - Main Lobby", [0xEA5E], null, $this),
            new Location\Chest("Misery Mire - Big Key Chest", [0xEA6D], null, $this),
            new Location\Chest("Misery Mire - Compass Chest", [0xEA64], null, $this),
            new Location\Chest("Misery Mire - Bridge Chest", [0xEA61], null, $this),
            new Location\Chest("Misery Mire - Map Chest", [0xEA6A], null, $this),
            new Location\Chest("Misery Mire - Spike Chest", [0xE9DA], null, $this),
            new Location\Drop("Misery Mire - Boss", [0x180158], null, $this),

            new Location\Prize\Crystal("Misery Mire - Prize", [null, 0x120A2, 0x53F48, 0x53F49, 0x180057, 0x180075, 0xC703], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Misery Mire - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Misery Mire - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Misery Mire - Spike Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Misery Mire - Main Lobby"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Misery Mire - Map Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Misery Mire - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Misery Mire - Compass Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Misery Mire - Boss"]->canAccess($items);
        };

        $this->locations["Misery Mire - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
