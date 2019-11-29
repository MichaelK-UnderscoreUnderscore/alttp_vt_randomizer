<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class HyruleCastleTowerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'NoGlitches']);
        $this->addCollected(['RescueZelda']);
        $this->collected->setChecksForWorld($this->world->id);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->world);
    }

    // Entry
    public function testEntryLampFlute()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canEnter($this->world->getLocations(), $this->allItemsExcept(['Lamp', 'Flute'])));
    }
    public function testEntryGloveFlute()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canEnter($this->world->getLocations(), $this->allItemsExcept(['Gloves', 'Flute'])));
    }

    // Completion
    public function testSwordRequiredToComplete()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canComplete($this->world->getLocations(), $this->allItemsExcept(['AnySword'])));
    }
    public function testLampRequiredToComplete()
    {
        $this->assertFalse($this->world->getRegion('Hyrule Castle Tower')
            ->canComplete($this->world->getLocations(), $this->allItemsExcept(['Lamp'])));
    }
}
