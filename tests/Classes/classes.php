<?hh // strict

namespace NS_classes;

interface I1 {}
interface I2 {}
class C1 {}
class C2 extends C1 implements I1, I2 {}

function main(): void {
  $c = new C2();
  var_dump($c);
}

require_once "../main.php";

