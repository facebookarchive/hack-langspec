<?hh // strict

namespace NS_MathLibrary_test1;

require_once 'MathLibrary.php';

function main(): void {
//  $m = new \NS_MathLibrary\MathLibrary();	// can't instantiate a final class

  \NS_MathLibrary\MathLibrary::sin(2.34);
  \NS_MathLibrary\MathLibrary::cos(2.34);
  \NS_MathLibrary\MathLibrary::tan(2.34);
}

require_once "../main.php";
