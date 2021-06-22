<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /**
     * @test
     */
    public function updates_normal_items_before_sell_date()
    {
        $items = [new Item('normal', 8, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(4, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_normal_items_on_sell_date()
    {
        $items = [new Item('normal', 0, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_normal_items_after_sell_date()
    {
        $items = [new Item('normal', -10, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-11, $items[0]->sell_in);
        $this->assertSame(3, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_normal_items_quality_equals_to_0()
    {
        $items = [new Item('normal', 10, 0)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_before_sell_date()
    {
        $items = [new Item('Aged Brie', 8, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_before_sell_date_close_to_max_quality()
    {
        $items = [new Item('Aged Brie', 8, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_before_sell_date_max_quality()
    {
        $items = [new Item('Aged Brie', 8, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(7, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_on_sell_date()
    {
        $items = [new Item('Aged Brie', 0, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_on_sell_date_close_to_max_quality()
    {
        $items = [new Item('Aged Brie', 0, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_on_sell_date_max_quality()
    {
        $items = [new Item('Aged Brie', 0, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_after_sell_date()
    {
        $items = [new Item('Aged Brie', -4, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(12, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_after_sell_date_close_to_max_quality()
    {
        $items = [new Item('Aged Brie', -4, 49)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_aged_brie_items_after_sell_date_max_quality()
    {
        $items = [new Item('Aged Brie', -4, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-5, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_sulfuras_items_before_sell_date()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 5, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(5, $items[0]->sell_in);
        $this->assertSame(10, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_sulfuras_items_on_sell_date()
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(0, $items[0]->sell_in);
        $this->assertSame(10, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_sulfuras_after_sell_date()
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

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_longer_than_10_days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 12, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(11, $items[0]->sell_in);
        $this->assertSame(6, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_less_or_equal_10_days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(7, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_less_or_equal_5_days()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 5)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(8, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_longer_than_10_days_max_quality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_less_or_equal_10_days_max_quality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 10, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(9, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_sell_date_less_or_equal_5_days_max_quality()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 50)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(4, $items[0]->sell_in);
        $this->assertSame(50, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_on_sell_date()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-1, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }

    /**
     * @test
     */
    public function updates_backstage_pass_items_after_sell_date()
    {
        $items = [new Item('Backstage passes to a TAFKAL80ETC concert', -1, 10)];
        $gildedRose = new GildedRose($items);

        $gildedRose->updateQuality();

        $this->assertSame(-2, $items[0]->sell_in);
        $this->assertSame(0, $items[0]->quality);
    }
}
