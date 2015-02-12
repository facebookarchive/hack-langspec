<?hh

// This script automatically adds "require_once main.php" statements
// to all the tests that have a main() function

function levels_to_main_file(string $starting_dir): int {
  $level = 0;
  $mf = "main.php";
  while (!is_file($starting_dir . "/main.php") && $starting_dir !== "/") {
    $starting_dir = dirname($starting_dir);
    $level++;
  }
  return $level;
}

function main(): void {
  $tests_dir = __DIR__ . "/../tests";

  $di = new RecursiveDirectoryIterator($tests_dir,
                                       RecursiveDirectoryIterator::SKIP_DOTS);
  $it = new RecursiveIteratorIterator($di);
  foreach ($it as $test_file) {
    if ($test_file->isFile() && $test_file->getExtension() === "php") {
      $test_contents = file_get_contents($test_file);
      $require_pattern = "/require_once \"(\.\.\/)*main\.php\";/";
      if (preg_match($require_pattern, $test_contents) === 1) {
        continue;
      }
      $fmain_pattern = "/function main\(\)/";
      if (preg_match($fmain_pattern, $test_contents) === 1) {
        $levels_to_main = levels_to_main_file($test_file->getPath());
        $require_str = 'require_once "';
        for ($i = 0; $i < $levels_to_main; $i++) {
          $require_str .= '../';
        }
        $require_str .= 'main.php";';

        $main_call_pattern = "/(\/\/)?[ ]*main\(\);/";
        if (preg_match($main_call_pattern, $test_contents) === 1) {
          $test_contents = preg_replace($main_call_pattern, $require_str,
                                        $test_contents);
        } else {
          $test_contents .= PHP_EOL . $require_str;
        }
      }
      file_put_contents($test_file, $test_contents);
    }
  }
}

main();
