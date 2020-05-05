<?php

namespace ALttP\Region\Open;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\Support\LocationCollection;
use ALttP\World;

/**
 * Hyrule Castle Escape Region and it's Locations contained within
 */
class HyruleCastleEscape extends Region\Standard\HyruleCastleEscape
{
    /**
     * Initalize the requirements for Entry and Completetion of the Region as well as access to all Locations contained
     * within for No Glitches
     *
     * @return $this
     */
    public function initalize()
    {
        $this->locations["Sewers - Secret Room - Left"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Sewers - Secret Room - Middle"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Sewers - Secret Room - Right"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Sewers - Dark Cross"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Hyrule Castle - Boomerang Chest"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Hyrule Castle - Zelda's Cell"]->setRequirements(function ($locations, $items) {
            return true;
        });

        $this->locations["Secret Passage"]->setFillRules(function ($item, $locations, $items) {
            return true;
        });

        $this->locations["Link's Uncle"]->setFillRules(function ($item, $locations, $items) {
            return true;
        });

        return $this;
    }
}
