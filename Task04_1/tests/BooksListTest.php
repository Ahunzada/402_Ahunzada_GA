<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\BooksList;
use App\Book;

class BooksListTest extends TestCase
{
    public function testAddAndCount()
    {
        $book = new Book();
        $booksList = new BooksList();
        $booksList->add($book);
        $this->assertSame(1, $booksList->count());
    }

    public function testGet()
    {
        $book = new Book();
        $booksList = new BooksList();
        $book->setName("PHP forever")->setAuthors(array("B. Gates", "J. Smith"))
            ->setPublisher("O'Reily")->setYear(2020);
        $booksList->add($book);
        $this -> assertInstanceOf(Book::class, $booksList -> get(1));
    }

    public function testStore()
    {
        $book = new Book();
        $booksList = new BooksList();
        $book->setName("PHP forever")->setAuthors(array("B. Gates", "J. Smith"))
            ->setPublisher("O'Reily")->setYear(2020);
        $booksList->add($book);
        $this -> assertSame(null, $booksList -> store("output"));
    }

    public function testLoad()
    {
        $booksList = new BooksList();
        $booksList->load("output");
        $this->assertSame(1, $booksList->count());
        $this->assertInstanceOf(Book::class, $booksList->get(1));
    }

    public function testCurrentAndKey()
    {
        $book1 = new Book();
        $book2 = new Book();
        $book3 = new Book();
        $booksList = new BooksList();
        $book1 -> setName("PHP forever")->setAuthors(array("B. Gates", "J. Smith"))
            ->setPublisher("O'Reily")->setYear(2020);
        $book2 -> setName("Call of Cthulhu")->setAuthors(array("H.P. Lovecraft"))
            ->setPublisher("Weird Tales")->setYear(1926);
        $book3 -> setName("The Princeton Companion to Mathematics")
            ->setAuthors(array("T. Gowers", "J. Barrow-Green", "I. Leader"))
            ->setPublisher("Princeton University Press")->setYear(2008);
        $booksList -> add($book1);
        $booksList -> add($book2);
        $booksList -> add($book3);

        $this->assertSame(
            "Id: 4" . "\n" .
            "????????????????: PHP forever" . "\n" .
            "?????????? 1: B. Gates" . "\n" .
            "?????????? 2: J. Smith" . "\n" .
            "????????????????????????: O'Reily" . "\n" .
            "??????: 2020",
            $booksList -> current() -> __toString()
        );
        $this -> assertSame(4, $booksList -> key());
        return $booksList;
    }

    public function testNext(BooksList $booksList)
    {
        $booksList->next();
        $this->assertSame(
            "Id: 5" . "\n" .
            "????????????????: Call of Cthulhu" . "\n" .
            "?????????? 1: H.P. Lovecraft" . "\n" .
            "????????????????????????: Weird Tales" . "\n" .
            "??????: 1926",
            $booksList -> current() -> __toString()
        );
        $booksList->next();
        $this->assertSame(
            "Id: 6" . "\n" .
            "????????????????: The Princeton Companion to Mathematics" . "\n" .
            "?????????? 1: T. Gowers" . "\n" .
            "?????????? 2: J. Barrow-Green" . "\n" .
            "?????????? 3: I. Leader" . "\n" .
            "????????????????????????: Princeton University Press" . "\n" .
            "??????: 2008",
            $booksList -> current() -> __toString()
        );

        return $booksList;
    }

    public function testValidAndRewind(BooksList $booksList)
    {
        $booksList -> next();
        $this -> assertSame(false, $booksList -> valid());
        $booksList -> rewind();
        $this -> assertSame(true, $booksList -> valid());
        $this -> assertSame(
            "Id: 4" . "\n" .
            "????????????????: PHP forever" . "\n" .
            "?????????? 1: B. Gates" . "\n" .
            "?????????? 2: J. Smith" . "\n" .
            "????????????????????????: O'Reily" . "\n" .
            "??????: 2020",
            $booksList->current()->__toString()
        );
    }
}
