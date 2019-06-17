<?php


namespace App\Domain\ValueObject;


final class CurrencyPair
{
    /** @var string */
    private $pair;

    private function __construct()
    {
    }

    /**
     * @param string $pair
     * @return CurrencyPair
     */
    public static function fromString(string $pair): self
    {

        $currencyPair = new self();

        $currencyPair->pair = $pair;

        return $currencyPair;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->pair;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->pair;
    }


}
