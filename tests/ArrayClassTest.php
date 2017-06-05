<?php
use PHPUnit\Framework\TestCase;

final class ArrayClassTest extends TestCase {
    public function setUp() {
        $this->array = [1, "mama" => 2, 3];
        $this->arrayclass = new ArrayClass($this->array);
    }
    
    public function testCanHaveValues(): void {
        $this->assertEquals(
            array_values($this->array),
            $this->arrayclass->values()
        );
    }

    public function testCanHaveKeys(): void {
        $this->assertEquals(
            array_keys($this->array),
            $this->arrayclass->keys()
        );
    }

    public function testCanHaveSum(): void {
        $this->assertEquals(
            array_sum($this->array),
            $this->arrayclass->sum()
        );
    }
    
    public function testCanShift(): void {
        $a = $this->array[0];
        $b = $this->arrayclass->shift();
        $this->assertEquals(
            $a,
            $b
        );
    }
}
