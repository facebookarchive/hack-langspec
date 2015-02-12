#Script Inclusion Operators

##General

**Syntax**

<pre>
  <i>inclusion-directive:</i>
    <i>require-multiple-directive</i>
    <i>require-once-expression</i>
</pre>

*require-multiple-directive* is described in §12.2; and
*require-once-expression* is described in §12.3.

**Semantics:**

When creating large applications or building component libraries, it is
useful to be able to break up the source code into small, manageable
pieces each of which performs some specific task, and which can be
shared somehow, and tested, maintained, and deployed individually. For
example, a programmer might define a series of useful constants and use
them in numerous and possibly unrelated applications. Likewise, a set of
class definitions can be shared among numerous applications needing to
create objects of those types.

An *include file* is a script that is suitable for *inclusion* by
another script. The script doing the including is the *including file*,
while the one being included is the *included file*. A script can be an
including file and an included file, either, or neither.

It is important to understand that unlike the C/C++ (or similar)
preprocessor, script inclusion in PHP is not a text substitution
process. That is, the contents of an included file are not treated as if
they directly replaced the inclusion operation source in the including
file.

The name used to specify an include file may contain an absolute or
relative path. In the latter case, an implementation may use the
configuration directive
[`include_path`](http://docs.hhvm.com/manual/en/ini.core.php#ini.include-path)
(§xx) to resolve the include file's location.

##The `require` Directive

**Syntax**

<pre>
<i>require-multiple-directive:</i>
  require  (  <i>include-filename</i>  )
  require  <i>include-filename</i>
<i>include-filename:</i>
  <i>expression</i>
</pre>

*expression* is defined in §10.21.

**Constraints**

*expression* must be a string that designates a file that exists, is accessible, and whose format is suitable for inclusion (that is, starts with a Hack start-tag (§4.1)).

**Semantics:**

If the designated file is not accessible, execution is terminated.

Variables defined in an included file take on scope of the source line on which the inclusion occurs in the including file. However, functions and classes defined in the included file are given global scope.

The library function `get_included_files` (§xx) provides the names of
all files included or required.

**Exmaples**

```php
require 'Point.php';
require ('Circle.php');
```

##The `require_once` Directive

**Syntax**

<pre>
  <i>require-once-directive:</i>
    require_once  (  <i>include-filename</i>  )
    require_once  <i>include-filename</i>
</pre>

*include-filename* is defined in §12.2.   

**Semantics:**

This operator is identical to operator `require` (§12.2) except that in
the case of `require_once`, the include file is included once only during
program execution.

**Examples**

```php
// Point.php
<?hh …
class Point { … }

// Circle.php
<?hh …
require_once 'Point.php';
class Circle { /* uses Point somehow */ }

// MyApp.php
require _once 'Point.php';    // Point.php included directly
require _once 'Circle.php';   // Point.php now not included indirectly
$p1 = new Point(10, 20);
$c1 = new Circle(9, 7, 2.4);
```
