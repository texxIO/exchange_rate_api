<?php


namespace App\Domain\Model;


use App\Domain\ValueObject\CurrencyPair;
use DateTime;

class CurrencyRate
{
    /** @var CurrencyPair $currencyPair */
    private $currencyPair;

    /** @var float $rate */
    private  $rateValue;

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
     * @return Rate
     */
    public function setCurrencyPair(CurrencyPair $currencyPair): Rate
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
     * @return Rate
     */
    public function setRateValue(float $rateValue): Rate
    {
        $this->rateValue = $rateValue;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Rate
     */
    public function setCreatedAt(\DateTime $createdAt): Rate
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Rate
     */
    public function setUpdatedAt(\DateTime $updatedAt): Rate
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     * @return Rate
     */
    public function setDeletedAt(\DateTime $deletedAt): Rate
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }



}
