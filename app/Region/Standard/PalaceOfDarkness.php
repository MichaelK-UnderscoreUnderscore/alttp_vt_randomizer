<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Support\LocationCollection;
use ALttP\Location;
use ALttP\Region;
use ALttP\Item;
use ALttP\World;

/**
 * Palace of Darkness Region and it's Locations contained within
 */
class PalaceOfDarkness extends Region
{
    protected $name = 'Dark Palace';
    public $music_addresses = [
        0x155B8,
    ];

    protected $map_reveal = 0x0200;

    protected $region_items = [
        'BigKey',
        'BigKeyD1',
        'Compass',
        'CompassD1',
        'Key',
        'KeyD1',
        'Map',
        'MapD1',
    ];

    /**
     * Create a new Palace of Darkness Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Helmasaur King", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Palace of Darkness - Shooter Room", [0xEA5B], null, $this),
            new Location\Chest("Palace of Darkness - Big Key Chest", [0xEA37], null, $this),
            new Location\Chest("Palace of Darkness - The Arena - Ledge", [0xEA3A], null, $this),
            new Location\Chest("Palace of Darkness - The Arena - Bridge", [0xEA3D], null, $this),
            new Location\Chest("Palace of Darkness - Stalfos Basement", [0xEA49], null, $this),
            new Location\Chest("Palace of Darkness - Map Chest", [0xEA52], null, $this),
            new Location\BigChest("Palace of Darkness - Big Chest", [0xEA40], null, $this),
            new Location\Chest("Palace of Darkness - Compass Chest", [0xEA43], null, $this),
            new Location\Chest("Palace of Darkness - Harmless Hellway", [0xEA46], null, $this),
            new Location\Chest("Palace of Darkness - Dark Basement - Left", [0xEA4C], null, $this),
            new Location\Chest("Palace of Darkness - Dark Basement - Right", [0xEA4F], null, $this),
            new Location\Chest("Palace of Darkness - Dark Maze - Top", [0xEA55], null, $this),
            new Location\Chest("Palace of Darkness - Dark Maze - Bottom", [0xEA58], null, $this),
            new Location\Drop("Palace of Darkness - Boss", [0x180153], null, $this),

            new Location\Prize\Crystal("Palace of Darkness - Prize", [null, 0x120A1, 0x53F00, 0x53F01, 0x180056, 0x18007D, 0xC702], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Palace of Darkness - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Palace of Darkness - The Arena - Ledge"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - The Arena - Bridge"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Compass Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Harmless Hellway"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Stalfos Basement"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Dark Basement - Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Dark Basement - Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Map Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Dark Maze - Top"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Palace of Darkness - Dark Maze - Bottom"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Palace of Darkness - Boss"]->canAccess($items);
        };

        $this->locations["Palace of Darkness - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
