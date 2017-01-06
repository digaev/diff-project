<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TextDiffer;
use App\DiffString;

class TextDifferTest extends TestCase
{
    const TEXT1 = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.\n" .
                "Laboriosam dolorum quidem cumque dolore iure aliquam reiciendis\n" .
                "tempora ullam ipsam delectus ab quia libero, porro, itaque vero id voluptates.\n" .
                "Vitae, voluptatum.";

    const TEXT2 = "Lorem ipsum dolor sit amet, consectetur adipisicing elit.\n" .
                "Laboriosam dolorum quidem cumque dolore iure\n" .
                "Vitae, voluptatum.\n" .
                "Lorem ipsum dolor.";

    public function testCompare()
    {
        $text1 = self::TEXT1;
        $text2 = self::TEXT2;

        $differ = new TextDiffer();
        $strings = $differ->compare($text1, $text2);

        $this->assertEquals($strings[0]->type, DiffString::SIMILAR);
        $this->assertEquals($strings[1]->type, DiffString::MODIFIED);
        $this->assertEquals($strings[3]->type, DiffString::INSERTED);
        $this->assertEquals($strings[4]->type, DiffString::DELETED);
    }
}
