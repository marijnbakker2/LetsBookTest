<?php

class Coordinate
{
    private float $lat;
    private float $lon;
    private DateTime $timestamp;
    
    public function __construct(float $lat, float $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
        $this->timestamp = new DateTime();
    }
    
    /**
     * source: https://www.geodatasource.com/developers/php
     * @param Coordinate $coordinate
     * @return float distance from this coordinate in kilometers
     */
    public function distanceFrom(Coordinate $coordinate): float
    {
        if (($this->lat == $coordinate->lat) && ($this->lon == $coordinate->lon)) {
            return 0;
        }
        
        $theta = $this->lon - $coordinate->lon;
        $dist = sin(deg2rad($this->lat)) * sin(deg2rad($coordinate->lat)) + cos(deg2rad($this->lat)) * cos(
                deg2rad($coordinate->lat)
            ) * cos(
                deg2rad($theta)
            );
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $dist = $dist * 60 * 1.1515 * 1.609344;
        
        return $dist;
    }
    
    /**
     * @return float Longitude
     */
    public function getLon(): float
    {
        return $this->lon;
    }
    
    /**
     * @return float Latitude
     */
    public function getLat(): float
    {
        return $this->lat;
    }
    
    /**
     * @return DateTime Timestamp of receiving this coordinate
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }
    
}