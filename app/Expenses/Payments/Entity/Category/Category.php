<?php
declare(strict_types=1);

namespace App\Expenses\Payments\Entity\Category;

use App\Expenses\Kernel\Aggregate\AggregateRoot;
use App\Expenses\Kernel\Aggregate\EventTrait;
use App\Expenses\Payments\Events\CategoryColorChanged;
use App\Expenses\Payments\Events\CategoryCreated;
use App\Expenses\Payments\Events\CategoryHintChanged;
use App\Expenses\Payments\Events\CategoryIconChanged;
use App\Expenses\Payments\Events\CategoryRenamed;

class Category implements AggregateRoot
{
    use EventTrait;

    private Id $id;
    private Name $name;
    private Color $color;
    private Icon $icon;
    private Hint $hint;

    public function __construct(Id $id, Name $name, Color $color, Icon $icon, Hint $hint)
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->icon = $icon;
        $this->hint = $hint;
        $this->recordEvent(new CategoryCreated($id));
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Color
     */
    public function getColor(): Color
    {
        return $this->color;
    }

    /**
     * @return Icon
     */
    public function getIcon(): Icon
    {
        return $this->icon;
    }

    /**
     * @return Hint
     */
    public function getHint(): Hint
    {
        return $this->hint;
    }

    public function rename(Name $name)
    {
        $this->name = $name;
        $this->recordEvent(new CategoryRenamed($this->id, $name));
    }

    public function changeColor(Color $color)
    {
        $this->color = $color;
        $this->recordEvent(new CategoryColorChanged($this->id, $color));
    }

    public function changeIcon(Icon $icon)
    {
        $this->icon = $icon;
        $this->recordEvent(new CategoryIconChanged($this->id, $icon));
    }

    public function changeHint(Hint $hint)
    {
        $this->hint = $hint;
        $this->recordEvent(new CategoryHintChanged($this->id, $hint));
    }
}
