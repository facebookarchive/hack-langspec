<?hh // strict

namespace NS_invoke;

class C {
  public function __invoke(): void {
    echo "Inside " . __METHOD__ . "\n";
  }
}

function main(): void {
  $c = new C();
  var_dump(is_callable($c)); // returns true if __invoke exists; otherwise, false
//  $c();
}

//main();
