<?php
declare(strict_types=1);

namespace App\Domain\Dealer;

use JsonSerializable;

class Dealer implements JsonSerializable
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * zip code could have dashes or leading 0s .. but for sample data int
     * @var int
     */
    private $zip_code;

    /**
     * @param int|null  $id
     * @param string    $name
     * @param string    $address
     * @param string    $city
     * @param string    $state
     * @param string    $zip_code
     */
    public function __construct(?int $id, string $name, string $address, string $city, string $state, string $zip_code)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = strtoupper($state);
        $this->zip_code = $zip_code;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getZipCode(): string
    {
        return $this->zip_code;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
        ];
    }
}
