<?php

namespace Inverted;

use ALttP\Item;
use ALttP\World;
use TestCase;

/**
 * @group Inverted
 */
class LightWorldTest extends TestCase
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
            ["Master Sword Pedestal", false, []],
            ["Master Sword Pedestal", false, [], ['PendantOfCourage']],
            ["Master Sword Pedestal", false, [], ['PendantOfWisdom']],
            ["Master Sword Pedestal", false, [], ['PendantOfPower']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'DefeatAgahnim']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Master Sword Pedestal", true, ['PendantOfCourage', 'PendantOfWisdom', 'PendantOfPower', 'MoonPearl', 'TitansMitt']],

            ["Link's Uncle", false, []],
            ["Link's Uncle", false, [], ['MoonPearl']],
            ["Link's Uncle", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Link's Uncle", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Link's Uncle", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Link's Uncle", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Link's Uncle", true, ['MoonPearl', 'TitansMitt']],

            ["Secret Passage", false, []],
            ["Secret Passage", false, [], ['MoonPearl']],
            ["Secret Passage", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Secret Passage", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Secret Passage", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Secret Passage", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Secret Passage", true, ['MoonPearl', 'TitansMitt']],

            ["King's Tomb", false, []],
            ["King's Tomb", false, [], ['PegasusBoots']],
            ["King's Tomb", false, [], ['TitansMitt']],
            ["King's Tomb", false, [], ['MoonPearl']],
            ["King's Tomb", true, ['PegasusBoots', 'ProgressiveGlove', 'ProgressiveGlove', 'MoonPearl']],
            ["King's Tomb", true, ['PegasusBoots', 'TitansMitt', 'MoonPearl']],

            ["Floodgate Chest", false, []],
            ["Floodgate Chest", false, [], ['MoonPearl']],
            ["Floodgate Chest", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Floodgate Chest", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Floodgate Chest", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Floodgate Chest", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Floodgate Chest", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Tavern", false, []],
            ["Kakariko Tavern", false, [], ['MoonPearl']],
            ["Kakariko Tavern", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Tavern", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Tavern", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Tavern", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Tavern", true, ['MoonPearl', 'TitansMitt']],
			
            ["Chicken House", false, []],
            ["Chicken House", false, [], ['MoonPearl']],
            ["Chicken House", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Chicken House", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Chicken House", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Chicken House", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Chicken House", true, ['MoonPearl', 'TitansMitt']],

            ["Aginah's Cave", false, []],
            ["Aginah's Cave", false, [], ['MoonPearl']],
            ["Aginah's Cave", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Aginah's Cave", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Aginah's Cave", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Aginah's Cave", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Aginah's Cave", true, ['MoonPearl', 'TitansMitt']],

            ["Sahasrahla's Hut - Left", false, []],
            ["Sahasrahla's Hut - Left", false, [], ['MoonPearl']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sahasrahla's Hut - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Sahasrahla's Hut - Middle", false, []],
            ["Sahasrahla's Hut - Middle", false, [], ['MoonPearl']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sahasrahla's Hut - Middle", true, ['MoonPearl', 'TitansMitt']],

            ["Sahasrahla's Hut - Right", false, []],
            ["Sahasrahla's Hut - Right", false, [], ['MoonPearl']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sahasrahla's Hut - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Well - Top", false, []],
            ["Kakariko Well - Top", false, [], ['MoonPearl']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Well - Top", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Well - Left", false, []],
            ["Kakariko Well - Left", false, [], ['MoonPearl']],
            ["Kakariko Well - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Well - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Well - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Well - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Well - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Well - Middle", false, []],
            ["Kakariko Well - Middle", false, [], ['MoonPearl']],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Well - Middle", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Well - Right", false, []],
            ["Kakariko Well - Right", false, [], ['MoonPearl']],
            ["Kakariko Well - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Well - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Well - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Well - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Well - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Kakariko Well - Bottom", false, []],
            ["Kakariko Well - Bottom", false, [], ['MoonPearl']],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Kakariko Well - Bottom", true, ['MoonPearl', 'TitansMitt']],

            ["Blind's Hideout - Top", false, []],
            ["Blind's Hideout - Top", false, [], ['MoonPearl']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blind's Hideout - Top", true, ['MoonPearl', 'TitansMitt']],

            ["Blind's Hideout - Left", false, []],
            ["Blind's Hideout - Left", false, [], ['MoonPearl']],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blind's Hideout - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Blind's Hideout - Right", false, []],
            ["Blind's Hideout - Right", false, [], ['MoonPearl']],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blind's Hideout - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Blind's Hideout - Far Left", false, []],
            ["Blind's Hideout - Far Left", false, [], ['MoonPearl']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blind's Hideout - Far Left", true, ['MoonPearl', 'TitansMitt']],

            ["Blind's Hideout - Far Right", false, []],
            ["Blind's Hideout - Far Right", false, [], ['MoonPearl']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Blind's Hideout - Far Right", true, ['MoonPearl', 'TitansMitt']],

            ["Pegasus Rocks", false, []],
            ["Pegasus Rocks", false, [], ['PegasusBoots']],
            ["Pegasus Rocks", false, [], ['MoonPearl']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'DefeatAgahnim']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Pegasus Rocks", true, ['PegasusBoots', 'MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Far Left", false, []],
            ["Mini Moldorm Cave - Far Left", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Far Left", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Left", false, []],
            ["Mini Moldorm Cave - Left", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Left", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Right", false, []],
            ["Mini Moldorm Cave - Right", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Right", true, ['MoonPearl', 'TitansMitt']],

            ["Mini Moldorm Cave - Far Right", false, []],
            ["Mini Moldorm Cave - Far Right", false, [], ['MoonPearl']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Mini Moldorm Cave - Far Right", true, ['MoonPearl', 'TitansMitt']],

            ["Ice Rod Cave", false, []],
            ["Ice Rod Cave", false, [], ['MoonPearl']],
            ["Ice Rod Cave", true, ['MoonPearl', 'DefeatAgahnim']],
            ["Ice Rod Cave", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Ice Rod Cave", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Ice Rod Cave", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Ice Rod Cave", true, ['MoonPearl', 'TitansMitt']],

            ["Bottle Merchant", false, []],
            ["Bottle Merchant", true, ['DefeatAgahnim']],
            ["Bottle Merchant", true, ['MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Bottle Merchant", true, ['MoonPearl', 'PowerGlove', 'Hammer']],
            ["Bottle Merchant", true, ['MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bottle Merchant", true, ['MoonPearl', 'TitansMitt']],

            ["Sahasrahla", false, []],
            ["Sahasrahla", false, [], ['PendantOfCourage']],
            ["Sahasrahla", true, ['PendantOfCourage', 'DefeatAgahnim']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sahasrahla", true, ['PendantOfCourage', 'MoonPearl', 'TitansMitt']],

            ["Magic Bat", false, []],
            ["Magic Bat", false, [], ['Powder']],
            ["Magic Bat", false, [], ['Hammer']],
            ["Magic Bat", false, [], ['MoonPearl']],
            ["Magic Bat", false, ['Powder', 'Hammer', 'MoonPearl']],
            ["Magic Bat", true, ['Powder', 'Hammer', 'MoonPearl', 'DefeatAgahnim']],
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
            ["Sick Kid", true, ['BottleWithBee', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithBee', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithFairy', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithFairy', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithRedPotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithGreenPotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithBluePotion', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['Bottle', 'DefeatAgahnim']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['Bottle', 'MoonPearl', 'TitansMitt']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'DefeatAgahnim']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'ProgressiveGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'PowerGlove', 'Hammer']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Sick Kid", true, ['BottleWithGoldBee', 'MoonPearl', 'TitansMitt']],

            ["Hobo", false, []],
            ["Hobo", false, [], ['Flippers']],
            ["Hobo", true, ['Flippers']],

            ["Bombos Tablet", false, []],
            ["Bombos Tablet", false, [], ['MagicMirror']],
            ["Bombos Tablet", false, [], ['UpgradedSword']],
            ["Bombos Tablet", false, [], ['BookOfMudora']],
            ["Bombos Tablet", false, [], ['MoonPearl']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'TitansMitt']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'ProgressiveGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'PowerGlove', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'Hammer']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'ProgressiveSword', 'ProgressiveSword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L2Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L3Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],
            ["Bombos Tablet", true, ['MoonPearl', 'MagicMirror', 'BookOfMudora', 'L4Sword', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

            ["King Zora", false, []],
            ["King Zora", false, [], ['Gloves', 'Flippers']],
            ["King Zora", true, ['Flippers']],
            ["King Zora", true, ['ProgressiveGlove']],
            ["King Zora", true, ['PowerGlove']],
            ["King Zora", true, ['TitansMitt']],

            ["Lost Woods Hideout", true, []],

            ["Lumberjack Tree", false, []],
            ["Lumberjack Tree", false, [], ['PegasusBoots']],
            ["Lumberjack Tree", false, [], ['DefeatAgahnim']],
            ["Lumberjack Tree", true, ['PegasusBoots', 'DefeatAgahnim']],

            ["Cave 45", false, []],
            ["Cave 45", false, [], ['MagicMirror']],
            ["Cave 45", false, [], ['MoonPearl']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Cave 45", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

            ["Graveyard Ledge", false, []],
            ["Graveyard Ledge", false, [], ['MagicMirror']],
            ["Graveyard Ledge", false, [], ['MoonPearl']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Hammer', 'Hookshot']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'ProgressiveGlove', 'Hookshot']],
            ["Graveyard Ledge", true, ['MoonPearl', 'MagicMirror', 'DefeatAgahnim', 'Flippers', 'Hookshot']],

            ["Checkerboard Cave", false, []],
            ["Checkerboard Cave", false, [], ['Gloves']],
            ["Checkerboard Cave", false, [], ['Flute']],
            ["Checkerboard Cave", false, [], ['MagicMirror']],
            ["Checkerboard Cave", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Checkerboard Cave", true, ['Flute', 'MagicMirror', 'TitansMitt']],

            ["Mini Moldorm Cave - NPC", true, []],

            ["Library", false, []],
            ["Library", false, [], ['PegasusBoots']],
            ["Library", true, ['PegasusBoots']],

            ["Mushroom", true, []],

            ["Potion Shop", false, []],
            ["Potion Shop", false, [], ['Mushroom']],
            ["Potion Shop", true, ['Mushroom']],

            ["Maze Race", true, []],

            ["Desert Ledge", false, []],
            ["Desert Ledge", true, ['BookOfMudora']],
            ["Desert Ledge", true, ['Flute', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Desert Ledge", true, ['Flute', 'MagicMirror', 'TitansMitt']],

            ["Lake Hylia Island", false, []],
            ["Lake Hylia Island", false, [], ['MagicMirror']],
            ["Lake Hylia Island", false, [], ['MoonPearl']],
            ["Lake Hylia Island", false, [], ['Flippers']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'ProgressiveGlove']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'TitansMitt']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'ProgressiveGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'PowerGlove', 'Hammer']],
            ["Lake Hylia Island", true, ['Flippers', 'MoonPearl', 'MagicMirror', 'DefeatAgahnim']],

            ["Sunken Treasure", true, []],

            ["Zora's Ledge", false, []],
            ["Zora's Ledge", false, [], ['Flippers']],
            ["Zora's Ledge", true, ['Flippers']],

            ["Flute Spot", false, []],
            ["Flute Spot", false, [], ['Shovel']],
            ["Flute Spot", true, ['Shovel']],

            ["Waterfall Fairy - Left", false, []],
            ["Waterfall Fairy - Left", false, [], ['Flippers']],
            ["Waterfall Fairy - Left", true, ['Flippers']],

            ["Waterfall Fairy - Right", false, []],
            ["Waterfall Fairy - Right", false, [], ['Flippers']],
            ["Waterfall Fairy - Right", true, ['Flippers']],

            ["Bomb Merchant", false, []],
            ["Bomb Merchant", false, [], ['Crystal5']],
            ["Bomb Merchant", false, [], ['Crystal6']],
            ["Bomb Merchant", false, [], ['MoonPearl']],
            ["Bomb Merchant", true, ['Crystal5', 'Crystal6', 'MoonPearl']],
        ];
    }
}
