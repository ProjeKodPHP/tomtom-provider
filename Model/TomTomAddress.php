<?php

declare(strict_types=1);

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
    private $countrySubdivision;

    /**
     * @var string|null
     */
    private $countrySubdivisionName;
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
    public function getCountrySubdivision()
    {
        return $this->countrySubdivision;
    }


    /**
     * @param string|null $countrySubdivision
     *
     * @return TomTomAddress
     */
    public function withCountrySubdivision(string $countrySubdivision = null)
    {
        $new = clone $this;
        $new->countrySubdivision = $countrySubdivision;

        return $new;
    }

    /**
     * @return string|null
     */
    public function getCountrySubdivisionName()
    {
        return $this->countrySubdivisionName;
    }

    /**
     * @param string|null $countrySubdivisionName
     *
     * @return TomTomAddress
     */
    public function withCountrySubdivisionName(string $countrySubdivisionName = null)
    {
        $new = clone $this;
        $new->countrySubdivisionName = $countrySubdivisionName;

        return $new;
    }

    public function toArray(): array
    {
        $array = parent::toArray();

        $array = array_merge($array, [
            'formattedAddress' => $this->getFormattedAddress(),
            'countrySubdivision' => $this->getCountrySubdivision(),
            'countrySubdivisionName' => $this->getCountrySubdivisionName(),
        ]);

        return $array;
    }

    public static function createFromArray(array $data)
    {
        $defaults = [
            'countrySubdivision' => null,
            'countrySubdivisionName' => null,
            'formattedAddress' => null,
        ];

        $data = array_merge($defaults, $data);

        /** @var Address $address */
        $address = parent::createFromArray($data);

        $address = self::createFromAddressInstance($address);
        $address = $address->withCountrySubdivision($data['countrySubdivision']);
        $address = $address->withCountrySubdivisionName($data['countrySubdivisionName']);
        $address = $address->withFormattedAddress($data['formattedAddress']);

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
