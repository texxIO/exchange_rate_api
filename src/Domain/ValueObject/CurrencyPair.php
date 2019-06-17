<?php


namespace App\Domain\ValueObject;


final class CurrencyPair
{
    /** @var string */
    private $pair;

    public static function fromString(string $pair): self
    {

        $currencyPair = new self();

        $currencyPair->pair = $pair;

        return $currencyPair;
    }

    public function toString(): string
    {
        return $this->pair;
    }

    public function __toString(): string
    {
        return $this->pair;
    }

    private function __construct()
    {
    }


}
