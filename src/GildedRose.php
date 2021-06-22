<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Aged Brie':
                    $this->updateAgedBrie($item);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $this->updateBackstagePasses($item);
                    break;
                case 'Sulfuras, Hand of Ragnaros':
                    break;
                case 'Conjured':
                    $this->updateConjured($item);
                default:
                    $this->updateNormal($item);
                    break;
            }
        }
    }

    public function updateAgedBrie($item)
    {
        $item->sell_in -= 1;
        $item->quality += 1;

        if ($item->sell_in <= 0) {
            $item->quality += 1;
        }
        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }

    public function updateBackstagePasses($item)
    {
        $item->quality += 1;

        if ($item->sell_in <= 10) {
            $item->quality += 1;
        }
        if ($item->sell_in <= 5) {
            $item->quality += 1;
        }
        if ($item->quality > 50) {
            $item->quality = 50;
        }
        if ($item->sell_in <= 0) {
            $item->quality = 0;
        }

        $item->sell_in -= 1;
    }

    public function updateNormal($item)
    {
        $item->sell_in -= 1;
        $item->quality -= 1;

        if ($item->sell_in <= 0) {
            $item->quality -= 1;
        }
        if ($item->quality <= 0) {
            $item->quality = 0;
        }
    }

    public function updateConjured($item)
    {
        $item->sell_in -= 1;
        $item->quality -= 2;

        if ($item->sell_in <= 0) {
            $item->quality -= 2;
        }
        if ($item->quality <= 0) {
            $item->quality = 0;
        }
    }
}
