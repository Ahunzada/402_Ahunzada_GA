<?php

namespace Tests\BookTest;

use App\Book;
use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    public function testSetName()
    {
        $book = new Book();
        $book->setName("PHP forever");

        $this->assertEquals("PHP forever", $book->getName());
    }

    public function testSetAuthors()
    {
        $book = new Book();
        $book->setAuthors(array("B. Gates", "J. Smith"));

        $this->assertEquals(array("B. Gates", "J. Smith"), $book->getAuthors());
    }

    public function testSetPublisher()
    {
        $book = new Book();
        $book->setPublisher("O'Reily");

        $this->assertEquals("O'Reily", $book->getPublisher());
    }

    public function testSetYear()
    {
        $book = new Book();
        $book->setYear(2020);

        $this->assertEquals(2020, $book->getYear());
    }
}
