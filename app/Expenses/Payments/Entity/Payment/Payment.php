<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Entity\Payment;

use App\Expenses\Kernel\Aggregate\AggregateRoot;
use App\Expenses\Kernel\Aggregate\EventTrait;
use App\Expenses\Payments\Entity\Category\Category;
use App\Expenses\Payments\Events\PaymentCategoryChanged;
use App\Expenses\Payments\Events\PaymentCreated;
use App\Expenses\Payments\Events\PaymentSumChanged;
use DateTimeImmutable;

class Payment implements AggregateRoot
{
    use EventTrait;

    private Id $id;
    private Sum $sum;
    private ?Category $category;
    private DateTimeImmutable $dateCreate;
    private Author $author;
    private ?DateTimeImmutable $dateUpdate = null;
    private ?Editor $editor = null;

    public function __construct(Id $id, Sum $sum, ?Category $category)
    {
        $this->id = $id;
        $this->sum = $sum;
        $this->category = $category;
        $this->author = new Author;
        $this->dateCreate = new DateTimeImmutable;
        $this->recordEvent(new PaymentCreated($this->id));
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSum(): Sum
    {
        return $this->sum;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getDateCreate(): DateTimeImmutable
    {
        return $this->dateCreate;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function getDateUpdate(): ?DateTimeImmutable
    {
        return $this->dateUpdate;
    }

    public function getEditor(): ?Editor
    {
        return $this->editor;
    }

    public function changeSum(Sum $sum): void
    {
        $this->sum = $sum;
        $this->recordEvent(new PaymentSumChanged($this->id, $sum));
    }

    public function changeCategory(?Category $category): void
    {
        $this->category = $category;
        $this->recordEvent(new PaymentCategoryChanged($this->id, $category));
    }
}
