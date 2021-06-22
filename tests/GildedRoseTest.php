<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testUpdatesNormalItemsBeforeSellDate()
    {
        $items = [new Item('normal', 8, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testUpdatesNormalItemsOnSellDate()
    {
        $items = [new Item('normal', 0, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    public function testUpdatesNormalItemsAfterSellDate()
    {
        $items = [new Item('normal', -10, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-11, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    public function testUpdatesNormalItemsQualityEqualsTo0()
    {
        $items = [new Item('normal', 10, 0)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsBeforeSellDate()
    {
        $items = [new Item('Aged Brie', 8, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsBeforeSellDateCloseToMaxQuality()
    {
        $items = [new Item('Aged Brie', 8, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsBeforeSellDateMaxQuality()
    {
        $items = [new Item('Aged Brie', 8, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsOnSellDate()
    {
        $items = [new Item('Aged Brie', 0, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsOnSellDateCloseToMaxQuality()
    {
        $items = [new Item('Aged Brie', 0, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsOnSellDateMaxQuality()
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsAfterSellDate()
    {
        $items = [new Item('Aged Brie', -4, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsAfterSellDateCloseToMaxQuality()
    {
        $items = [new Item('Aged Brie', -4, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesAgedBrieItemsAfterSellDateMaxQuality()
    {
        $items = [new Item('Aged Brie', -4, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesSulfurasItemsBeforeSellDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(5, $items[0]->sell_in);
        $this->assertSame(10, $items[0]->quality);
    }

    public function testUpdatesSulfurasItemsOnSellDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(10, $items[0]->quality);
    }

    public function testUpdatesSulfurasAfterSellDate()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', -5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(10, $items[0]->quality);
    }

    /**
     * "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches;
     * Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less
     * Quality drops to 0 after the concert
     */

    public function testUpdatesBackstagePassItemsSellDateLongerThan10Days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(11, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsSellDateLessOrEqual10Days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsSellDateLessOrEqual5Days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsSellDateLongerThan10DaysMaxQuality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsSellDateLessOrEqual10DaysMaxQuality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsSellDateLessOrEqual5DaysMaxQuality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsOnSellDate()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testUpdatesBackstagePassItemsAfterSellDate()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -1, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsBeforeSellDate()
    {
        $items = [new Item('Conjured', 10, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsOnSellDate()
    {
        $items = [new Item('Conjured', 0, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsAfterSellDate()
    {
        $items = [new Item('Conjured', -1, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testUpdatesConjuredItemsQualityEqualsTo0()
    {
        $items = [new Item('Conjured', 10, 0)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }
}
