<?php

namespace InvertedOverworldGlitches\DarkWorld;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class NorthEastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'OverworldGlitches']);
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
            ["Catfish", false, []],
            ["Catfish", true, ['PegasusBoots']],

            ["Pyramid", true, []],
			
            ["Pyramid Fairy - Sword", false, []],
            ["Pyramid Fairy - Sword", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Sword", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Sword", false, [], ['AnySword']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'UncleSword', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'UncleSword', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'UncleSword', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'UncleSword', 'MagicMirror', 'TitansMitt', 'Flippers']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'ProgressiveSword', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'ProgressiveSword', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'ProgressiveSword', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Sword", true, ['BigRedBomb', 'ProgressiveSword', 'MagicMirror', 'TitansMitt', 'Flippers']],

            ["Pyramid Fairy - Bow", false, []],
            ["Pyramid Fairy - Bow", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Bow", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Bow", false, [], ['AnyBow']],
            ["Pyramid Fairy - Bow", true, ['BigRedBomb', 'BowAndArrows', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Bow", true, ['BigRedBomb', 'BowAndArrows', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Bow", true, ['BigRedBomb', 'BowAndArrows', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Bow", true, ['BigRedBomb', 'BowAndArrows', 'MagicMirror', 'TitansMitt', 'Flippers']],

            ["Pyramid Fairy - Left", false, []],
            ["Pyramid Fairy - Left", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Left", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Left", true, ['BigRedBomb', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Left", true, ['BigRedBomb', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Left", true, ['BigRedBomb', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Left", true, ['BigRedBomb', 'MagicMirror', 'TitansMitt', 'Flippers']],

            ["Pyramid Fairy - Right", false, []],
            ["Pyramid Fairy - Right", false, [], ['MagicMirror']],
            ["Pyramid Fairy - Right", false, [], ['BigRedBomb']],
            ["Pyramid Fairy - Right", true, ['BigRedBomb', 'MagicMirror', 'Hammer']],
            ["Pyramid Fairy - Right", true, ['BigRedBomb', 'MagicMirror', 'ProgressiveGlove', 'Flippers']],
            ["Pyramid Fairy - Right", true, ['BigRedBomb', 'MagicMirror', 'PowerGlove', 'Flippers']],
            ["Pyramid Fairy - Right", true, ['BigRedBomb', 'MagicMirror', 'TitansMitt', 'Flippers']],
        ];
    }
}
