<?php

namespace InvertedMajorGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedMajorGlitches
 */
class LightWorldTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->world = World::factory('inverted', ['difficulty' => 'test_rules', 'logic' => 'MajorGlitches']);
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
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", false, [], ['PendantOfCourage']],
            ["Master Sword Pedestal", false, [], ['PendantOfWisdom']],
            ["Master Sword Pedestal", false, [], ['PendantOfPower']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower']],

            ["Link's Uncle", false, []],
            ["Link's Uncle", false, [], ['MoonPearl', 'MagicMirror', 'AnyBottle']],
            ["Link's Uncle", true, ['MoonPearl']],
            ["Link's Uncle", true, ['BottleWithBee']],
            ["Link's Uncle", true, ['BottleWithFairy']],
            ["Link's Uncle", true, ['BottleWithRedPotion']],
            ["Link's Uncle", true, ['BottleWithGreenPotion']],
            ["Link's Uncle", true, ['BottleWithBluePotion']],
            ["Link's Uncle", true, ['Bottle']],
            ["Link's Uncle", true, ['BottleWithGoldBee']],

            ["Secret Passage", false, []],
            ["Secret Passage", false, [], ['MoonPearl', 'MagicMirror', 'AnyBottle']],
            ["Secret Passage", true, ['MoonPearl']],
            ["Secret Passage", true, ['BottleWithBee']],
            ["Secret Passage", true, ['BottleWithFairy']],
            ["Secret Passage", true, ['BottleWithRedPotion']],
            ["Secret Passage", true, ['BottleWithGreenPotion']],
            ["Secret Passage", true, ['BottleWithBluePotion']],
            ["Secret Passage", true, ['Bottle']],
            ["Secret Passage", true, ['BottleWithGoldBee']],

            ["King's Tomb", false, []],
            ["King's Tomb", false, [], ['PegasusBoots']],
            ["King's Tomb", false, [], ['MoonPearl', 'AnyBottle']],
            ["King's Tomb", true, ['PegasusBoots', 'MoonPearl']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithBee']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithFairy']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithRedPotion']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithGreenPotion']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithBluePotion']],
            ["King's Tomb", true, ['PegasusBoots', 'Bottle']],
            ["King's Tomb", true, ['PegasusBoots', 'BottleWithGoldBee']],

            ["Floodgate Chest", false, []],
            ["Floodgate Chest", true, ['MoonPearl']],
            ["Floodgate Chest", true, ['MagicMirror']],
            ["Floodgate Chest", true, ['BottleWithBee']],
            ["Floodgate Chest", true, ['BottleWithFairy']],
            ["Floodgate Chest", true, ['BottleWithRedPotion']],
            ["Floodgate Chest", true, ['BottleWithGreenPotion']],
            ["Floodgate Chest", true, ['BottleWithBluePotion']],
            ["Floodgate Chest", true, ['Bottle']],
            ["Floodgate Chest", true, ['BottleWithGoldBee']],

            ["Kakariko Tavern", true, []],
            
            ["Chicken House", false, []],
            ["Chicken House", false, [], ['MoonPearl', 'AnyBottle']],
            ["Chicken House", true, ['MoonPearl']],
            ["Chicken House", true, ['BottleWithBee']],
            ["Chicken House", true, ['BottleWithFairy']],
            ["Chicken House", true, ['BottleWithRedPotion']],
            ["Chicken House", true, ['BottleWithGreenPotion']],
            ["Chicken House", true, ['BottleWithBluePotion']],
            ["Chicken House", true, ['Bottle']],
            ["Chicken House", true, ['BottleWithGoldBee']],

            ["Aginah's Cave", false, []],
            ["Aginah's Cave", false, [], ['MoonPearl', 'AnyBottle']],
            ["Aginah's Cave", true, ['MoonPearl']],
            ["Aginah's Cave", true, ['BottleWithBee']],
            ["Aginah's Cave", true, ['BottleWithFairy']],
            ["Aginah's Cave", true, ['BottleWithRedPotion']],
            ["Aginah's Cave", true, ['BottleWithGreenPotion']],
            ["Aginah's Cave", true, ['BottleWithBluePotion']],
            ["Aginah's Cave", true, ['Bottle']],
            ["Aginah's Cave", true, ['BottleWithGoldBee']],
            
            ["Sahasrahla's Hut - Left", false, []],
            ["Sahasrahla's Hut - Left", false, [], ['MoonPearl', 'PegasusBoots', 'AnyBottle']],
            ["Sahasrahla's Hut - Left", true, ['PegasusBoots']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithBee']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithFairy']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithRedPotion']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithGreenPotion']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithBluePotion']],
            ["Sahasrahla's Hut - Left", true, ['Bottle']],
            ["Sahasrahla's Hut - Left", true, ['BottleWithGoldBee']],
            
            ["Sahasrahla's Hut - Middle", false, []],
            ["Sahasrahla's Hut - Middle", false, [], ['MoonPearl', 'PegasusBoots', 'AnyBottle']],
            ["Sahasrahla's Hut - Middle", true, ['PegasusBoots']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithBee']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithFairy']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithRedPotion']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithGreenPotion']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithBluePotion']],
            ["Sahasrahla's Hut - Middle", true, ['Bottle']],
            ["Sahasrahla's Hut - Middle", true, ['BottleWithGoldBee']],
            
            ["Sahasrahla's Hut - Right", false, []],
            ["Sahasrahla's Hut - Right", false, [], ['MoonPearl', 'PegasusBoots', 'AnyBottle']],
            ["Sahasrahla's Hut - Right", true, ['PegasusBoots']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithBee']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithFairy']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithRedPotion']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithGreenPotion']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithBluePotion']],
            ["Sahasrahla's Hut - Right", true, ['Bottle']],
            ["Sahasrahla's Hut - Right", true, ['BottleWithGoldBee']],

            ["Kakariko Well - Top", false, []],
            ["Kakariko Well - Top", false, [], ['MoonPearl', 'AnyBottle']],
            ["Kakariko Well - Top", true, ['MoonPearl']],
            ["Kakariko Well - Top", true, ['BottleWithBee']],
            ["Kakariko Well - Top", true, ['BottleWithFairy']],
            ["Kakariko Well - Top", true, ['BottleWithRedPotion']],
            ["Kakariko Well - Top", true, ['BottleWithGreenPotion']],
            ["Kakariko Well - Top", true, ['BottleWithBluePotion']],
            ["Kakariko Well - Top", true, ['Bottle']],
            ["Kakariko Well - Top", true, ['BottleWithGoldBee']],

            ["Kakariko Well - Left", true, []],

            ["Kakariko Well - Middle", true, []],

            ["Kakariko Well - Right", true, []],

            ["Kakariko Well - Bottom", true, []],

            ["Blind's Hideout - Top", false, []],
            ["Blind's Hideout - Top", false, [], ['MoonPearl', 'AnyBottle']],
            ["Blind's Hideout - Top", true, ['MoonPearl']],
            ["Blind's Hideout - Top", true, ['BottleWithBee']],
            ["Blind's Hideout - Top", true, ['BottleWithFairy']],
            ["Blind's Hideout - Top", true, ['BottleWithRedPotion']],
            ["Blind's Hideout - Top", true, ['BottleWithGreenPotion']],
            ["Blind's Hideout - Top", true, ['BottleWithBluePotion']],
            ["Blind's Hideout - Top", true, ['Bottle']],
            ["Blind's Hideout - Top", true, ['BottleWithGoldBee']],

            ["Blind's Hideout - Left", false, []],
            ["Blind's Hideout - Left", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Blind's Hideout - Left", true, ['MagicMirror']],
            ["Blind's Hideout - Left", true, ['MoonPearl']],
            ["Blind's Hideout - Left", true, ['BottleWithBee']],
            ["Blind's Hideout - Left", true, ['BottleWithFairy']],
            ["Blind's Hideout - Left", true, ['BottleWithRedPotion']],
            ["Blind's Hideout - Left", true, ['BottleWithGreenPotion']],
            ["Blind's Hideout - Left", true, ['BottleWithBluePotion']],
            ["Blind's Hideout - Left", true, ['Bottle']],
            ["Blind's Hideout - Left", true, ['BottleWithGoldBee']],

            ["Blind's Hideout - Right", false, []],
            ["Blind's Hideout - Right", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Blind's Hideout - Right", true, ['MagicMirror']],
            ["Blind's Hideout - Right", true, ['MoonPearl']],
            ["Blind's Hideout - Right", true, ['BottleWithBee']],
            ["Blind's Hideout - Right", true, ['BottleWithFairy']],
            ["Blind's Hideout - Right", true, ['BottleWithRedPotion']],
            ["Blind's Hideout - Right", true, ['BottleWithGreenPotion']],
            ["Blind's Hideout - Right", true, ['BottleWithBluePotion']],
            ["Blind's Hideout - Right", true, ['Bottle']],
            ["Blind's Hideout - Right", true, ['BottleWithGoldBee']],

            ["Blind's Hideout - Far Left", false, []],
            ["Blind's Hideout - Far Left", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Blind's Hideout - Far Left", true, ['MagicMirror']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl']],
            ["Blind's Hideout - Far Left", true, ['BottleWithBee']],
            ["Blind's Hideout - Far Left", true, ['BottleWithFairy']],
            ["Blind's Hideout - Far Left", true, ['BottleWithRedPotion']],
            ["Blind's Hideout - Far Left", true, ['BottleWithGreenPotion']],
            ["Blind's Hideout - Far Left", true, ['BottleWithBluePotion']],
            ["Blind's Hideout - Far Left", true, ['Bottle']],
            ["Blind's Hideout - Far Left", true, ['BottleWithGoldBee']],

            ["Blind's Hideout - Far Right", false, []],
            ["Blind's Hideout - Far Right", false, [], ['MoonPearl', 'AnyBottle', 'MagicMirror']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl']],
            ["Blind's Hideout - Far Right", true, ['MagicMirror']],
            ["Blind's Hideout - Far Right", true, ['BottleWithBee']],
            ["Blind's Hideout - Far Right", true, ['BottleWithFairy']],
            ["Blind's Hideout - Far Right", true, ['BottleWithRedPotion']],
            ["Blind's Hideout - Far Right", true, ['BottleWithGreenPotion']],
            ["Blind's Hideout - Far Right", true, ['BottleWithBluePotion']],
            ["Blind's Hideout - Far Right", true, ['Bottle']],
            ["Blind's Hideout - Far Right", true, ['BottleWithGoldBee']],

            ["Pegasus Rocks", false, []],
            ["Pegasus Rocks", false, [], ['PegasusBoots']],
            ["Pegasus Rocks", false, [], ['MoonPearl', 'AnyBottle']],
            ["Pegasus Rocks", true, ['MoonPearl', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithBee', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithFairy', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithRedPotion', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithGreenPotion', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithBluePotion', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['Bottle', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['BottleWithGoldBee', 'PegasusBoots']],

            ["Mini Moldorm Cave - Far Left", false, []],
            ["Mini Moldorm Cave - Far Left", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithBee']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithFairy']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithRedPotion']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithGreenPotion']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithBluePotion']],
            ["Mini Moldorm Cave - Far Left", true, ['Bottle']],
            ["Mini Moldorm Cave - Far Left", true, ['BottleWithGoldBee']],

            ["Mini Moldorm Cave - Left", false, []],
            ["Mini Moldorm Cave - Left", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithBee']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithFairy']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithRedPotion']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithGreenPotion']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithBluePotion']],
            ["Mini Moldorm Cave - Left", true, ['Bottle']],
            ["Mini Moldorm Cave - Left", true, ['BottleWithGoldBee']],

            ["Mini Moldorm Cave - Right", false, []],
            ["Mini Moldorm Cave - Right", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithBee']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithFairy']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithRedPotion']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithGreenPotion']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithBluePotion']],
            ["Mini Moldorm Cave - Right", true, ['Bottle']],
            ["Mini Moldorm Cave - Right", true, ['BottleWithGoldBee']],

            ["Mini Moldorm Cave - Far Right", false, []],
            ["Mini Moldorm Cave - Far Right", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithBee']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithFairy']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithRedPotion']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithGreenPotion']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithBluePotion']],
            ["Mini Moldorm Cave - Far Right", true, ['Bottle']],
            ["Mini Moldorm Cave - Far Right", true, ['BottleWithGoldBee']],

            ["Ice Rod Cave", false, []],
            ["Ice Rod Cave", false, [], ['MoonPearl', 'BigRedBomb', 'AnyBottle']],
            ["Ice Rod Cave", true, ['MoonPearl']],
            ["Ice Rod Cave", true, ['BigRedBomb', 'MagicMirror']],
            ["Ice Rod Cave", true, ['BottleWithBee']],
            ["Ice Rod Cave", true, ['BottleWithFairy']],
            ["Ice Rod Cave", true, ['BottleWithRedPotion']],
            ["Ice Rod Cave", true, ['BottleWithGreenPotion']],
            ["Ice Rod Cave", true, ['BottleWithBluePotion']],
            ["Ice Rod Cave", true, ['Bottle']],
            ["Ice Rod Cave", true, ['BottleWithGoldBee']],

            ["Bottle Merchant", true, []],

            ["Sahasrahla", false, []],
            ["Sahasrahla", false, [], ['PendantOfCourage']],
            ["Sahasrahla", true, ['PendantOfCourage']],

            ["Magic Bat", false, []],
            ["Magic Bat", false, [], ['Powder']],
            ["Magic Bat", false, [], ['MoonPearl', 'AnyBottle']],
            ["Magic Bat", true, ['Powder', 'MoonPearl']],
            ["Magic Bat", true, ['Powder', 'BottleWithBee']],
            ["Magic Bat", true, ['Powder', 'BottleWithFairy']],
            ["Magic Bat", true, ['Powder', 'BottleWithRedPotion']],
            ["Magic Bat", true, ['Powder', 'BottleWithGreenPotion']],
            ["Magic Bat", true, ['Powder', 'BottleWithBluePotion']],
            ["Magic Bat", true, ['Powder', 'Bottle']],
            ["Magic Bat", true, ['Powder', 'BottleWithGoldBee']],

            ["Sick Kid", false, []],
            ["Sick Kid", false, [], ['AnyBottle']],
            ["Sick Kid", true, ['BottleWithBee']],
            ["Sick Kid", true, ['BottleWithFairy']],
            ["Sick Kid", true, ['BottleWithRedPotion']],
            ["Sick Kid", true, ['BottleWithGreenPotion']],
            ["Sick Kid", true, ['BottleWithBluePotion']],
            ["Sick Kid", true, ['Bottle']],
            ["Sick Kid", true, ['BottleWithGoldBee']],

            ["Hobo", false, []],
            ["Hobo", false, [], ['MoonPearl', 'AnyBottle']],
            ["Hobo", true, ['MoonPearl']],
            ["Hobo", true, ['BottleWithBee']],
            ["Hobo", true, ['BottleWithFairy']],
            ["Hobo", true, ['BottleWithRedPotion']],
            ["Hobo", true, ['BottleWithGreenPotion']],
            ["Hobo", true, ['BottleWithBluePotion']],
            ["Hobo", true, ['Bottle']],
            ["Hobo", true, ['BottleWithGoldBee']],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", false, [], ['UpgradedSword']],
            ["Bombos Tablet", false, [], ['BookOfMudora']],
            ["Bombos Tablet", true, ['BookOfMudora', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L2Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L3Sword']],
            ["Bombos Tablet", true, ['BookOfMudora', 'L4Sword']],

            ["King Zora", true, []],

            ["Lost Woods Hideout", false, []],
            ["Lost Woods Hideout", false, [], ['MoonPearl', 'AnyBottle']],
            ["Lost Woods Hideout", true, ['MoonPearl']],
            ["Lost Woods Hideout", true, ['BottleWithBee']],
            ["Lost Woods Hideout", true, ['BottleWithFairy']],
            ["Lost Woods Hideout", true, ['BottleWithRedPotion']],
            ["Lost Woods Hideout", true, ['BottleWithGreenPotion']],
            ["Lost Woods Hideout", true, ['BottleWithBluePotion']],
            ["Lost Woods Hideout", true, ['Bottle']],
            ["Lost Woods Hideout", true, ['BottleWithGoldBee']],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", false, [], ['DefeatAgahnim']],
            ["Lumberjack Tree", true, ['DefeatAgahnim']],

            ["Cave 45", false, []],

            ["Graveyard Ledge", false, []],
            ["Graveyard Ledge", false, [], ['MoonPearl', 'AnyBottle']],
            ["Graveyard Ledge", true, ['MoonPearl']],
            ["Graveyard Ledge", true, ['BottleWithBee']],
            ["Graveyard Ledge", true, ['BottleWithFairy']],
            ["Graveyard Ledge", true, ['BottleWithRedPotion']],
            ["Graveyard Ledge", true, ['BottleWithGreenPotion']],
            ["Graveyard Ledge", true, ['BottleWithBluePotion']],
            ["Graveyard Ledge", true, ['Bottle']],
            ["Graveyard Ledge", true, ['BottleWithGoldBee']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", false, [], ['Gloves']],
            ["Checkerboard Cave", false, [], ['MoonPearl', 'AnyBottle']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'MoonPearl']],
            ["Checkerboard Cave", true, ['PowerGlove', 'MoonPearl']],
            ["Checkerboard Cave", true, ['TitansMitt', 'MoonPearl']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithBee']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithBee']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithBee']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithFairy']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithFairy']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithFairy']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithRedPotion']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithRedPotion']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithRedPotion']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithGreenPotion']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithGreenPotion']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithGreenPotion']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithBluePotion']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithBluePotion']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithBluePotion']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'Bottle']],
            ["Checkerboard Cave", true, ['PowerGlove', 'Bottle']],
            ["Checkerboard Cave", true, ['TitansMitt', 'Bottle']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'BottleWithGoldBee']],
            ["Checkerboard Cave", true, ['PowerGlove', 'BottleWithGoldBee']],
            ["Checkerboard Cave", true, ['TitansMitt', 'BottleWithGoldBee']],

            ["Mini Moldorm Cave - NPC", false, []],
            ["Mini Moldorm Cave - NPC", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithBee']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithFairy']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithRedPotion']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithGreenPotion']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithBluePotion']],
            ["Mini Moldorm Cave - NPC", true, ['Bottle']],
            ["Mini Moldorm Cave - NPC", true, ['BottleWithGoldBee']],

            ["Library", false, []],
            ["Library", false, [], ['PegasusBoots']],
            ["Library", true, ['PegasusBoots', 'MoonPearl']],
            ["Library", true, ['PegasusBoots', 'MagicMirror']],
            ["Library", true, ['PegasusBoots', 'BottleWithBee']],
            ["Library", true, ['PegasusBoots', 'BottleWithFairy']],
            ["Library", true, ['PegasusBoots', 'BottleWithRedPotion']],
            ["Library", true, ['PegasusBoots', 'BottleWithGreenPotion']],
            ["Library", true, ['PegasusBoots', 'BottleWithBluePotion']],
            ["Library", true, ['PegasusBoots', 'Bottle']],
            ["Library", true, ['PegasusBoots', 'BottleWithGoldBee']],

            ["Mushroom", false, []],
            ["Mushroom", false, [], ['MoonPearl', 'AnyBottle']],
            ["Mushroom", true, ['BottleWithBee']],
            ["Mushroom", true, ['BottleWithFairy']],
            ["Mushroom", true, ['BottleWithRedPotion']],
            ["Mushroom", true, ['BottleWithGreenPotion']],
            ["Mushroom", true, ['BottleWithBluePotion']],
            ["Mushroom", true, ['Bottle']],
            ["Mushroom", true, ['BottleWithGoldBee']],

            ["Potion Shop", false, []],
            ["Potion Shop", false, [], ['Mushroom']],
            ["Potion Shop", true, ['Mushroom']],

            ["Maze Race", true, []],

            ["Desert Ledge", true, []],

            ["Lake Hylia Island", true, []],

            ["Sunken Treasure", false, []],
            ["Sunken Treasure", false, [], ['MoonPearl', 'MagicMirror', 'AnyBottle']],
            ["Sunken Treasure", true, ['MoonPearl']],
            ["Sunken Treasure", true, ['MagicMirror']],
            ["Sunken Treasure", true, ['BottleWithBee']],
            ["Sunken Treasure", true, ['BottleWithFairy']],
            ["Sunken Treasure", true, ['BottleWithRedPotion']],
            ["Sunken Treasure", true, ['BottleWithGreenPotion']],
            ["Sunken Treasure", true, ['BottleWithBluePotion']],
            ["Sunken Treasure", true, ['Bottle']],
            ["Sunken Treasure", true, ['BottleWithGoldBee']],

            ["Zora's Ledge", false, []],
            ["Zora's Ledge", false, [], ['MoonPearl', 'PegasusBoots', 'Flippers']],
            ["Zora's Ledge", false, [], ['MoonPearl', 'AnyBottle']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'Flippers']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['MoonPearl', 'PegasusBoots']],

            ["Flute Spot", false, []],
            ["Flute Spot", false, [], ['Shovel']],
            ["Flute Spot", false, [], ['MoonPearl']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'PegasusBoots']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", false, [], ['MoonPearl']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", false, [], ['MoonPearl']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Bomb Merchant", false, []],
            ["Bomb Merchant", false, [], ['Crystal5']],
            ["Bomb Merchant", false, [], ['Crystal6']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'PegasusBoots']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MagicMirror', 'PegasusBoots']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'DefeatAgahnim']],
            
            ["Ganon", false, []],
        ];
    }
}
