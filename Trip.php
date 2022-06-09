<?php

require 'State.php';

class Trip
{
    private Boat $boat;
    private Customer $customer;
    private DateTime $start_time;
    private DateTime $end_time;
    private State $state;
    private array $coordinates;
    
    public function __construct(Boat $boat, Customer $customer)
    {
        $this->boat = $boat;
        $this->customer = $customer;
        $this->coordinates = [];
        $this->start();
    }
    
    /**
     * @return void
     */
    public function start(): void
    {
        $this->start_time = new DateTime();
        
        $this->state = State::Active;
    }
    
    /**
     * @throws Exception
     */
    public function stop(): void
    {
        if ($this->state == State::Ended) {
            throw new Exception('Trip has already ended.');
        }
        
        $this->end_time = new DateTime();
        
        $this->state = State::Ended;
    }
    
    /**
     * @return string Duration of the trip
     */
    public function duration(): string
    {
        $end_time = $this->end_time;
        
        if ($this->state == State::Active) {
            $end_time = new DateTime();
        }
        
        $interval = $end_time->diff($this->start_time);
        
        return $interval->format('%H:%I:%S');
    }
    
    /**
     * @param Coordinate $coordinate
     */
    public function addCoordinate(Coordinate $coordinate): void
    {
        $this->coordinates[] = $coordinate;
    }
    
    /**
     * @return float Total distance travelled
     */
    public function distance(): float
    {
        $this->sortCoordinates();
        
        $distance = 0;
        
        while ($current_coordinate = current($this->coordinates)) {
            if (!$next_coordinate = next($this->coordinates)) {
                break;
            }
            
            $distance = $distance + $current_coordinate->distanceFrom($next_coordinate);
        }
        
        return $distance;
    }
    
    /**
     * @return void
     */
    private function sortCoordinates(): void
    {
        usort($this->coordinates, function ($a, $b) {
            return ($a->getTimestamp() > $b->getTimestamp());
        });
    }
}