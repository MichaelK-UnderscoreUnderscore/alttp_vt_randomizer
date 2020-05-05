<?php

namespace ALttP\Region\Inverted\LightWorld;

use ALttP\Item;
use ALttP\Location;
use ALttP\Region;
use ALttP\World;

/**
 * North East Light World Region and it's Locations contained within
 */
class NorthEast extends Region\Standard\LightWorld\NorthEast
{
    public function __construct(World $world)
    {
        parent::__construct($world);

        $this->locations->addItem(new Location\Prize\Event("Ganon", [], null, $this));

        $this->prize_location = $this->locations["Ganon"];
        $this->prize_location->setItem(Item::get('DefeatGanon', $world));
    }
    /**
     * Initalize the requirements for Entry and Completetion of the Region as
     * well as access to all Locations contained within for No Glitches.
     *
     * @return $this
     */
    public function initalize()
    {
        parent::initalize();
        
        $this->prize_location->setRequirements(function ($locations, $items) {
            if (
                $this->world->config('goal') == 'dungeons'
                && (!$items->has('PendantOfCourage')
                    || !$items->has('PendantOfWisdom')
                    || !$items->has('PendantOfPower')
                    || !$items->has('DefeatAgahnim')
                    || !$items->has('Crystal1')
                    || !$items->has('Crystal2')
                    || !$items->has('Crystal3')
                    || !$items->has('Crystal4')
                    || !$items->has('Crystal5')
                    || !$items->has('Crystal6')
                    || !$items->has('Crystal7')
                    || !$items->has('DefeatAgahnim2'))
            ) {
                return false;
            }

            if (
                in_array($this->world->config('goal'), ['ganon', 'fast_ganon'])
                && (($items->has('Crystal1')
                    + $items->has('Crystal2')
                    + $items->has('Crystal3')
                    + $items->has('Crystal4')
                    + $items->has('Crystal5')
                    + $items->has('Crystal6')
                    + $items->has('Crystal7')) < $this->world->config('crystals.ganon', 7))
            ) {
                return false;
            }

            return true;
        });

        return $this;
    }
}
