<?php
declare(strict_types=1);

namespace Tests\Expenses\Payments\Entity\Payment;

use App\Expenses\Payments\Entity\Category;
use App\Expenses\Payments\Entity\Payment;
use App\Expenses\Payments\Events\PaymentCreated;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function testCreate()
    {
        $categoryId = new Category\Id();
        $name = new Category\Name();
        $color = new Category\Color();
        $icon = new Category\Icon();
        $hint = new Category\Hint();
        $category = new Category\Category($categoryId, $name, $color, $icon, $hint);

        $paymentId = new Payment\Id();
        $sum = new Payment\Sum(100);
        $payment = new Payment\Payment($paymentId, $sum, $category);

        static::assertEquals($paymentId, $payment->getId());
        static::assertEquals($sum, $payment->getSum());
        static::assertEquals($category, $payment->getCategory());
        static::assertEquals($categoryId, $category->getId());
        static::assertEquals($categoryId, $payment->getCategory()->getId());
        static::assertEquals($name, $category->getName());
        static::assertEquals($name, $payment->getCategory()->getName());
        static::assertEquals($color, $category->getColor());
        static::assertEquals($color, $payment->getCategory()->getColor());
        static::assertEquals($icon, $category->getIcon());
        static::assertEquals($icon, $payment->getCategory()->getIcon());
        static::assertEquals($hint, $category->getHint());
        static::assertEquals($hint, $payment->getCategory()->getHint());
        
        static::assertNotNull($payment->getDateCreate());
        static::assertNotNull($payment->getAuthor());

        static::assertNull($payment->getDateUpdate());
        static::assertNull($payment->getEditor());

        static::assertNotEmpty($events = $payment->releaseEvents());
        static::assertInstanceOf(PaymentCreated::class, end($events));
    }
}
