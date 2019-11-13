<?php

namespace Inverted\DarkWorld\DeathMountain;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class EastTest extends TestCase
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

    /**
     * @param string $location
     * @param bool $access
     * @param array $items
     * @param array $except
     *
     * @dataProvider accessPool
     */
    public function testLocation(string $location, bool $access, array $items, array $except = [])
    {
        if (count($except)) {
            $this->collected = $this->allItemsExcept($except);
        }

        $this->addCollected($items);

        $this->assertEquals($access, $this->world->getLocation($location)
            ->canAccess($this->collected));
    }

    public function accessPool()
    {
        return [
            ["Superbunny Cave - Top", false, []],
            ["Superbunny Cave - Top", false, [], ['Gloves', 'Gloves']],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Top", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute']],
            ["Superbunny Cave - Top", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'Flute']],

            ["Superbunny Cave - Bottom", false, []],
            ["Superbunny Cave - Bottom", false, [], ['Gloves', 'Gloves']],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'Lamp']],
            ["Superbunny Cave - Bottom", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl', 'Flute']],
            ["Superbunny Cave - Bottom", true, ['Hammer', 'ProgressiveGlove', 'MoonPearl', 'Flute']],

            ["Hookshot Cave - Bottom Right", false, []],
            ["Hookshot Cave - Bottom Right", false, [], ['Gloves', 'Gloves']],
            ["Hookshot Cave - Bottom Right", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'Lamp', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'ProgressiveGlove', 'Flute', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'Hammer', 'Flute', 'PegasusBoots']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'ProgressiveGlove', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Bottom Right", true, ['PowerGlove', 'Hammer', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Bottom Left", false, []],
            ["Hookshot Cave - Bottom Left", false, [], ['Gloves', 'Gloves']],
            ["Hookshot Cave - Bottom Left", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['PowerGlove', 'ProgressiveGlove', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Bottom Left", true, ['PowerGlove', 'Hammer', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Top Left", false, []],
            ["Hookshot Cave - Top Left", false, [], ['Gloves', 'Gloves']],
            ["Hookshot Cave - Top Left", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['PowerGlove', 'ProgressiveGlove', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Top Left", true, ['PowerGlove', 'Hammer', 'Flute', 'Hookshot']],

            ["Hookshot Cave - Top Right", false, []],
            ["Hookshot Cave - Top Right", false, [], ['Gloves', 'Gloves']],
            ["Hookshot Cave - Top Right", false, [], ['PegasusBoots', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['PowerGlove', 'Lamp', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['PowerGlove', 'ProgressiveGlove', 'Flute', 'Hookshot']],
            ["Hookshot Cave - Top Right", true, ['PowerGlove', 'Hammer', 'Flute', 'Hookshot']],
        ];
    }
}
