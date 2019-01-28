<?php

//declare(strict_types=1);

namespace Geocoder\Provider\TomTom\Model;

use Geocoder\Model\Address;

final class TomTomAddress extends Address
{

    /**
     * @var string|null
     */
    private $formattedAddress;

    /**
     * @var string|null
     */
    private $countrySubDivision;

    /**
     * @var string|null
     */
    private $countrySubDivisionName;
    /**
     * @return null|string
     */
    public function getFormattedAddress()
    {
        return $this->formattedAddress;
    }

    /**
     * @param string|null $formattedAddress
     *
     * @return TomTomAddress
     */
    public function withFormattedAddress(string $formattedAddress = null)
    {
        $new = clone $this;
        $new->formattedAddress = $formattedAddress;

        return $new;
    }

    /**
     * @return string|null
     */
    public function getCountrySubDivision()
    {
        return $this->countrySubDivision;
    }


    /**
     * @param string|null $countrySubDivision
     *
     * @return TomTomAddress
     */
    public function withCountrySubDivision(string $countrySubDivision = null)
    {
        $new = clone $this;
        $new->countrySubDivision = $countrySubDivision;

        return $new;
    }

    /**
     * @return string|null
     */
    public function getCountrySubDivisionName()
    {
        return $this->countrySubDivisionName;
    }

    /**
     * @param string|null $countrySubDivisionName
     *
     * @return TomTomAddress
     */
    public function withCountrySubDivisionName(string $countrySubDivisionName = null)
    {
        $new = clone $this;
        $new->countrySubDivisionName = $countrySubDivisionName;

        return $new;
    }

    public static function createFromArray(array $data)
    {

        $defaults = [
            'countrySubDivision' => null,
            'countrySubDivisionName' => null,
            'formattedAddress' => null,
        ];

        $data = array_merge($defaults, $data);

        /** @var Address $address */
        $address = parent::createFromArray($data);

        $address = self::createFromAddressInstance($address);
        $address->withCountrySubDivision($data['countrySubDivision']);
        $address->withCountrySubDivisionName($data['countrySubDivisionName']);
        $address->withFormattedAddress($data['formattedAddress']);

        return $address;
    }

    public static function createFromAddressInstance(Address $address): self
    {
        $self = new self(
            $address->getProvidedBy(),
            $address->getAdminLevels(),
            $address->getCoordinates(),
            $address->getBounds(),
            $address->getStreetNumber(),
            $address->getStreetName(),
            $address->getPostalCode(),
            $address->getLocality(),
            $address->getSubLocality(),
            $address->getCountry(),
            $address->getTimezone()
        );

        return $self;
    }

}