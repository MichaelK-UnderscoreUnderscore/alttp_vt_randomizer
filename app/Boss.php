<?php

namespace ALttP;

use ALttP\Support\BossCollection;
use ALttP\Support\ItemCollection;
use ALttP\Support\LocationCollection;

/**
 * Boss Logic for beating each boss
 */
class Boss
{
    /** @var string */
    protected $name;
    /** @var string */
    protected $enemizer_name;
    /** @var callable|null */
    protected $can_beat;
    /** @var array */
    protected static $items;
    /** @var array */
    protected static $worlds = [];

    /**
     * Get the Boss by name
     *
     * @param string $name Name of Boss
     * @param \ALttP\World  $world  World boss belongs to
     *
     * @throws \Exception if the Boss doesn't exist
     *
     * @return \ALttP\Boss
     */
    public static function get(string $name, World $world): Boss
    {
        $items = static::all($world);
        if (isset($items[$name])) {
            return $items[$name];
        }

        throw new \Exception('Unknown Boss: ' . $name);
    }

    /**
     * Clears the internal cache so we don't leak memory in testing.
     *
     * @return void
     */
    public static function clearCache(): void
    {
        static::$items = [];
        static::$worlds = [];
    }

    /**
     * Get the all known Bosses
     *
     * @return \ALttP\Support\BossCollection
     */
    public static function all(World $world): BossCollection
    {
        if (isset(static::$items[$world->id])) {
            return static::$items[$world->id];
        }
        static::$worlds[$world->id] = $world;

        static::$items[$world->id] = new BossCollection([
            new static("Armos Knights", "Armos", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Lanmolas", "Lanmola", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Moldorm", "Moldorm", function ($locations, $items) {
                return true;
            }),
            new static("Agahnim", "Agahnim", function ($locations, $items) {
                return true;
            }),
            new static("Helmasaur King", "Helmasaur", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Arrghus", "Arrghus", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Mothula", "Mothula", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Blind", "Blind", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Kholdstare", "Kholdstare", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Vitreous", "Vitreous", function ($locations, $items) use ($world) {
                return true;
            }),
            new static("Trinexx", "Trinexx", function ($locations, $items) use ($world) {
                return $items->has('FireRod') && $items->has('IceRod');
            }),
            new static("Agahnim2", "Agahnim2", function ($locations, $items) {
                return true;
            }),
        ]);

        return static::all($world);
    }

    /**
     * Create a new Item.
     *
     * @param string         $name      Unique name of Boss
     * @param callable|null  $can_beat  Rules for beating the Boss
     *
     * @return void
     */
    public function __construct(string $name, string $ename = null, callable $can_beat = null)
    {
        $this->name = $name;
        $this->enemizer_name = $ename ?? $name;
        $this->can_beat = $can_beat;
    }

    /**
     * Get the name of this Boss.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the name of this Boss for Enemizer.
     *
     * @return string
     */
    public function getEName(): string
    {
        return $this->enemizer_name;
    }

    /**
     * Determine if Link can beat this Boss.
     *
     * @param \ALttP\Support\ItemCollection           $items      Items Link can collect
     * @param \ALttP\Support\LocationCollection|null  $locations
     *
     * @return bool
     */
    public function canBeat(ItemCollection $items, ?LocationCollection $locations = null): bool
    {
        if ($this->can_beat === null || call_user_func($this->can_beat, $locations ?? new LocationCollection, $items)) {
            return true;
        }

        return false;
    }
}
