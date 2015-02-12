<?hh

// Require main.php file in any test file that needs to run in HHVM
// and actually pass the Hack type checker since *strict* Hack
// files cannot have top-level statements other than "require"s.
main();
