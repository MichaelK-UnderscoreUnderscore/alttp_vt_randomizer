<?php

namespace InvertedOverworldGlitches;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group InvertedOverworldGlitches
 */
class LightWorldTest extends TestCase
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
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", false, [], ['PendantOfCourage']],
            ["Master Sword Pedestal", false, [], ['PendantOfWisdom']],
            ["Master Sword Pedestal", false, [], ['PendantOfPower']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'PegasusBoots']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MagicMirror', 'PegasusBoots']],

            ["Link's Uncle", false, []],
            ["Link's Uncle", false, [], ['MoonPearl', 'MagicMirror']],
            ["Link's Uncle", true, ['MoonPearl', 'PegasusBoots']],

            ["Secret Passage", false, []],
            ["Secret Passage", false, [], ['MoonPearl', 'MagicMirror']],
            ["Secret Passage", true, ['MoonPearl', 'PegasusBoots']],

            ["King's Tomb", false, []],
            ["King's Tomb", false, [], ['PegasusBoots']],
            ["King's Tomb", false, [], ['MoonPearl']],
            ["King's Tomb", true, ['PegasusBoots', 'MagicMirror', 'MoonPearl']],

            ["Floodgate Chest", false, []],
            ["Floodgate Chest", true, ['MoonPearl', 'PegasusBoots']],
            ["Floodgate Chest", true, ['MagicMirror', 'PegasusBoots']],

            ["Kakariko Tavern", false, []],
            ["Kakariko Tavern", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Tavern", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Tavern", true, ['DefeatAgahnim']],
            
            ["Chicken House", false, []],
            ["Chicken House", false, [], ['MoonPearl']],
            ["Chicken House", true, ['MoonPearl', 'PegasusBoots']],

            ["Aginah's Cave", false, []],
            ["Aginah's Cave", false, [], ['MoonPearl']],
            ["Aginah's Cave", true, ['MoonPearl', 'PegasusBoots']],

            ["Sahasrahla's Hut - Left", false, []],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Left", true, ['DefeatAgahnim']],

            ["Sahasrahla's Hut - Middle", false, []],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Middle", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Middle", true, ['DefeatAgahnim']],

            ["Sahasrahla's Hut - Right", false, []],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Sahasrahla's Hut - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Sahasrahla's Hut - Right", true, ['DefeatAgahnim']],

            ["Kakariko Well - Top", false, []],
            ["Kakariko Well - Top", false, [], ['MoonPearl']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Kakariko Well - Left", false, []],
            ["Kakariko Well - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Left", true, ['DefeatAgahnim']],

            ["Kakariko Well - Middle", false, []],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Middle", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Middle", true, ['DefeatAgahnim']],

            ["Kakariko Well - Right", false, []],
            ["Kakariko Well - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Right", true, ['DefeatAgahnim']],

            ["Kakariko Well - Bottom", false, []],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'PegasusBoots']],
            ["Kakariko Well - Bottom", true, ['MagicMirror', 'PegasusBoots']],
            ["Kakariko Well - Bottom", true, ['DefeatAgahnim']],

            ["Blind's Hideout - Top", false, []],
            ["Blind's Hideout - Top", false, [], ['MoonPearl']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'PegasusBoots']],

            ["Blind's Hideout - Left", false, []],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Left", true, ['DefeatAgahnim']],

            ["Blind's Hideout - Right", false, []],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Right", true, ['DefeatAgahnim']],

            ["Blind's Hideout - Far Left", false, []],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Far Left", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Far Left", true, ['DefeatAgahnim']],

            ["Blind's Hideout - Far Right", false, []],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Blind's Hideout - Far Right", true, ['MagicMirror', 'PegasusBoots']],
            ["Blind's Hideout - Far Right", true, ['DefeatAgahnim']],

            ["Pegasus Rocks", false, []],
            ["Pegasus Rocks", false, [], ['PegasusBoots']],
            ["Pegasus Rocks", false, [], ['MoonPearl']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'PegasusBoots']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Far Left", false, []],
            ["Mini Moldorm Cave - Far Left", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Left", false, []],
            ["Mini Moldorm Cave - Left", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'PegasusBoots']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Right", false, []],
            ["Mini Moldorm Cave - Right", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Far Right", false, []],
            ["Mini Moldorm Cave - Far Right", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'PegasusBoots']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'TitansMitt']],

            ["Ice Rod Cave", false, []],
            ["Ice Rod Cave", false, [], ['MoonPearl']],
            ["Ice Rod Cave", true, ['MoonPearl', 'PegasusBoots']],
            ["Ice Rod Cave", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Ice Rod Cave", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Ice Rod Cave", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Ice Rod Cave", true, ['MoonPearl', 'TitansMitt']],

            ["Bottle Merchant", false, []],
            ["Bottle Merchant", true, ['PegasusBoots']],
            ["Bottle Merchant", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Bottle Merchant", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Bottle Merchant", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bottle Merchant", true, ['MoonPearl', 'TitansMitt']],

            ["Sahasrahla", false, []],
            ["Sahasrahla", false, [], ['PendantOfCourage']],
            ["Sahasrahla", true, ['PendantOfCourage', 'PegasusBoots']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'TitansMitt']],

            ["Magic Bat", false, []],
            ["Magic Bat", false, [], ['Powder']],
            ["Magic Bat", false, [], ['Hammer']],
            ["Magic Bat", false, [], ['MoonPearl']],
            ["Magic Bat", false, ['Powder', 'Hammer', 'MoonPearl']],
            ["Magic Bat", true, ['Powder', 'Hammer', 'MoonPearl', 'PegasusBoots']],
            ["Magic Bat", true, ['Powder', 'Hammer', 'MoonPearl', 'ProgressiveGlove']],
            ["Magic Bat", true, ['Powder', 'Hammer', 'MoonPearl', 'PowerGlove']],
            ["Magic Bat", true, ['Powder', 'Hammer', 'MoonPearl', 'TitansMitt']],

            ["Sick Kid", false, []],
            ["Sick Kid", false, [], ['AnyBottle']],
            ["Sick Kid", false, ['BottleWithBee']],
            ["Sick Kid", false, ['BottleWithFairy']],
            ["Sick Kid", false, ['BottleWithRedPotion']],
            ["Sick Kid", false, ['BottleWithGreenPotion']],
            ["Sick Kid", false, ['BottleWithBluePotion']],
            ["Sick Kid", false, ['Bottle']],
            ["Sick Kid", false, ['BottleWithGoldBee']],
            ["Sick Kid", true, ['BottleWithBee', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithFairy', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['Bottle', 'PegasusBoots']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'PegasusBoots']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'TitansMitt']],

            ["Hobo", false, []],
            ["Hobo", false, [], ['Flippers']],
            ["Hobo", false, [], ['Flippers', 'MoonPearl']],
            ["Hobo", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Hobo", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Hobo", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Hobo", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Hobo", true, ['Flippers', 'MoonPearl', 'TitansMitt']],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", false, [], ['UpgradedSword']],
            ["Bombos Tablet", false, [], ['BookOfMudora']],
            ["Bombos Tablet", false, [], ['MoonPearl', 'PegasusBoots']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'ProgressiveGlove', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl','BookOfMudora', 'ProgressiveGlove', 'ProgressiveGlove', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'ProgressiveGlove', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'ProgressiveGlove', 'L4Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'TitansMitt', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'TitansMitt', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'TitansMitt', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'TitansMitt', 'L4Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'Hammer', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'Hammer', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'Hammer', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'ProgressiveGlove', 'Hammer', 'L4Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PowerGlove', 'Hammer', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PowerGlove', 'Hammer', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PowerGlove', 'Hammer', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PowerGlove', 'Hammer', 'L4Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'ProgressiveSword', 'ProgressiveSword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L2Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L3Sword']],
            ["Bombos Tablet", true, ['MoonPearl', 'BookOfMudora', 'PegasusBoots', 'L4Sword']],

            ["King Zora", false, []],
            ["King Zora", false, [], ['Gloves', 'Flippers']],
            ["King Zora", false, [], ['MoonPearl']],
            ["King Zora", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["King Zora", true, ['ProgressiveGlove', 'MoonPearl', 'Hammer']],
            ["King Zora", true, ['PowerGlove', 'MoonPearl', 'Hammer']],
            ["King Zora", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["King Zora", true, ['TitansMitt', 'MoonPearl']],

            ["Lost Woods Hideout", false, []],
            ["Lost Woods Hideout", false, [], ['MoonPearl']],
            ["Lost Woods Hideout", true, ['MoonPearl', 'PegasusBoots']],
            ["Lost Woods Hideout", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Lost Woods Hideout", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Lost Woods Hideout", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Lost Woods Hideout", true, ['MoonPearl', 'TitansMitt']],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", false, [], ['PegasusBoots']],
            ["Lumberjack Tree", false, [], ['PegasusBoots']],
            ["Lumberjack Tree", false, [], ['MoonPearl']],
            ["Lumberjack Tree", true, ['PegasusBoots', 'PegasusBoots', 'MoonPearl']],

            ["Cave 45", false, []],
            ["Cave 45", false, [], ['MoonPearl']],
            ["Cave 45", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Cave 45", true, ['MoonPearl',  'TitansMitt']],
            ["Cave 45", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'PegasusBoots']],

            ["Graveyard Ledge", false, []],
            ["Graveyard Ledge", false, [], ['MoonPearl']],
            ["Graveyard Ledge", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Graveyard Ledge", true, ['MoonPearl', 'TitansMitt']],
            ["Graveyard Ledge", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Graveyard Ledge", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Graveyard Ledge", true, ['MoonPearl', 'PegasusBoots']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", false, [], ['Gloves']],
            ["Checkerboard Cave", false, [], ['MoonPearl']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'PegasusBoots', 'MoonPearl']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'Hammer', 'MoonPearl']],
            ["Checkerboard Cave", true, ['PowerGlove', 'Hammer', 'MoonPearl']],
            ["Checkerboard Cave", true, ['ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["Checkerboard Cave", true, ['TitansMitt', 'MoonPearl']],

            ["Mini Moldorm Cave - NPC", false, []],
            ["Mini Moldorm Cave - NPC", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'PegasusBoots']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - NPC", true, ['MoonPearl', 'TitansMitt']],

            ["Library", false, []],
            ["Library", false, [], ['PegasusBoots']],
            ["Library", false, [], ['MoonPearl']],
            ["Library", true, ['PegasusBoots', 'MoonPearl', 'PegasusBoots']],
            ["Library", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Library", true, ['PegasusBoots', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Library", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Library", true, ['PegasusBoots', 'MoonPearl', 'TitansMitt']],

            ["Mushroom", false, []],
            ["Mushroom", false, [], ['MoonPearl']],
            ["Mushroom", true, ['MoonPearl', 'PegasusBoots']],
            ["Mushroom", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mushroom", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mushroom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mushroom", true, ['MoonPearl', 'TitansMitt']],

            ["Potion Shop", false, []],
            ["Potion Shop", false, [], ['Mushroom']],
            ["Potion Shop", false, [], ['MoonPearl']],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'PegasusBoots']],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Potion Shop", true, ['Mushroom', 'MoonPearl', 'TitansMitt']],

            ["Maze Race", false, []],
            ["Maze Race", false, [], ['MoonPearl']],
            ["Maze Race", true, ['MoonPearl', 'PegasusBoots']],
            ["Maze Race", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Maze Race", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Maze Race", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Maze Race", true, ['MoonPearl', 'TitansMitt']],

            ["Desert Ledge", false, []],
            ["Desert Ledge", false, [], ['BookOfMudora']],
            ["Desert Ledge", false, [], ['MoonPearl']],
            ["Desert Ledge", true, ['BookOfMudora', 'MoonPearl', 'PegasusBoots']],
            ["Desert Ledge", true, ['BookOfMudora', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Desert Ledge", true, ['BookOfMudora', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Desert Ledge", true, ['BookOfMudora', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Ledge", true, ['BookOfMudora', 'MoonPearl', 'TitansMitt']],

            ["Lake Hylia Island", false, []],
            ["Lake Hylia Island", false, [], ['MoonPearl']],
            ["Lake Hylia Island", false, [], ['Flippers']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'TitansMitt']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],

            ["Sunken Treasure", false, []],
            ["Sunken Treasure", false, [], ['MoonPearl']],
            ["Sunken Treasure", true, ['MoonPearl', 'PegasusBoots']],
            ["Sunken Treasure", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sunken Treasure", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sunken Treasure", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sunken Treasure", true, ['MoonPearl', 'TitansMitt']],

            ["Zora's Ledge", false, []],
            ["Zora's Ledge", false, [], ['Flippers']],
            ["Zora's Ledge", false, [], ['MoonPearl']],
            ["Zora's Ledge", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Zora's Ledge", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Zora's Ledge", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Zora's Ledge", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Zora's Ledge", true, ['Flippers', 'MoonPearl', 'TitansMitt']],

            ["Flute Spot", false, []],
            ["Flute Spot", false, [], ['Shovel']],
            ["Flute Spot", false, [], ['MoonPearl']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'PegasusBoots']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Flute Spot", true, ['Shovel', 'MoonPearl', 'TitansMitt']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", false, [], ['Flippers']],
            ["Waterfall Fairy - Left", false, [], ['MoonPearl']],
            ["Waterfall Fairy - Left", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Left", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Left", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Left", true, ['Flippers', 'MoonPearl', 'TitansMitt']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", false, [], ['Flippers']],
            ["Waterfall Fairy - Right", false, [], ['MoonPearl']],
            ["Waterfall Fairy - Right", true, ['Flippers', 'MoonPearl', 'PegasusBoots']],
            ["Waterfall Fairy - Right", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['Flippers', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Waterfall Fairy - Right", true, ['Flippers', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Waterfall Fairy - Right", true, ['Flippers', 'MoonPearl', 'TitansMitt']],

            ["Bomb Merchant", false, []],
            ["Bomb Merchant", false, [], ['Crystal5']],
            ["Bomb Merchant", false, [], ['Crystal6']],
            ["Bomb Merchant", false, [], ['MoonPearl']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'PegasusBoots']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl', 'TitansMitt']],
            
            ["Ganon", false, []],
            ["Ganon", false, [], ['MoonPearl']],
            ["Ganon", false, [], ['PegasusBoots2']],
        ];
    }
}
