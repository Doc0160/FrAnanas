<?php 

final class BitField
{
    public static function has(int $bitfield, int $bit): bool {
        return ($bitfield & $bit) > 0;
    }

    public static function add(int $bitfield, int $bit): int {
        return $bitfield | $bit;
    }

    public static function remove(int $bitfield, int $bit): int {
        return $bitfield & ~$bit;
    }
}
