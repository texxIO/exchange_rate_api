<?php


namespace App\Domain\Model;


use App\Domain\ValueObject\CurrencyPair;
use DateTime;

class CurrencyRate
{
    /** @var CurrencyPair $currencyPair */
    private $currencyPair;

    /** @var float $rate */
    private $rateValue;

    /** @var DateTime $createdAt */
    private $createdAt;

    /** @var DateTime $updatedAt */
    private $updatedAt;

    /** @var DateTime|null $deletedAt */
    private $deletedAt;

    public function __construct(CurrencyPair $currencyPair, float $rateValue)
    {
        $this->currencyPair = $currencyPair;
        $this->rateValue = $rateValue;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->deletedAt = null;
    }

    /**
     * @return CurrencyPair
     */
    public function getCurrencyPair(): CurrencyPair
    {
        return $this->currencyPair;
    }

    /**
     * @param CurrencyPair $currencyPair
     * @return CurrencyRate
     */
    public function setCurrencyPair(CurrencyPair $currencyPair): CurrencyRate
    {
        $this->currencyPair = $currencyPair;
        return $this;
    }

    /**
     * @return float
     */
    public function getRateValue(): float
    {
        return $this->rateValue;
    }

    /**
     * @param float $rateValue
     * @return CurrencyRate
     */
    public function setRateValue(float $rateValue): CurrencyRate
    {
        $this->rateValue = $rateValue;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return CurrencyRate
     */
    public function setCreatedAt(DateTime $createdAt): CurrencyRate
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return CurrencyRate
     */
    public function setUpdatedAt(DateTime $updatedAt): CurrencyRate
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime $deletedAt
     * @return CurrencyRate
     */
    public function setDeletedAt(DateTime $deletedAt): CurrencyRate
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

}
