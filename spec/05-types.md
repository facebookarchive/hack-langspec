#Types

##General

The meaning of a value is decided by its *type*. Hack's types are
categorized as *scalar types* and *composite types*. The scalar types
are Boolean ([§§](#the-boolean-type)), integer ([§§](#the-integer-type)), floating-point ([§§](#the-floating-point-type)), numeric ([§§](05-types.md#the-numeric-type)), string
([§§](#the-string-type)), array key ([§§](05-types.md#the-array-key-type)), null ([§§](#the-null-type)), and
enumerated ([§§](05-types.md#enumerated-types)). The non-scalar types are array ([§§](05-types.md#array-types)), class ([§§](05-types.md#class-types)), 
interface ([§§](05-types.md#interface-types)), tuple ([§§](05-types.md#tuple-types)), shape ([§§](05-types.md#shape-types)), closure ([§§](05-types.md#closure-types)), resource 
([§§](05-types.md#resource-types)), and nullable ([§§](05-types.md#nullable-types)). The void type ([§§](05-types.md#the-void-type)) is neither scalar nor 
non-scalar.

The integer, floating-point, and numeric types are known collectively as
arithmetic types. (Note carefully, that the library function is_numeric (§xx
indicates if a given value is an int, a float, or a numeric string ([§§](05-types.md#the-string-type)).)

The scalar types are *value types*. That is, a variable of scalar type
behaves as though it contains its own value. On the
other hand, the non-scalar types are *handles*. A variable of
non-scalar type contains information—in a *handle*—that leads to the
value. The differences between value types and handles become apparent
when it comes to understanding the semantics of assignment, and passing
arguments to, and returning values from, functions ([§§](04-basic-concepts.md#the-memory-model)). That said,
array types really are a hybrid; on the one hand, an array may contain
an arbitrary number of elements separate from the array variable itself,
yet on the other hand, certain array operations do have value semantics.

**Note**: One could differentiate value types and handles in the same way that pass-by-value and pass-by-reference types are distinguished.

Variables are not declared to have a particular type. Instead, a
variable's type is decided at runtime by the context in which it is
used.

The library function `is_scalar` (§xx) indicates if a given value has a scalar
type. However, that function does not consider `null` to be scalar. To test
for `null`, use `is_null` (§xx). Useful library functions for interrogating and using type information include `gettype` (§xx), `is_type` (§xx), `settype` (§xx), and `var_dump` (§xx).

**Syntax**
<pre>
<i>type-specifier:</i>
  bool
  int
  float
  num
  string
  arraykey
  void
  resource
  <i>alias-type-specifier</i>
  <i>vector-like-array-type-specifier</i>
  <i>map-like-array-type-specifier</i>
  <i>enum-specifier</i>
  <i>class-interface-trait-specifier</i>
  <i>tuple-type-specifier</i>
  <i>closure-type-specifier</i>
  <i>nullable-type-specifier</i>
  <i>generic-type-parameter-name</i>

<i>alias-type-specifier:</i>
  <i>qualified-name</i>

<i>enum-specifier:</i>
  <i>qualified-name

<i>class-interface-trait-specifier:</i>
  <i>qualified-name generic-type-argument-list<sub>opt</sub></i>

<i>type-specifier-list:</i>
  <i>type-specifier</i>
  <i>type-specifier-list</i> , <i>type-specifier</i>
</pre>

*vector-like-array-type-specifier* is defined in [§§](05-types.md#array-types); 
*map-like-array-type-specifier* is defined in [§§](05-types.md#array-types); *tuple-type-specifier* is
defined in [§§](05-types.md#tuple-types); *closure-type-specifier* is defined in [§§](05-types.md#closure-types); 
*nullable-type-specifier* is defined in [§§](05-types.md#nullable-types); *generic-type-parameter-name*
is defined in [§§](14-generic-types-methods-and-functions.md#type-parameters); *generic-type-argument-list* is defined in [§§](14-generic-types-methods-and-functions.md#type-arguments); and
*qualified-name* is defined in [§§](09-lexical-structure.md#names).

**Constraints**

The *qualified-name* in *alias-type-specifier* must qualify the *name* of a
type alias declared in an *alias-declaration* ([§§](05-types.md#type-aliases)).

The *qualified-name* in *enum-specifier* must qualify the *name* of an enumerated type declared in an *enum-declaration* ([§§](13-enums.md#enum-declarations)).

The *qualified-name* in *class-interface-trait-specifier* must qualify the
*name* of a class type declared in a *class-declaration* ([§§](16-classes.md#class-declarations)), of an
interface type declared in an *interface-declaration* ([§§](17-interfaces.md#interface-declarations)), or of a trait
type declared in a *trait-declaration* ([§§](18-traits.md#trait-declarations)).

The *name* of a trait type declared in a *trait-declaration* can only be used
as a type-specifier in the context of a *trait-use-clauses* ([§§](18-traits.md#trait-declarations)).

###The Boolean Type

The Boolean type is `bool`. This
type is capable of storing two distinct values, which correspond to the
Boolean values `true` and `false`, respectively. The representation of
this type and its values is unspecified.

The library function `is_bool` (§xx) indicates if a given value has type
`bool`.

###The Integer Type

There is one integer type, `int`.
This type is binary, signed, and uses twos-complement representation for
negative values. The range of values that can be stored is
implementation-defined; however, the range [-9223372036854775808, 9223372036854775807],
must be supported.

Certain operations on integer values produce a mathematical result that
cannot be represented as an integer. Examples include the following:

-   Incrementing the largest value or decrementing the smallest value
-   Applying the unary minus to the smallest value
-   Multiplying, adding, or subtracting two values

In such cases, the resulting type and value is implementation-defined,
but must be one of the following:

-   The result type is int and the value reflects wrap-around (for
    example adding 1 to the largest value results in the smallest value)
-   The computation is done as though the type had some unspecified,
    arithmetic-like object type with the result being mathematically
    correct

The constants `PHP_INT_SIZE` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)) and `PHP_INT_MAX` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)) define certain
characteristics about type `int`.

The library function `is_int` (§xx) indicates if a given value has type
int.

###The Floating-Point Type

There is one floating-point type, `float`. The `float` type must support at least the range and
precision of IEEE 754 64-bit double-precision representation.

The library function `is_float` (§xx) indicates if a given value has type
`float`. The library function `is_finite` (§xx) indicates if a given
floating-point value is finite. The library function `is_infinite` (§xx)
indicates if a given floating-point value is infinite. The library
function `is_nan` (§xx) indicates if a given floating-point value is a
`NaN`.

###The Numeric Type

The type `num` can represent any integer or floating-point value.

See the discussion of type side effects ([§§](05-types.md#type-side-effects)).

###The String Type

The is one string type, `string`.

A string is a set of contiguous bytes that represents a sequence of zero
or more characters.

Conceptually, a string can be considered as an array ([§§](05-types.md#array-types)) of
bytes—the *elements*—whose keys are the `int` values starting at zero. The
type of each element is `string`. However, a string is *not* considered a
collection, so it cannot be iterated over.

A string whose length is zero is an *empty string*.

As to how the bytes in a string translate into characters is
unspecified.

Although a user of a string might choose to ascribe special semantics to
bytes having the value `U+0000`, from Hack's perspective, such *null bytes*
are simply just bytes! Hack does not assume strings contain any specific
data or assign special values to any bytes or sequences. However, many
library functions assume the strings they receive as arguments are UTF-8
encoded, often without explicitly mentioning that fact.

A *numeric string* is a string whose content exactly matches the pattern
defined using integer format by the production *integer-literal*
([§§](09-lexical-structure.md#integer-literals)) or using floating-point format by the production
*floating-literal* ([§§](09-lexical-structure.md#floating-point-literals)), where leading whitespace is permitted.
A *leading-numeric string* is a string whose initial characters follow
the requirements of a numeric string, and whose trailing characters are
non-numeric. A *non-numeric string* is a string that is not a numeric
string.

Only one mutation operation may be performed on a string, offset
assignment, which involves the simple assignment operator = ([§§](10-expressions.md#simple-assignment)).

The library function `is_string` (§xx) indicates if a given value has
type `string`.

###The Array Key Type
The type `arraykey` can represent any integer or string value.

See the discussion of type side effects ([§§](05-types.md#type-side-effects)).

###The Null Type

The null type has only one possible value, `NULL` ([§§](06-constants.md#core-predefined-constants)). The representation
of this type and its value is unspecified.

The library function `is_null` (§xx) indicates if a given value is `NULL`.

###Enumerated Types

Enumerated types are described in [§§](13-enums.md#enums).

###The Void Type

The type `void` indicates the absence of a value. Its primary use is as the
return type of a function.

Note: Although the grammar permits the use of the `void` type as the type of a
constant, a property, or a function parameter; as a key or value type in an
array type; or as an argument type of a generic, almost all such uses are
likely to be ill conceived.

###Array Types

**Syntax**
<pre>
<i>vector-like-array-type-specifier:</i>
  array &lt; <i>array-value-type-specifier</i> &gt;

<i>map-like-array-type-specifier:</i>
  array &lt; <i>array-value-type-specifier</i> , <i>array-value-type-specifier</i> &gt;

<i>array-value-type-specifier:</i>
  <i>type-specifier</i>

<i>array-key-type-specifier:</i>
  <i>type-specifier</i>
</pre>

<i>type-specifier</i> is defined in [§§](05-types.md#general).

**Constraints**

This is not currently a syntax constraint, but ... Although 
*array-key-type-specifier* can really be any type, **including** `void`,
behind the scenes, the key is actually represented as an `int` or `string`,
so (possibly surprising, or at least, unexpected) conversions occur when other
key types are specified. Similarly, *array-value-type-specifier* can really be
any type, **including** `void`. **Warning: Here be dragons!** Programmers are
strongly advised to avoid using key types other than `int` or `string`, and to
avoid using a value type of `void`.

**Semantics**

An *array* is a data structure that contains a collection of zero or more elements each of which is accessed through a corresponding key. As the number
of elements in an array can change at runtime, the *type-specifier* for an
array does not include an element count.

For a *vector-like-array-type-specifier*, the array has an implicit key type
of `int`, and an explicit value type as indicated by
*array-value-type-specifier*.

For a *map-like-array-type-specifier*, the array has an explicit key type as
indicated by *array-key-type-specifier*, and an explicit value type as
indicated by *array-value-type-specifier*.

Each element in an array must have a type that is the exact type indicated by
*array-value-type-specifier*, or a subtype ([§§](05-types.md#supertypes-and-subtypes)) of that type. For example,
an array of `num` can contain a mixture of `int` elements and `float` elements.

An array element can have any type (which allows for arrays of arrays).

An array is represented as an ordered map in which each entry is a key/value
pair that represents an element. Duplicate keys are not permitted. The order
of the elements in the map is the order in which the elements were inserted
into the array. An element is said to *exist* once it has been inserted into
the array with a corresponding key. An array is *extended* by initializing a
previously non-existent element using a new key. Elements cannot be removed
from an array.

The `foreach` statement ([§§](11-statements.md#the-foreach-statement)) can be used to iterate over the collection
of elements in an array, in the order in which the elements were inserted.
This statement provides a way to access the key and value for each element.

Each array has its own current element pointer that designates the current
array element. When an array is created, the current element is the first
element inserted into the array.

[Note: Arrays in Hack are quite different to arrays in numerous mainstream
languages. Specifically, in Hack, array elements need not have the same type,
the subscript index need not be an integer (so there is no concept of a base
index of zero or 1), and there is no concept of consecutive elements occupying
physically adjacent memory locations.]

An array is created and initialized by one of two equivalent ways: via the array-creation operator `[]` ([§§](10-expressions.md#array-creation-operator)) or the intrinsic `array` ([§§](10-expressions.md#array)).

The value (and possibly the type) of an existing element is obtained or
changed, and new elements are inserted, using the subscript operator `[]`
([§§](10-expressions.md#subscript-operator)).

The library function `is_array` (§xx) indicates if a given value is an array.
Numerous other library functions are available to create and/or manipulate
arrays.

**Examples**
```Hack
private array<string> $colorsVect;
private array<int, string> $colorsMap;
private array<num> $measurements = array(10, 25.55);
private array<int, mixed> $items = array(true, 123, ‘red’, null);
private array<array<int>> $valueSets = array(array(10,20,30,40), array(1,2));
function f(array<?Button> $buttons): void { … }
function getProcesses(): array<?(function (string): int)> { … }
```

###Class Types

Class types are described in [§§](16-classes.md#classes).

See the discussion of type side effects ([§§](05-types.md#type-side-effects)).

The library function `is_object` (§xx) indicates if a given value is an
instance of any class, and the library function
[`get_class`](http://docs.hhvm.com/manual/en/function.get-class.php)
(§xx) indicates the name of an object's class. See also the `instanceof`
operator ([§§](10-expressions.md#instanceof-operator)).

###Interface Types

Interface types are described in [§§](17-interfaces.md#interfaces).

See the discussion of type side effects ([§§](05-types.md#type-side-effects)).

###Trait Types

Trait types are described in [§§](18-traits.md#traits).

Although traits are used to declare class and interface types, a trait type
cannot be used in the usual context of a type name (see Constraints in [§§](05-types.md#general)).
That said, for the purposes of subtyping ([§§](05-types.md#supertypes-and-subtypes)), traits are considered types.

###Tuple Types

**Syntax**
<pre>
<i>tuple-type-specifier:</i>
  ( <i>type-specifier</i>  ,  <i>type-specifier-list</i>  )
</pre>

*type-specifier* is defined in [§§](05-types.md#general); and *type-specifier-list* is defined in
[§§](05-types.md#general).

**Semantics**

A *tuple* is a sequence of one or more elements the number of which is fixed
at the time of tuple creation. After a tuple has been created, no elements can
be added or removed, and the type of an existing element cannot be changed.
However, the value of any existing element can be changed. Each element can
have any type, and each unique, lexically ordered combination of element types
designates a distinct tuple type.

A tuple can be indexed with the subscript operator ([§§](10-expressions.md#subscript-operator)). The index of the
first element is zero, with subsequent elements having index values one more
than their predecessor. Specifically, for a tuple having n elements, their
indices are 0–*n*-1.

Note: Although a tuple of only one element can be created using a tuple
literal ([§§](10-expressions.md#tuple-literals)), a *tuple-type-specifier* must contain at least two elements.
While this disallows a function to take an argument or to return a value of
type (*T*), for example, one could simply declare that function to take or
return a value of type *T* directly instead.

**Examples**

```Hack
function f1((int, string) $p): void { … }
// -----------------------------------------
function f2(): (bool, array<int>, float) {
  return tuple(true, array(99, 88, 77), 10.5);
}
// -----------------------------------------
private ?(int, (string, float)) $prop = null;
```

###Shape Types

**Syntax**
<pre>
<i>shape-specifier:</i>
  shape ( <i>field-specifier-list<sub>opt</sub></i> )

<i>field-specifier-list:</i>
  <i>field-specifier</i>
  <i>field-specifier-list</i>  ,  <i>field-specifier</i>

<i>field-specifier:</i>
  <i>single-quoted-string-literal</i>  =>  <i>type-specifier</i>
  <i>integer-literal</i>  =>  <i>type-specifier</i>
  <i>qualified-name</i>  =>  <i>type-specifier</i>
</pre>

*single-quoted-string-literal* is defined in [§§](09-lexical-structure.md#single-quoted-string-literals); *integer-literal*
is defined in [§§](09-lexical-structure.md#integer-literals); *qualified-name* is defined in [§§](09-lexical-structure.md#names); and
*type-specifier* is defined in [§§](05-types.md#general).

**Constraints**

*qualified-name* must designate a class constant ([§§](16-classes.md#constants)) of type `int` or
`string`.

Each string in the set of strings designated by all the
*single-quoted-string-literals* and *qualified-names* in a
*field-specifier-list* must have a distinct value.

Each integer in the set of all the *integer-literals* and *qualified-names*
in a *field-specifier-list* must have a distinct value.

The *field-specifiers* in a *field-specifier-list* must all have the
*single-quoted-string-literal* form, the *integer-literal form*, or all
have the *qualified-name* form; the forms must not be mixed.

*shape-specifier* cannot be used as a *type-specifier* (see Examples below).

**Semantics**

A *shape* consists of a group of zero or more data *fields* taken together as
a whole. [It takes on the role of what C and C# call a struct.] Such a
construct is sometimes referred to as a "lightweight class".

A *shape-specifier* defines a shape type as having an ordered set of fields
each of which has a name (indicated by *single-quoted-string-literal*,
*integer-literal*, or *qualified-name*) and a type (indicated by 
*type-specifier*). A field in a shape is accessed using its name as the key in
a *subscript-expression* ([§§](10-expressions.md#subscript-operator)) that operates on a shape of the
corresponding shape type.

**Examples**

Consider the case in which we wish a type to represent a point in
two-dimensional space. This can be implemented as a shape containing a pair of
integers, using the following *shape-specifier*:

```Hack
shape('x' => int, 'y' => int)
```

However, such a construct does not directly define a first-class type.
Specifically, such a type cannot be used as a *type-specifier* (in any of the
usual places such as in the type of a property, a function parameter, a
function return, or a constraint). Despite this, it makes sense for shapes to
be described in this clause. A *shape-specifier* can only be used as a
*type-to-be-aliased* in an *alias-declaration* ([§§](05-types.md#type-aliases)). For example, the
following use is not permitted:

```Hack
function f1(shape('x' => int, 'y' => int) $p1): void { … }
```

To use a shape type, we must first create an alias — such as the name `Point`
below — for that *shape-specifier*. Once that is done, the alias name can be
used in any context in which a *type-specifier* can occur. For example:

```Hack
type Point = shape('x' => int, 'y' => int);
function f2(Point $p1): void {}
private Point $origin;
// -----------------------------------------
type Complex = shape('real' => float, 'imag' => float);
type IdSet = shape('id' => string, 'url' => string, 'count' => int);
type APoint<T> = shape('x' => T, 'y' => T);
type Sh = shape('n1' => (int, float),'n2' => ?(function (array<num>): bool));
```

###Closure Types

**Syntax**
<pre>
<i>closure-type-specifier:</i>
( function ( <i>type-specifier-list<sub>opt</sub></i> ) : <i>type-specifier</i> )
</pre>

*type-specifier-list* is defined in [§§](05-types.md#general); *type-specifier* is defined in [§§](05-types.md#general).

**Semantics**

A *closure* is an object that encapsulates a function with a given argument
list and return type. The function can then be called through that object by
using the function-call operator ([§§](10-expressions.md#function-call-operator)).

Note: The library functions `class_meth` (§xx), `fun` (§xx), `inst_meth` 
(§xx), and `meth_caller` (§xx) allow a string constant containing the name of
a function to be turned into a closure.

**Examples**

```Hack
private (function (): void) $prop;
public function setProcess1((function (int): (int, int)) $val): void { … }
public function getProcess2(): (function (): ?array<int>) { … }
// -----------------------------------------
function doit(int $iValue, (function (int): int) $process): int {
  return $process($iValue);
}
$result = doit(5, function (int $p) { return $p * 2; });    // doubles 5
$result = doit(5, function (int $p) { return $p * $p; });   // squares 5
```

###Resource Types

A [*resource*](http://docs.hhvm.com/manual/en/language.types.resource.php)
is a descriptor to some sort of external entity. (Examples include
files, databases, and sockets.)

A resource is an abstract entity whose representation is unspecified.
Resources are only created or consumed by the implementation; they are
never created or consumed by Hack code.

Each distinct resource has a unique ID of some unspecified form.

When scripts execute in a mode having a command-line interface, the
following predefined resource-like constants that correspond to file streams
are automatically opened at program start-up:

-   STDIN, which maps to standard input (php://stdin)
-   STDOUT, which maps to standard output (php://stdout)
-   STDERR, which maps to standard error (php://stderr)

These constants have some unspecified type, which behaves like a subtype of
type `resource`.

The library function `is_resource` (§xx) indicates if a given value is a
resource, and the library function
[`get_resource_type`](http://docs.hhvm.com/manual/en/function.get-resource-type.php)
(§xx) indicates the type of a resource.

###Nullable Types

**Syntax**
<pre>
  <i>nullable-type-specifier:</i>
  ? <i>type-specifier</i>
  mixed
</pre>

*type-specifier* is defined in [§§](05-types.md#general).

**Constraints**

*type-specifier* must not be `void` or `mixed`.

**Semantics**
Except for the type `mixed`, a *nullable* type can represent all of the values
of its underlying type, plus an additional value, `null`. In such cases, a
nullable type is written *?T*, where *T* is the underlying type. For example, a
variable of type `?bool` can contain the values `true`, `false`, or `null`.

A variable of type `mixed` can represent the values of any other type, including any nullable type, which makes mixed a nullable type. (As such,
there is no type `?mixed`.)

See the discussion of type side effects ([§§](05-types.md#type-side-effects)).

**Examples**
```Hack
private ?bool $pr_nbool;
private mixed $pr_mixed;
private array<?int> $a_nint = array(3, null);   // array of nullable int
private ?Button $pr_nButton;                    // nullable class
private ?MyCollection $pr_nMyCollection;        // nullable interface
private ?(int, ?string, ?(bool, int)) $pr;      // nullable tuple whose
    // second element has type "nullable string", and whose third element
    // has type "nullable tuple of bool and int"
```

###Generic Types
Hack contains a mechanism to define generic (that is, type-less) classes,
interfaces, and traits, and to create type-specific instances of them via
parameters. See [§§](14-generic-types-methods-and-functions.md#generic-types-methods-and-functions).

###Type Aliases

**Syntax**
<pre>
<i>alias-declaration:</i>
  type  <i>name</i>  =  <i>type-to-be-aliased</i>  ;
  newtype  <i>name</i>  <i>type-constraint<sub>opt</sub></i>  =  <i>type-to-be-aliased</i>  ;

<i>type-constraint:</i>
  as  <i>type-constraint-type</i>

<i>type-constraint-type:</i>
  <i>type-specifier</i>

<i>type-to-be-aliased:</i>
  <i>type-specifier</i>
  <i>qualified-name</i>
  <i>shape-specifier</i>
</pre>

*name* is defined in [§§](09-lexical-structure.md#names); *qualified-name* is defined in [§§](09-lexical-structure.md#names);
*type-specifier* is defined in [§§](05-types.md#general); and *shape-specifier* is defined in [§§](05-types.md#general)6.

**Constraints**

*type-specifier* in *type-to-be-aliased* must not be *enum-specifier* ([§§](05-types.md#general))
or *class-interface-trait-specifier* ([§§](05-types.md#general)).

*qualified-name* in *type-to-be-aliased* must be defined the *name* in an
*enum-declaration* ([§§](13-enums.md#enum-declarations)), in a *class-declaration* ([§§](16-classes.md#class-declarations)), or in an
*interface-declaration* ([§§](17-interfaces.md#interface-declarations)).

*qualified-name* in *alias-type-specifier* must be defined as the *name* for a
type via an *alias-declaration*.

*type-constraint-type* must be a subtype of *type-to-be-aliased*.

**Semantics**

An *alias-declaration* creates an alias *name* for the type specified by
*type-to-be-aliased*. Once such a type alias has been defined, that alias can
be used in any context in which *type-specifier* is permitted.

Any given type can have multiple aliases, and a type alias can itself have
aliases.

An alias created using `type` is a *transparent type alias*. For a given type,
that type and all transparent aliases to that type are all the same type, and
can be freely interchanged. There are no restrictions on where a transparent
type alias can be defined or which source code can access its underlying
implementation.

An alias created using `newtype` is an *opaque type alias*. In the absence of
a *type-constraint*, each opaque alias type is distinct from its 
underlying type and from any other types aliasing it or its underlying type. Only source code in the file that contains the definition of the opaque type alias is allowed access to the underlying implementation. As such, opaque type aliasing is an abstraction mechanism. Consider the following file, which contains an opaque alias definition:

```Hack
newtype Point = (int, int);

function create_point(int $x, int $y): Point {
  return tuple($x, $y);
}

function distance(Point $p1, Point $p2): float {
  $dx = $p1[0] - $p2[0];
  $dy = $p1[1] - $p2[1];
  return sqrt($dx*$dx + $dy*$dy);
}
```

Being in the same file as the alias definition, the functions `create_point`
and distance have direct access to the integer fields in any `Point`'s tuple.
However, any file that includes this file does not.

Similarly, if a file defines the following alias:

`newtype Widget = int;`

any file that includes this file has no knowledge that a `Widget` is really an
integer, so that the including file cannot perform any integer-like operations
on a `Widget`.

The presence of a *type-constraint* allows an opaque type alias to be treated
as if it had the type specified by *type-constraint-type*, which removes some
of the alias's opaqueness. Note: Although the presence of a constraint allows
the alias type to be converted implicitly to that constraint type, there is no
conversion in the opposite direction.

Note: A shape type can only be used via an alias to it ([§§](05-types.md#shape-types)).

**Examples**

```Hack
type Counter = int;
newtype NameList = array<string>;
// -----------------------------------------
class Fullname {
  private string $firstName = '';
  private string $lastName = '';
}
type Name = Fullname;
class C1 {
  private ?Name $pr = null;
  public static function fa(Name $p1, array<Name> $p2): void {}
}
// -----------------------------------------
type Complex = shape('real' => float, 'imag' => float);
type PropList = (int, string, int);
newtype Matrix<T> = Vector<Vector<T>>;
type Serialized<T> = string;    // T is not used
```

###Supertypes and Subtypes

The set of built-in and user-defined types in Hack can be represented as a 
directed graph in which each vertex designates a distinct type. Each directed 
edge connects one vertex with another, with the starting vertex of an edge 
being a *supertype* of the *subtype* designated by the ending vertex of that edge. 

A supertype can have one or more subtypes, and a subtype can have one or more 
supertypes. A supertype can be a subtype of some other supertype, and a 
subtype can be a supertype of some other subtype. If T1 is a supertype of T2, 
and T2 is, in turn, a supertype of T3, then T1 is a supertype of T3, and T3 is 
a subtype of T1.

The relationship between a supertype and any of its subtypes involves the 
notion of substitutability. Specifically, if T2 is a subtype of T1, program 
elements designed to operate on T1 can also operate on T2.

For types in Hack, the following rules apply:

1.  The source vertex of the graph is the type `mixed`; as such, every type is a subtype of that type.
2.  Any type is a subtype of itself.
3.  `int` and `float` are subtypes of `num`.
4.  `int` and `string` are subtypes of `arraykey`.
5.  For each type T, T is a subtype of the nullable type ?T.
6.  For each type T, the null type is a subtype of all nullable types ?T.
7.  string is a subtype of `Stringish`.
8.  The predefined types `Vector`, `ImmVector`, `Map`, `ImmMap`, `Set`, `ImmSet`, and `Pair` and all array types are subtypes of `Container`, `KeyedTraversable`, and `Traversable`.
9.  The predefined types `Vector`, `ImmVector`, `Map`, `ImmMap`, and `Pair` and all array types are subtypes of `KeyedContainer`.
10. If A is an alias for a type T created using type, then A is a subtype of T, and T is a subtype of A. 
11. If A is an alias for a type T created using `newtype`, inside the file containing the `newtype` definition, A is a subtype of T, and T is a subtype of A. Outside that file, A and T have no relationship, except that given `newtype` A as C = T, outside the file with the `newtype` definition, A is a subtype of C.
12. Any class, interface, or trait having a public instance method `__toString` taking no arguments and returning string, is a subtype of `Stringish`.
13. A class type is a subtype of all its direct and indirect base-class types, including those resulting from *require-extends-clauses* ([§§](17-interfaces.md#interface-members)).
14. A class type is a subtype of all the interfaces it and its direct and indirect base-class types implement, including those resulting from *require-implements-clauses* ([§§](18-traits.md#trait-members)).
15. An interface type is a subtype of all its direct and indirect base interfaces.

###Type Side Effects

As stated in [§§](05-types.md#supertypes-and-subtypes), a supertype has one or more subtypes, and while any
operation permitted on a value of some supertype is also permitted on a value 
of any of its subtypes, the reverse is not true. For example, the type `num` 
is a supertype of `int` and `float`, and while addition and subtraction are 
well defined for all three types, bit shifting requires integer operands. As 
such, a `num` cannot be bit-shifted directly. (Similar situations occur with
`arraykey` and its subtypes `int` and `string`, with nullable types and their subtypes, and with `mixed` and its subtypes.)

Certain program elements are capable of changing the type of an expression
using what is called a *type side effect* (which is not to be confused with a
*value side effect*) (10.1)).

Consider the following function:

```Hack
function F_n_int(?int $p1): void {
  $x = $p1 % 3;         // rejected; % not defined for ?int
  if (is_int($p1)) {    // type side effect occurs; $p1 has type int
    $x = $p1 % 3;       // accepted; % defined for int
  }
```

On entry, `$p1` contains `null` or some `int`. However, the type of the 
expression `$p1` is not known to be `int`, so it is not safe to allow the `%`\
operator to be applied. When the library function `is_int` is applied to `$p1`
, a type side effect occurs in which the type of the expression `$p1` is changed to `int` **for the true path of the `if` statement only**. As such, 
the `%` operator can be applied. However, once execution flows out of the `if`
statement, the type of the expression `$p1` is `?int`.

Consider the following code:

```Hack
  if (is_null($p1)) {   // type side effect occurs; $p1 has type null
    $x = $p1 % 3;         // rejected; % not defined for null
  } else {              // type side effect occurs; $p1 has type int
    $x = $p1 % 3;         // accepted; % defined for int
  }
```

The first assignment is rejected, not because we don’t know `$p1`'s type, but
because we know its type is not `int`. See how an opposite type side effect
occurs with the `else`.

Similarly, we can write the following:

```Hack
  if (!is_null($p1)) {// type side effect occurs; $p1 has type int
    $x = $p1 % 3;   // accepted; % defined for int
  }

  if ($p1 !== null) {   // type side effect occurs; $p1 has type int
    $x = $p1 % 3;   // accepted; % defined for int
  }
}
```

Consider the following example that contains non-trivial selection criteria:

```Hack
function F_n_num(?num $p1): void {
  if (is_int($p1) || is_float($p1)) {
    $x = $p1**2;    // rejected
  }
  …
}
```

An implementation is **not** required to produce the correct type side effect when 
using multiple criteria directly.

The following example shows type side effects in the context of a nullable 
class type that involves inheritance:

```Hack
function F_Button(Button $p1): void {}
function F_CustomButton(CustomButton $p1): void {}
function F_n_class_hier(?Button $p1): void {
  if (!is_null($p1)) {      // type side effect occurs; $p1 has type Button
    F_Button($p1);          // call permitted; argument has type Button
    F_CustomButton($p1);    // call rejected; not necesarily a CustomButton
    if ($p1 instanceof CustomButton) {  // type side effect occurs
      F_CustomButton($p1);  // call permitted; argument has type CustomButton
    }
  }
}
```

The following constructs involve type side effects:

* When used as the controlling expression in an `if`, `while`, or `for`statement, the operators `==`, `!=`, `===`, and `!==` ([§§](10-expressions.md#equality-operators)) when used with one operand of `null`, `instanceof` ([§§](10-expressions.md#instanceof-operator)), and simple assignment `=` ([§§](10-expressions.md#simple-assignment)). [Note that if `$x` is an expression of some nullable type, the logical test `if ($x)` is equivalent to `if ($x !== null)`.] 
* The operators `&&`, `||`, and `?:`.
* The intrinsic `invariant` ([§§](10-expressions.md#invariant)).
* The library functions `is_array`, `is_bool`, `is_float`, `is_int`, `is_null`, `is_resource`, and `is_string`.

Thus far, all the examples use the value of an expression that designates a
parameter (which is a local variable). Consider the following case, which
involves a property instead:

```Hack
class C {
  private ?int $p1 = 8;     // holds an int, but type is ?int
  public function m(): void {
    if (is_int($this->p1)) {    // type side effect occurs; $this->p1 is int
      $x = $this->p1 << 2;      // allowed; type is int 
      $this->n();           // could involve a type side effect on $p1 
      $x = $this->p1 << 2;      // disallowed; might no longer be int 
    }
  }
  public function n(): void { … }
}
```

Inside the true path of the `if` statement, even though we know that 
`$this->p1` is an `int` to begin with, once any method in this class is
called, the implementation must assume that method could have caused a type side
effect on anything currently in scope. As a result, the second attempt to left
shift is rejected.

###Type Inferencing

While certain kinds of variables must have their type declared explicitly, others can have their type inferred by having the implementation perform static analysis of the context in which those variables are used. Specifically,
* Types **must be declared** for properties ([§§](16-classes.md#properties)) and for the parameters and the return type of a named function ([§§](15-functions.md#function-definitions)).
* Types **must be inferred** for local variables ([§§](07-variables.md#local-variables)), which includes function statics ([§§](07-variables.md#function-statics)) and parameters.
* Types **can be declared or inferred** for constants ([§§](16-classes.md#constants)) and for the parameters and return type of an unnamed function ([§§](15-functions.md#anonymous-functions)).

The process of type inferencing does not cross function boundaries.

Here's an example involving a local variable: 

```Hack
function f(): void {
  $v = 'acb';       // $v has type string
  …
  $v = true;        // $v has type bool
  …
  $v = array('red' => 10; 'green' => 15); // $v has type map-like array of int
  …
  $v = new C();     // $v has type C
}
```

For each assignment, the type of `$v` is inferred from the type of the
expression on the right-hand side, as shown in the comments. The type of
function statics is inferred in the same manner, as are function parameters. 

For example:

```Hack
function g(int $p1 = -1): void
{
  // on entry to the function, $p1 has the declared type int
  …
  $p1 = 23.56;      // $p1 has type float
  …
}
```

As a parameter, `$p1` is required to have a declared type, in this case, 
`int`. However, when used as an expression, `$p1`'s type can change, as shown.

In the case of a class constant, if the type is omitted, it is inferred from
the initializer:

```Hack
class C {
  const C1 = 10;            // type int inferred from initializer
  const string C2 = "red";  // type string declared
}
```

Let's consider types in anonymous functions:

```Hack
$doubler = (function ($p) { return $p * 2; });
$doubler(3);
$doubler(4.2);
```

The type of the parameter `$p` and the function's return type have been 
omitted. These types are inferred each time the anonymous function is called 
through the variable `$doubler`. When `3` is passed, as that has type `int`, 
that is inferred as the type of `$p`. The literal `2` also has type `int`, so 
the type of the value returned is the type of `$p * 2`, which is `int`, and 
that becomes the function's return type. When `4.2` is passed, as that has 
type `float`, that is inferred as the type of `$p`. The literal `2` has type 
`int`, so the type of the value returned is the type of `$p * 2`, which is
`float`, and that becomes the function's return type.

Consider the following, subtly different, version (note the literal 2.0 
instead of 2):

`$doubler = (function ($p) { return $p * 2.0; });`

Whether an `int` or `float` value is passed, it matters not, as when either is multiplied by a `float`, the result is `float`, so that becomes the function's return type.

We can add partial explicit type information; the following all result in the same behavior:

```Hack
$doubler = (function (int $p) { return $p * 2; });
$doubler = (function ($p = 0) { return $p * 2; });
$doubler = (function ($p): int { return $p * 2; });
```

In the first case, as `$p` has the declared type `int`, and `int * int` gives 
`int`, the return type is inferred as `int`. In the second case, as the 
default value `0` has type `int`, `$p` is inferred to also have that type, and 
`int * int` gives `int`, so the return type is inferred as `int`. In the third 
case, as the return type is declared as `int`, and `$p * 2` must have that 
type, the type of `$p` is inferred as `int`, so that must also be the type of 
the parameter.

While all three of these cases allow a call such as `$doubler(3)`, none of 
them allows a call such as `$doubler(4.2)`. So, the fact that type information 
can be provided explicitly in these cases doesn’t mean it's necessarily a good idea to do so.

Other considerations apply to type inferencing in the context of generic types
([§§](14-generic-types-methods-and-functions.md#type-inferencing-revisited)).





