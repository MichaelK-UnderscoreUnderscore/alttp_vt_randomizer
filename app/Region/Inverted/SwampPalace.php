<?php

namespace ALttP\Region\Inverted;

use ALttP\Item;
use ALttP\Region;

/**
 * Swamp Palace Region and it's Locations contained within
 */
class SwampPalace extends Region\Standard\SwampPalace
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();

        $mireSwitch = function ($locations, $items) {
            return 
                $this->world->config('canOneFrameClipUW', false)
                && (
                    (
                        $locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                            "Misery Mire - Compass Chest",
                            "Misery Mire - Big Key Chest",
                        ]) &&
                        $items->has('KeyD6', 2)
                    ) 
                    || $items->has('KeyD6', 3)
                ) 
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };
        
        $heraSwitch = function ($locations, $items) {
            return 
                $this->world->config('canOneFrameClipUW', false)
                && $this->world->getRegion('Tower of Hera')->canEnter($locations, $items)
                && $items->has('BigKeyP3');
        };

        $mainEntry = function ($locations, $items) {
            return 
                (
                    $items->has('MoonPearl')
                    || $this->world->config('canSuperBunny', false)
                )
                && $items->has('MagicMirror')
                && $this->world->getRegion('South Light World')->canEnter($locations, $items);
        };
        
        $mireEntry = function ($locations, $items) {
            return 
                $this->world->config('canOneFrameClipUW', false)
                && (
                    (	
                        $locations->itemInLocations(Item::get('BigKeyD6', $this->world), [
                            "Misery Mire - Compass Chest",
                            "Misery Mire - Big Key Chest",
                        ]) &&
                        $items->has('KeyD6', 3)
                    ) 
                    || $items->has('KeyD6', 4)
                ) 
                && $this->world->getRegion('Misery Mire')->canEnter($locations, $items);
        };

        $this->locations["Swamp Palace - Big Chest"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                )
                && (
                    $items->has('BigKeyD2')
                    || (
                        $mireSwitch($locations, $items)
                        && $items->has('BigKeyD6')
                    )
                    || (
                        $heraSwitch($locations, $items)
                        && $items->has('BigKeyP3')
                    )
                );
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('accessibility') !== 'locations' && $item == Item::get('BigKeyD2', $this->world);
        });

        $this->locations["Swamp Palace - Big Key Chest"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Map Chest"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                $items->canBombThings()
                && (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                );
        });

        $this->locations["Swamp Palace - West Chest"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Compass Chest"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Flooded Room - Left"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                $items->has('Hookshot')
                && (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Flooded Room - Right"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                $items->has('Hookshot')
                && (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Waterfall Room"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                $items->has('Hookshot')
                && (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                );
        });

        $this->locations["Swamp Palace - Boss"]->setRequirements(function ($locations, $items) use ($mireEntry, $mireSwitch, $heraSwitch) {
            return 
                $items->has('Hookshot')
                && (
                    $items->has('KeyD2')
                    || $mireEntry($locations, $items)
                )
                && (
                    $items->has('Hammer') 
                    || $mireSwitch($locations, $items) 
                    || $heraSwitch($locations, $items)
                )
                && $this->boss->canBeat($items, $locations)
                && (
                    !$this->world->config('region.wildCompasses', false)
                    || $items->has('CompassD2')
                    || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('CompassD2', $this->world))
                ) && (
                    !$this->world->config('region.wildMaps', false)
                    || $items->has('MapD2')
                    || $this->locations["Swamp Palace - Boss"]->hasItem(Item::get('MapD2', $this->world))
                );
        })->setFillRules(function ($item, $locations, $items) {
            if (
                !$this->world->config('region.bossNormalLocation', true)
                && ($item instanceof Item\Key || $item instanceof Item\BigKey
                    || $item instanceof Item\Map || $item instanceof Item\Compass)
            ) {
                return false;
            }

            return true;
        })->setAlwaysAllow(function ($item, $items) {
            return $this->world->config('region.bossNormalLocation', true)
                && ($item == Item::get('CompassD2', $this->world) || $item == Item::get('MapD2', $this->world));
        });

        $this->can_enter = function ($locations, $items) use ($mainEntry, $mireEntry) {
            return 
                $items->has('Flippers')
                && (
                    $this->world->config('itemPlacement') !== 'basic'
                    || (
                        (
                            $this->world->config('mode.weapons') === 'swordless'
                            || $items->hasSword()
                        )
                        && $items->hasHealth(7)
                        && $items->hasBottle()
                    )
                ) && (
                    $mainEntry($locations, $items)
                    || $mireEntry($locations, $items)
                );
        };

        return $this;
    }
}
