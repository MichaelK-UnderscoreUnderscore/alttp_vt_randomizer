<?php

namespace ALttP\Region\Standard;

use ALttP\Boss;
use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Turtle Rock Region and it's Locations contained within
 */
class TurtleRock extends Region
{
    protected $name = 'Turtle Rock';
    public $music_addresses = [
        0x155C7,
        0x155A7,
        0x155AA,
        0x155AB,
    ];

    protected $map_reveal = 0x0008;

    protected $region_items = [
        'BigKey',
        'BigKeyD7',
        'Compass',
        'CompassD7',
        'Key',
        'KeyD7',
        'Map',
        'MapD7',
    ];

    /**
     * Consider using this as a way of filling all items at once. set to 0 for
     * keysanity.
     * @todo remove this if we don't plan on using it
     */
    protected $dungeon_item_count = 7;

    /**
     * Create a new Turtle Rock Region and initalize it's locations
     *
     * @param World $world World this Region is part of
     *
     * @return void
     */
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->boss = Boss::get("Trinexx", $world);

        $this->locations = new LocationCollection([
            new Location\Chest("Turtle Rock - Chain Chomps", [0xEA16], null, $this),
            new Location\Chest("Turtle Rock - Compass Chest", [0xEA22], null, $this),
            new Location\Chest("Turtle Rock - Roller Room - Left", [0xEA1C], null, $this),
            new Location\Chest("Turtle Rock - Roller Room - Right", [0xEA1F], null, $this),
            new Location\BigChest("Turtle Rock - Big Chest", [0xEA19], null, $this),
            new Location\Chest("Turtle Rock - Big Key Chest", [0xEA25], null, $this),
            new Location\Chest("Turtle Rock - Crystaroller Room", [0xEA34], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Bottom Left", [0xEA31], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Bottom Right", [0xEA2E], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Top Left", [0xEA2B], null, $this),
            new Location\Chest("Turtle Rock - Eye Bridge - Top Right", [0xEA28], null, $this),
            new Location\Drop("Turtle Rock - Boss", [0x180159], null, $this),

            new Location\Prize\Crystal("Turtle Rock - Prize", [null, 0x120A7, 0x53F24, 0x53F25, 0x18005C, 0x180079, 0xC708], null, $this),
        ]);
        $this->locations->setChecksForWorld($world->id);
        $this->prize_location = $this->locations["Turtle Rock - Prize"];
    }

    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Turtle Rock - Chain Chomps"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Roller Room - Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Roller Room - Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Compass Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Big Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Big Key Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Crystaroller Room"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Eye Bridge - Bottom Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Turtle Rock - Eye Bridge - Top Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->can_complete = function ($locations, $items) {
            return $this->locations["Turtle Rock - Boss"]->canAccess($items);
        };

        $this->locations["Turtle Rock - Boss"]->setRequirements(function ($locations, $items) {
            return $this->boss->canBeat($items, $locations);
        });

        $this->can_enter = function ($locations, $items) {
            return true;
        };

        $this->prize_location->setRequirements($this->can_complete);

        return $this;
    }
}
