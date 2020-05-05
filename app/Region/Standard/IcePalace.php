<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Ice Palace Region and it's Locations contained within
 */
class IcePalace extends Region
{
    protected $name = 'Ice Palace';
    public $music_addresses = [
        0x155BF,
    ];

    protected $map_reveal = 0x0040;

    protected $region_items = [
        'BigKey',
        'BigKeyD5',
        'Compass',
        'CompassD5',
        'Key',
        'KeyD5',
        'Map',
        'MapD5',
    ];

    /**
     * Create a new Ice Palace Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Kholdstare", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Ice Palace - Big Key Chest", [0xE9A4], null, $this),
            new Location\Chest("Ice Palace - Compass Chest", [0xE9D4], null, $this),
            new Location\Chest("Ice Palace - Map Chest", [0xE9DD], null, $this),
            new Location\Chest("Ice Palace - Spike Room", [0xE9E0], null, $this),
            new Location\Chest("Ice Palace - Freezor Chest", [0xE995], null, $this),
            new Location\Chest("Ice Palace - Iced T Room", [0xE9E3], null, $this),
            new Location\BigChest("Ice Palace - Big Chest", [0xE9AA], null, $this),
            new Location\Drop("Ice Palace - Boss", [0x180157], null, $this),

            new Location\Prize\Crystal("Ice Palace - Prize", [null, 0x120A4, 0x53F5A, 0x53F5B, 0x180059, 0x180073, 0xC705], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Ice Palace - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Ice Palace - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Ice Palace - Map Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Ice Palace - Spike Room"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Ice Palace - Freezor Chest"]->setRequirements(function ($locations, $items) {
            return $items->canMeltThings($this->world);
        });

        $this->locations["Ice Palace - Big Chest"]->setRequirements(function ($locations, $items) {
            return $items->has('BigKeyD5');
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Ice Palace - Boss"]->canAccess($items);
        };

        $this->locations["Ice Palace - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
