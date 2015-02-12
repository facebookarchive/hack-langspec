<?hh // strict

namespace NS_Vehicle_test1;

require_once 'PassengerJet.php';

function main(): void {
  $pj = new \NS_Vehicles\PassengerJet("Horizon", 1993, 33000, 235);
  echo "\$pj's maximum speed: " . $pj->getMaxSpeed() . "\n";
  echo "\$pj's maximum altitude: " . $pj->getMaxAltitude() . "\n";
}

//main();
