<?php

require 'Trip.php';
require 'Boat.php';
require 'Customer.php';
require 'Coordinate.php';

// Start the trip
$trip = new Trip(new Boat(), new Customer());

// Simulate the receival of coordinates
$opmeer = new Coordinate(52.70405992157491, 4.944845310138666);
$trip->addCoordinate($opmeer);
sleep(2);
$amsterdam = new Coordinate(52.36825031639302, 4.889752448288495);
$trip->addCoordinate($amsterdam);
sleep(2);
$opmeer2 = new Coordinate(52.70405992157491, 4.944845310138666);
$trip->addCoordinate($opmeer2);

// End the trip
$trip->stop();

echo "duration = " . $trip->duration() . ", distance = " . $trip->distance();


