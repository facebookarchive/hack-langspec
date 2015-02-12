#Statements

##General

**Syntax**

<pre>
  <i>statement:</i>
    <i>function-static-declaration</i>
    <i>compound-statement</i>
    <i>labeled-statement</i>
    <i>expression-statement</i>
    <i>selection-statement</i>
    <i>iteration-statement</i>
    <i>jump-statement</i>
    <i>try-statement</i>
</pre>

*function-static-declaration* is defined in §7.2.3; *compound-statement* is defined in [§§](#compound-statements); *labeled-statement* is defined
in [§§](#labeled-statements); *expression-statement* is defined in [§§](#expression-statements);
*selection-statement* is defined in [§§](#general-1); *iteration-statement* is
defined in [§§](#general-2); *jump-statement* is defined in [§§](#general-3);
and *try-statement* is defined in §11.8.

##Compound Statements

**Syntax**

<pre>
  <i>compound-statement:</i>
    {  <i>statement-list<sub>opt</sub></i>  }

  <i>statement-list:</i>
    <i>statement</i>
    <i>statement-list   statement</i>
</pre>

*statement* is defined in [§§](#general).

**Semantics**

A *compound statement* allows a group of zero of more statements to be
treated syntactically as a single statement. A compound statement is
often referred to as a *block*.

**Examples**

```
if (condition)
{	// braces are needed as the true path has more than one statement
	// statement-1
	// statement-2
}
else
{	// braces are optional as the false path has only one statement
	// statement-3
}
// -----------------------------------------
while (condition)
{	// the empty block is equivalent to a null statement
}
```

##Labeled Statements

**Syntax**

<pre>
  <i>labeled-statement:</i>
    <i>case-label</i>
    <i>default-label</i>

  <i>case-label:</i>
    case   <i>expression</i>  :  <i>statement</i>

  <i>default-label:</i>
    default  :  <i>statement</i>
</pre>

*statement* is defined in [§§](#general); and
*expression* is defined in §10.21.

**Constraints**

*case-label* and *default-label* must only occur inside a `switch` statement
([§§](#the-switch-statement)).

**Semantics**

See the `switch` statement.

##Expression Statements

**Syntax**

<pre>
   <i>expression-statement:</i>
     <i>expression<sub>opt</sub></i>  ;
</pre>

*expression* is defined in §10.21.

**Semantics**

If present, *expression* is evaluated for its side effects, if any, and
any resulting value is discarded. If *expression* is omitted, the
statement is a *null statement*, which has no effect on execution.

**Examples**

```
$i = 10;  // $i is assigned the value 10; result (10) is discarded
++$i; // $i is incremented; result (11) is discarded
$i++; // $i is incremented; result (11) is discarded
DoIt(); // function DoIt is called; result (return value) is discarded
// -----------------------------------------
$i;   // no side effects, result is discarded. Vacuous but permitted
123;  // likewise for this one and the two statements following
34.5 * 12.6 + 11.987;
true;
```

##Selection Statements

###General

**Syntax**

<pre>
  <i>selection-statement:</i>
    <i>if-statement</i>
    <i>switch-statement</i>
</pre>

*if-statement* is defined in [§§](#the-if-statement) and *switch-statement* is defined
in [§§](#the-switch-statement).

**Semantics**

Based on the value of a controlling expression, a selection statement
selects among a set of statements.

###The `if` Statement

**Syntax**

<pre>
  <i>if-statement:</i>
    if   (   <i>expression</i>   )   <i>statement   elseif-clauses-opt   else-clause-opt</i>

  <i>elseif-clauses:</i>
    <i>elseif-clause</i>
    <i>elseif-clauses   elseif-clause</i>

  <i>elseif-clause:</i>
    elseif   (   <i>expression</i>   )   <i>statement</i>
 
  <i>else-clause:</i>
    else   <i>statement</i>
</pre>

*expression* is defined in §10.21; and *statement* is defined in [§§](#general).

**Constraints**

The controlling expression *expression* must have type `bool` or be
implicitly convertible to that type.

**Semantics**

The two forms of the `if` statement are equivalent; they simply provide
alternate styles.

If *expression* tests `true`, the *statement* that follows immediately is
executed. Otherwise, if an `elseif` clause is present the *statement*
immediately following the `elseif` is executed. Otherwise, any other
`elseif` *expression*s are evaluated. If none of those tests `true`, if an
`else` clause is present the *statement* immediately following the `else` is
executed.

An `else` clause is associated with the lexically nearest preceding `if` or
`elseif` that is permitted by the syntax.

**Examples**
```
if ($count > 0) {
  …
} else {
  …
}
// -----------------------------------------
if (1)
  …
  if (0)
    …
else  // this else does NOT go with the outer if
  …

if (1) {
  …
  if (0)
    …
} else  // this else does go with the outer if
  …
```

###The `switch` Statement

**Syntax**

<pre>
  <i>switch-statement:</i>
    switch  (  <i>expression</i>  )  <i>compound-statement</i>
</pre>

*expression* is defined in [§10.21; and *compound-statement* is defined in [§§](#compound-statements).

**Constraints**

The controlling expression *expression* must have scalar type.

There must be at most one default label.

Each label expression's type must be a subtype of the switch *expression* type.

**Semantics**

Based on the value of its *expression*, a `switch` statement transfers
control to a case label (§[[11.3](#labeled-statements)](#labeled-statements)); to a default label (§[[11.3](#labeled-statements)](#labeled-statements)), if one
exists; or to the statement immediately following the end of the `switch`
statement. A case or default label is only reachable directly within its
closest enclosing `switch` statement.

On entry to the `switch` statement, the controlling expression is
evaluated and then compared with the value of the case-label-expression
values, in lexical order. If one matches, control transfers to the
statement following the corresponding case label. If there is no match,
then if there is a default label, control transfers to the statement
following that; otherwise, control transfers to the statement
immediately following the end of the `switch` statement. If a `switch`
contains more than one case label whose values compare equal to the
controlling expression, the first in lexical order is consider the
match.

An arbitrary number of statements can be associated with any case or
default label. In the absence of a `break` statement (§11.7.3) at the end
of a set of such statements, control drops through into any following
case or default label. Thus, if all cases and the default end in break
and there are no duplicate-valued case labels, the order of case and
default labels is insignificant.

In no break *statement* is seen for a case or default before a subsequent case label, default label, or the switch-terminating `}` is encountered, an implementation might issue a warning. However, such a warning can be suppressed by placing a source line containing the special comment `// FALLTHROUGH` (§9.4.2), at the end of that case or default statement group.

Case-label values can be runtime expressions, and the types of sibling
case-label values need not be the same.

Switches may nested, in which case, each `switch` has its own set of
`switch` clauses.

**Examples**

```
$v = 10;
switch ($v) {
default:
  echo "default case: \$v is $v\n";
  break;    // break ends "group" of default statements
case 20:
  echo "case 20\n";
  break;    // break ends "group" of case 20 statements
case 10:
  echo "case 10\n"; // no break, so control drops into next label's "group"
  // FALLTHROUGH
case 30:
  echo "case 30\n"; // no break, but then none is really needed either
}
// -----------------------------------------
$v = 30;
switch ($v) {
case 30.0:  // <===== this case matches with 30
  echo "case 30.0\n";
  break;
default:
  echo "default case: \$v is $v\n";
  break;
case 30:    // <===== rather than this case matching with 30
  echo "case 30\n";
  break;
}
// -----------------------------------------
enum ControlStatus: int {
  Stopped = 0;
  Stopping = 1;
  Starting = 2;
  Started = 3;
}
…
switch ($p1) {
case ControlStatus::Stopped:
  echo "Stopped: $p1\n";
  break;
…
case ControlStatus::Started:
  echo "Started: $p1\n";
  break;
}
```

##Iteration Statements

###General

**Syntax**

<pre>
  <i>iteration-statement:</i>
    <i>while-statement</i>
    <i>do-statement</i>
    <i>for-statement</i>
    <i>foreach-statement</i>
</pre>

*while-statement* is defined in [§§](#the-while-statement); *do-statement* is defined in
[§§](#the-do-statement); *for-statement* is defined in [§§](#the-for-statement); and *foreach-statement*
is defined in [§§](#the-foreach-statement).

##The `while` Statement

**Syntax**

<pre>
  <i>while-statement:</i>
    while  (  <i>expression</i>  )  <i>statement</i>
</pre>

*expresion* is defined in §10.21; and *statement* is defined in [§§](#general).

**Constraints**

The controlling expression *expression* must have type `bool` or be
implicitly convertible to that type.

**Semantics**

If *expression* tests `true`, the *statement* that follows immediately is
executed, and the process is repeated. If *expression* tests `false`,
control transfers to the point immediately following the end of the
`while` statement. The loop body, *statement*, is executed zero or more
times.

**Examples**

```
$i = 1;
while ($i <= 10) {
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
// -----------------------------------------
while (true) {
  …
  if ($done)
    break;  // break out of the while loop
  …
}
```

##The `do` Statement

**Syntax**

<pre>
  <i>do-statement:</i>
    do  <i>statement</i>  while  (  <i>expression</i>  )  ;
</pre>

*statement* is defined in [§§](#general) and *expresion* is defined in §10.21.

 (Note: There is no `:/enddo` alternate syntax.)

**Constraints**

The controlling expression *expression* must have type `bool` or be
implicitly convertible to that type.

**Semantics**

First, *statement* is executed and then *expression* is tested. If its
value is `true`, the process is repeated. If *expression* tests `false`,
control transfers to the point immediately following the end of the `do`
statement. The loop body, *statement*, is executed one or more times.

**Examples**

```
$i = 1;
do {
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
while ($i <= 10);
```

##The `for` Statement

**Syntax**

<pre>
  <i>for-statement:</i>
    for   (   <i>for-initializeropt</i>   ;   <i>for-controlopt</i>   ;   <i>for-end-of-loopopt</i>   )   <i>statement</i>

  <i>for-initializer:</i>
    <i>for-expression-group</i>

  <i>for-control:</i>
    <i>for-expression-group</i>

  <i>for-end-of-loop:</i>
    <i>for-expression-group</i>

  <i>for-expression-group:</i>
    <i>expression</i>
    <i>for-expression-group</i>   ,   <i>expression</i>
</pre>

*statement* is defined in [§§](#general)
and *expression* is defined in §10.21.

Note: Unlike C/C++, Hack does not support a comma operator, per se.
However, the syntax for the `for` statement has been extended from that of
C/C++ to achieve the same results in this context.

**Constraints**

The controlling expression—the right-most *expression* in
*for-control*—must have type `bool` or be implicitly convertible to that
type.

**Semantics**

The group of expressions in *for-initializer* is evaluated once,
left-to-right, for their side effects. Then the group of expressions in
*for-control* is evaluated left-to-right (with all but the right-most
one for their side effects only), with the right-most expression's value
being tested. If that tests `true`, *statement* is executed, and the group
of expressions in *for-end-of-loop* is evaluated left-to-right, for
their side effects only. Then the process is repeated starting with
*for-control*. If the right-most expression in *for-control* tests
`false`, control transfers to the point immediately following the end of
the `for` statement. The loop body, *statement*, is executed zero or more
times.

If *for-initializer* is omitted, no action is taken at the start of the
loop processing. If *for-control* is omitted, this is treated as if
*for-control* was an expression with the value `TRUE`. If
*for-end-of-loop* is omitted, no action is taken at the end of each
iteration.

**Examples**

```
for ($i = 1; $i <= 10; ++$i) {
  echo "$i\t".($i * $i)."\n"; // output a table of squares
}
// -----------------------------------------
// omit 1st and 3rd expressions

$i = 1;
for (; $i <= 10;) {
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
// -----------------------------------------
// omit all 3 expressions

$i = 1;
for (;;) {
  if ($i > 10)
    break;
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
// -----------------------------------------
//  use groups of expressions

for ($a = 100, $i = 1; ++$i, $i <= 10; ++$i, $a -= 10) {
  echo "$i\t$a\n";
}
```

##The `foreach` Statement

**Syntax**

<pre>
  <i>foreach-statement:</i>
    foreach  (  <i>foreach-collection-name</i>  as  <i>foreach-key<sub>opt</sub>  foreach-value</i>  )   statement

  <i>foreach-collection-name</i>:
    <i>expression</i>

  <i>foreach-key:</i>
    <i>expression</i>  =>

  <i>foreach-value:<i>
    &amp;<sub>opt</sub>   <i>expression</i>
    <i>list-intrinsic</i>
</pre>

*statement* is defined in [§§](#general); *list-intrinsic* is defined in
§10.4.2.6; and *expression* is defined in §10.21.

**Constraints**

The variable designated by *foreach-collection-name* must be a
collection.

Each *expression* must designate a variable name.

**Semantics**

The *foreach* statement iterates over the set of elements in the
collection designated by *foreach-collection-name*, starting at the
beginning, executing *statement* each iteration. On each iteration, if
the `&` is present in *foreach-value*, the variable designated by the
corresponding *expression* is made an alias to the current element. If
the `&` is omitted, the value of the current element is assigned to the
corresponding variable. The loop body, *statement*, is executed zero or
more times.

If *foreach-key* is present, the variable designated by its *expression*
is assigned the current element's key value.

In the *list-intrinsic* case, a value that is an array is split into
individual elements.

**Examples**

```
$colors = array("red", "white", "blue");
foreach ($colors as $color) {
   …
};
// -----------------------------------------
foreach ($colors as $key => $color) {
  …
}
// -----------------------------------------
// Modify the local copy of an element's value

foreach ($colors as $color) {
  $color = "black";
}
// -----------------------------------------
// Modify the the actual element itself

foreach ($colors as &$color) {  // note the &
  $color = "black";
}
```

##Jump Statements

###General

**Syntax**

<pre>
  <i>jump-statement:</i>
    <i>continue-statement</i>
    <i>break-statement</i>
    <i>return-statement</i>
    <i>throw-statement</i>
</pre>

*continue-statement* is defined
in [§§](#the-continue-statement); *break-statement* is defined in [§§](#the-break-statement); *return-statement*
is defined in [§§](#the-return-statement); and *throw-statement* is defined in [§§](#the-throw-statement).

###The `continue` Statement

**Syntax**

<pre>
  <i>continue-statement:</i>
    continue  ;
</pre>

**Constraints**

A `continue` statement must not attempt to break out of a finally-block
([§§](#the-try-statement)).

**Semantics**

A `continue` statement terminates the execution of the innermost enclosing
iteration ([§§](#iteration-statements)) or `switch` ([§§](#the-switch-statement)) statement.

A `continue` statement may break out of a construct that is fully
contained within a finally-block.

**Examples**

```
for ($i = 1; $i <= 5; ++$i) {
  if (($i % 2) == 0)
    continue;
  echo "$i is odd\n";
}
```

##The `break` Statement

**Syntax**

<pre>
  <i>break-statement:</i>
    break  ;
</pre>

**Constraints**

A `break` statement must not attempt to break out of a finally-block
([§§](#the-try-statement)).

**Semantics**

A `break` statement terminates the execution of one or more enclosing
iteration ([§§](#iteration-statements)) or `switch` ([§§](#the-switch-statement)) statements.

A `break` statement may break out of a construct that is fully contained
within a finally-block.

**Examples**

```
$i = 1;
for (;;) {
  if ($i > 10)
    break;
  …
  ++$i;
}
```

###The `return` Statement

**Syntax**

<pre>
  <i>return-statement:</i>
    return  <i>expression<sub>opt</sub></i>  ;
</pre>

*expression* is defined in §10.21. 

**Constraints**

The *expression* in a *return-statement* in a generator function
([§§](10-expressions.md#yield-operator)) must be the literal `null`.

A `return` statement must not occur in a finally-block (§11.8).

For a non-async function, the type of *expression* (or any implicitly returned `null`) must be assignment-compatible with the return type of the enclosing function (§15.3). For an async function, the type of *expression* must be a subtype of the parameter type of the `Awaitable` *return*-type for the enclosing function.

**Semantics**

A `return` statement from within a function terminates the execution of
that function normally, and for a non-async function, it returns the value of *expression* to the function's caller
by value or byRef. If *expression* is omitted the value `null` is used. For an async function, the value of *expression* is wrapped in an `Awaitable` object, which is then returned. 

If execution flows into the closing brace (`}`) of a function, 
`return null;` is implied.

A function may have any number of `return` statements, whose returned
values may have different types.

A `return` statement is permitted in a try-block ([§§](#the-try-statement)) and a catch-block
([§§](#the-try-statement)).

Returning from a constructor or destructor behaves just like returning
from a function having a return type of `void`.

A `return` statement inside a generator function causes the generator to
terminate.

Return statements can be used in the body of anonymous functions.

**Examples**

```
function f(): int { return 100; } // f explicitly returns a value
function g(): void {  return; } // g explicitly returns an implicit null
function h(): void { }    // h implicitly returns null
// -----------------------------------------
// j returns one of three dissimilarly-typed values
function j(int $x): mixed {
  if ($x > 0) {
    return "Positive";
  } else if ($x < 0) {
    return -1;
  }
  // for zero, implied return null
}
// -----------------------------------------
class Point {
  private static int $pointCount = 0;
  public static function getPointCount(): int {
    return self::$pointCount;
  }
  …
}
```

**Implementation Notes**

Although *expression* is a full expression ([§§](10-expressions.md#general)), and there is a
sequence point ([§§](10-expressions.md#general)) at the end of that expression, as stated in
[§§](10-expressions.md#general), a side effect need not be executed if it can be decided that
no other program code relies on its having happened. (For example, in
the cases of `return $a++;` and `return ++$a;`, it is obvious what value
must be returned in each case, but if `$a` is a variable local to the
enclosing function, `$a` need not actually be incremented.

###The `throw` Statement

**Syntax**

<pre>
  <i>throw-statement:</i>
    throw  <i>expression</i>  ;
</pre>

*expression* is defined in §10.21. 

**Constraints**

The type of *expression* must be \Exception (§19.2) or a subclass of that
class.

*expression* must be such that an alias to it can be created. 

**Semantics**

A `throw` statement throws an exception immediately and unconditionally.
Control never reaches the statement immediately following the throw. See
§19.1 and [§§](#the-try-statement) for more details of throwing and catching exceptions,
and how uncaught exceptions are dealt with.

Rather than handle an exception, a catch-block may (re-)throw the same
exception that it caught, or it can throw an exception of a different
type.

**Examples**

```
throw new Exception;
throw new Exception("Some message", 123);
class MyException extends Exception { ... }
throw new MyException;
```

##The `try` Statement

**Syntax**

<pre>
  <i>try-statement:</i>
    try  <i>compound-statement   catch-clauses</i>
    try  <i>compound-statement   finally-clause</i>
    try  <i>compound-statement   catch-clauses   finally-clause</i>

  <i>catch-clauses:</i>
    <i>catch-clause</i>
    <i>catch-clauses   catch-clause</i>

  <i>catch-clause:</i>
    catch  (  <i>parameter-declaration-list</i>  )  <i>compound-statement</i>

  <i>finally-clause:</i>
    finally   <i>compound-statement</i>
</pre>

*compound-statement* is defined in [§§](#compound-statements) and
*parameter-declaration-list* is defined in §15.3.

**Constraints**

In a *catch-clause*, *parameter-declaration-list* must contain only one
parameter, and its type must be `\Exception` (§19.2) or a type derived from
that class.

**Semantics**

In a *catch-clause*, *identifier* designates an *exception variable*
passed in by value. This variable corresponds to a local variable with a
scope that extends over the catch-block. During execution of the
catch-block, the exception variable represents the exception currently
being handled.

Once an exception is thrown, the Engine searches for the nearest
catch-block that can handle the exception. The process begins at the
current function level with a search for a try-block that lexically
encloses the throw point. All catch-blocks associated with that
try-block are considered in lexical order. If no catch-block is found
that can handle the run-time type of the exception, the function that
called the current function is searched for a lexically enclosing
try-block that encloses the call to the current function. This process
continues until a catch-block is found that can handle the current
exception. 

If a matching catch-block is located, the Engine prepares to transfer
control to the first statement of that catch-block. However, before
execution of that catch-block can start, the Engine first executes, in
order, any finally-blocks associated with try-blocks nested more deeply
than the one that caught the exception. 

If no matching catch-block is found, the behavior is
implementation-defined.

**Examples**

```
function getTextLines(string $filename): Continuation<string> {
  $infile = fopen($filename, 'r');
  if ($infile == false) { /* deal with an file-open failure */ }
  try {
    while ($textLine = fgets($infile)) {  // while not EOF
      yield $textLine;  // leave line terminator attached
    }
  } finally {
    fclose($infile);
  }
}
// -----------------------------------------
class DeviceException extends Exception { … }
class DiskException extends DeviceException { … }
class RemovableDiskException extends DiskException { … }
class FloppyDiskException extends RemovableDiskException { … }

try {
  process(); // call a function that might generate a disk-related exception
}
catch (FloppyDiskException $fde) { … }
catch (RemovableDiskException $rde) { … }
catch (DiskException $de) { … }
catch (DeviceException $dve) { … }
finally { … }
```
