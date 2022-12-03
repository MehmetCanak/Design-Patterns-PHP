<?php

namespace RefactoringGuru\Prototype\RealWorld;

/**
 * Prototype.
 */
class Page
{
    private $title;

    private $body;

    /**
     * @var Author
     */
    private $author;

    private $comments = [];

    /**
     * @var \DateTime
     */
    private $date;

    // +100 private fields.

    public function __construct(string $title, string $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->author->addToPage($this);
        $this->date = new \DateTime();
    }

    public function addComment(string $comment): void
    {
        $this->comments[] = $comment;
    }

    /**
     * You can control what data you want to carry over to the cloned object.
     *
     * For instance, when a page is cloned:
     * - It gets a new "Copy of ..." title.
     * - The author of the page remains the same. Therefore we leave the
     * reference to the existing object while adding the cloned page to the list
     * of the author's pages.
     * - We don't carry over the comments from the old page.
     * - We also attach a new date object to the page.
     */
    public function __clone()
    {
        $this->title = "Copy of " . $this->title;
        $this->author->addToPage($this);
        $this->comments = [];
        $this->date = new \DateTime();
    }
}

class Author
{
    private $name;

    /**
     * @var Page[]
     */
    private $pages = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addToPage(Page $page): void
    {
        $this->pages[] = $page;
    }
}

/**
 * The client code.
 */
function clientCode()
{
    $author = new Author("John Smith");
    $page = new Page("Tip of the day", "Keep calm and carry on.", $author);

    // ...

    $page->addComment("Nice tip, thanks!");

    // ...

    $draft = clone $page;
    echo "Dump of the clone. Note that the author is now referencing two objects.\n\n";
    print_r($draft);
}

clientCode();

///          Output.txt: Execution result

// Dump of the clone. Note that the author is now referencing two objects.

// RefactoringGuru\Prototype\RealWorld\Page Object
// (
//     [title:RefactoringGuru\Prototype\RealWorld\Page:private] => Copy of Tip of the day
//     [body:RefactoringGuru\Prototype\RealWorld\Page:private] => Keep calm and carry on.
//     [author:RefactoringGuru\Prototype\RealWorld\Page:private] => RefactoringGuru\Prototype\RealWorld\Author Object
//         (
//             [name:RefactoringGuru\Prototype\RealWorld\Author:private] => John Smith
//             [pages:RefactoringGuru\Prototype\RealWorld\Author:private] => Array
//                 (
//                     [0] => RefactoringGuru\Prototype\RealWorld\Page Object
//                         (
//                             [title:RefactoringGuru\Prototype\RealWorld\Page:private] => Tip of the day
//                             [body:RefactoringGuru\Prototype\RealWorld\Page:private] => Keep calm and carry on.
//                             [author:RefactoringGuru\Prototype\RealWorld\Page:private] => RefactoringGuru\Prototype\RealWorld\Author Object
//  *RECURSION*
//                             [comments:RefactoringGuru\Prototype\RealWorld\Page:private] => Array
//                                 (
//                                     [0] => Nice tip, thanks!
//                                 )

//                             [date:RefactoringGuru\Prototype\RealWorld\Page:private] => DateTime Object
//                                 (
//                                     [date] => 2018-06-04 14:50:39.306237
//                                     [timezone_type] => 3
//                                     [timezone] => UTC
//                                 )

//                         )

//                     [1] => RefactoringGuru\Prototype\RealWorld\Page Object
//  *RECURSION*
//                 )

//         )

//     [comments:RefactoringGuru\Prototype\RealWorld\Page:private] => Array
//         (
//         )

//     [date:RefactoringGuru\Prototype\RealWorld\Page:private] => DateTime Object
//         (
//             [date] => 2018-06-04 14:50:39.306272
//             [timezone_type] => 3
//             [timezone] => UTC
//         )

// )


