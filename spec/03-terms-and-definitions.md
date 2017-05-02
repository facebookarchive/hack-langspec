# Terms and Definitions
For the purposes of this document, the following terms and definitions
apply:

<dl>
    <dt>argument</dt>
    <dd>a value passed to a function, that is intended to map to a corresponding parameter.</dd>

    <dt>behavior</dt>
    <dd>external appearance or action.</dd>

    <dt>behavior, implementation-defined</dt>
    <dd>behavior specific to an implementation, where that implementation must document that behavior.</dd>

    <dt>behavior, undefined</dt>
    <dd>behavior which is not guaranteed to produce any specific result. Usually follows an erroneous program construct or data.</dd>

    <dt>behavior, unspecified</dt>
    <dd>behavior for which this specification provides no requirements.</dd>

    <dt>case-preserved</dt>
    <dd>a construct which is case-insensitive upon declaration, but case-sensitive upon subsequent usage.</dd>

    <dt>constraint</dt>
    <dd>restriction, either syntactic or semantic, on how language elements can be used.</dd>

    <dt>error, fatal</dt>
    <dd>a translation or runtime condition from which the translator or engine cannot recover.</dd>

    <dt>error, fatal, catchable</dt>
    <dd>a fatal error that can be caught by a user-defined handler.</dd>

    <dt>error, non-fatal</dt>
    <dd>an error that is not fatal.</dd>

    <dt>lvalue</dt>
    <dd>an expression that designates a memory location having a type.</dd>

    <dt>lvalue, modifiable</dt>
    <dd>an lvalue whose value can be changed.</dd>

    <dt>lvalue, non-modifiable</dt>
    <dd>an lvalue whose value cannot be changed.</dd>

    <dt>parameter</dt>
    <dd>a variable declared in the parameter list of a function that is intended to map to a corresponding argument in a call to that function.</dd>

    <dt>Hack Run-Time Engine</dt>
    <dd>the machinery that executes a Hack program. Referred to as *the Engine* throughout this specification.</dd>

    <dt>value</dt>
    <dd>precise meaning of the contents of a memory location when interpreted as having a specific type.</dd>
</dl>

Other terms are defined throughout this specification, as needed, with
the first usage being typeset *like this*.


