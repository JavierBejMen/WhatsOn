<?php
/*
    - IMPORTANT: Property names MUST have the same names as database column names in the events database table

    - Properties are strings or strings array
    - Id and user email properties can not be modified
*/
final class Event
{
    public function __construct()
    { }
    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getUrlHeaderImage(): string
    {
        return $this->url_header_image;
    }
    public function getStartDate(): string
    {
        return $this->start_date;
    }
    public function getStartTime(): string
    {
        return $this->start_time;
    }
    public function getEndDate()
    {
        return $this->end_date;
    }
    public function getEndTime()
    {
        return $this->end_time;
    }
    public function getLocalName(): string
    {
        return $this->local_name;
    }
    public function getLocalAddress(): string
    {
        return $this->local_address;
    }
    public function getLocalLatitude()
    {
        return $this->local_latitude;
    }
    public function getLocalLongitude()
    {
        return $this->local_longitude;
    }
    public function getTicketPrice(): string
    {
        return $this->ticket_price;
    }
    public function getLongDrinkPrice()
    {
        return $this->long_drink_price;
    }
    public function getBeerPrice()
    {
        return $this->beer_price;
    }
    public function getUserEmail(): string
    {
        return $this->user_email;
    }
    public function getArrayOfTags(): array
    {
        return $this->array_of_tags;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setUrlHeaderImage(string $urlHeaderImage)
    {
        $this->url_header_image = $urlHeaderImage;
    }
    public function setStartDate(string $startDate)
    {
        $this->start_date = $startDate;
    }
    public function setStartTime(string $startTime)
    {
        $this->start_time = $startTime;
    }
    public function setEndDate(string $endDate)
    {
        $this->end_date = $endDate;
    }
    public function setEndTime(string $endTime)
    {
        $this->end_time = $endTime;
    }
    public function setLocalName(string $localName)
    {
        $this->local_name = $localName;
    }
    public function setLocalAddress(string $localAddress)
    {
        $this->local_address = $localAddress;
    }
    public function setLocalLatitude(string $localLatitude)
    {
        $this->local_latitude = $localLatitude;
    }
    public function setLocalLongitude(string $localLongitude)
    {
        $this->local_longitude = $localLongitude;
    }
    public function setTicketPrice(string $ticketPrice)
    {
        $this->ticket_price = $ticketPrice;
    }
    public function setLongDrinkPrice(string $longDrinkPrice)
    {
        $this->long_drink_price = $longDrinkPrice;
    }
    public function setBeerPrice(string $beerPrice)
    {
        $this->beer_price = $beerPrice;
    }
    public function setArrayOfTags(array $arrayOfTags)
    {
        $this->array_of_tags = $arrayOfTags;
    }
    public function __destruct()
    { }

    // Private
    private $id;
    private $name;
    private $description;
    private $url_header_image;
    private $start_date;
    private $start_time;
    private $end_date;
    private $end_time;
    private $local_name;
    private $local_address;
    private $local_latitude;
    private $local_longitude;
    private $ticket_price;
    private $long_drink_price;
    private $beer_price;
    private $user_email;
    private $array_of_tags;
}
