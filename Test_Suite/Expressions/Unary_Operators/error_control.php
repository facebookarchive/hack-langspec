<?hh // strict

namespace NS_error_control;

function main(): void {
  $infile = fopen("NoSuchFile.txt", 'r');
  $infile = @fopen("NoSuchFile.txt", 'r');
}

//main();
