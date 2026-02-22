<?php

namespace App\Domain\Entity;

class Tag
{   
    private int $id_tags;
    public string $label;

    public function __construct(int $id_tags, int $id_ticket, string $label)
    {
        $this->id_tags = $id_tags;
        $this->label = $label;
    }

    public function getTagsID(): int
    {
        return $this->id_tags;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

}
