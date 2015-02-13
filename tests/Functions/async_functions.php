<?hh // strict

namespace NS_async_functions;

async function f1(): Awaitable<void> {
  echo "Inside " . __FUNCTION__ . "\n";

//  $x = await 10;	// await can only operate on an Awaitable
  $x = await f2();
}

async function f2(): Awaitable<void> {
  echo "Inside " . __FUNCTION__ . "\n";
}

async function f3(): Awaitable<?string> {
  echo "Inside " . __FUNCTION__ . "\n";

  return 'xxx';		// some magic occurs here to convert a string to an Awaitable<?string>
}

class C {
//  public async function __construct() {}	// can't be async as that requires an explicit return type
//  public async function __destruct() {}	// and a return statement that returns something

  public async function m1(): Awaitable<int> { return 10; }
  public static async function m2(): Awaitable<int> { return 20; }
}

function main(): void {
  $x = f1()->getWaitHandle()->join();
  var_dump($x);

  $x = f3()->getWaitHandle()->join();
  var_dump($x);
}

/* HH_FIXME[1002] call to main in strict*/
main();
