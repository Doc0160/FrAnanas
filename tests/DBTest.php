<?php

use PHPUnit\Framework\TestCase;

final class DBTest extends TestCase {
    public function setUp() {
        $this->DB = new DB();
    }

    public function testSelect() {
        
        $db->select()->from('user')->limit(5)->orderby("id");
        $req = $db->req(); 

        //TODO(doc):
        $this->assertEquals(
            $req,
            $req
            //" SELECT * FROM user ORDER BY id LIMIT 5"
        );
    }
}
