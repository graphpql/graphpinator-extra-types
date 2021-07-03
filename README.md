# GraPHPinator Extra types [![PHP](https://github.com/infinityloop-dev/graphpinator-extra-types/workflows/PHP/badge.svg?branch=master)](https://github.com/infinityloop-dev/graphpinator-extra-types/actions?query=workflow%3APHP) [![codecov](https://codecov.io/gh/infinityloop-dev/graphpinator-extra-types/branch/master/graph/badge.svg)](https://codecov.io/gh/infinityloop-dev/graphpinator-extra-types)

:zap::globe_with_meridians::zap: Some useful and commonly used types, both scalar or composite.

## Introduction

This package includes some commonly used types. Those types are not covered by the specs and therefore are not part of the main Graphpinator package.

## Installation

Install package using composer

```composer require infinityloop-dev/graphpinator-extra-types```

## How to use

In order to enable the types on your server, the only thing you need to do is to put selected types to your `Container`. You may use all or only some.

> Some of the types have special requirements on `infinityloop-dev/graphpinator-constraint-directives`, which needs to be enabled first if you wish to use according type.

This package contains the following types:

##### Miscellaneous types

- `\Graphpinator\ExtraTypes\AnyType`
    - Any scalar value is accepted = `string | int | float | bool`.
- `\Graphpinator\ExtraTypes\VoidType`
    - Only `null`.
- `\Graphpinator\ExtraTypes\BigIntType`
    - GraphqQL `Int` is required to be 32bit, `BigInt` type bypasses that restriction and allows for 64bit integers.

##### String value types

- `\Graphpinator\ExtraTypes\DateTimeType`
    - Datetime in ISO 8601 format.
- `\Graphpinator\ExtraTypes\DateType`
    - Date in ISO 8601 format (the date part).
- `\Graphpinator\ExtraTypes\TimeType`
    - Time in ISO 8601 format (the time part).
- `\Graphpinator\ExtraTypes\LocalDateTimeType`
    - Datetime in "YYYY-MM-DD HH:MM:SS" format (without the timezone information).
- `\Graphpinator\ExtraTypes\LocalTimeType`
    - Time in "HH:MM:SS" format (without the timezone information).
- `\Graphpinator\ExtraTypes\JsonType`
    - Valid JSON.
- `\Graphpinator\ExtraTypes\EmailAddressType`
    - Email address.
- `\Graphpinator\ExtraTypes\UrlType`
    - URL adress.
- `\Graphpinator\ExtraTypes\MacType`
    - MAC identifier.
- `\Graphpinator\ExtraTypes\IPv4Type`
    - IPv4 address.
- `\Graphpinator\ExtraTypes\IPv6Type`
    - IPv6 address.
- `\Graphpinator\ExtraTypes\UUIDType`
    - UUID (universally unique identifier).
- `\Graphpinator\ExtraTypes\PostalCodeType`
    - Postal/Zip code.
- `\Graphpinator\ExtraTypes\PhoneNumberType`
    - Phone number.

##### Object & input types

- `\Graphpinator\ExtraTypes\PointType` & `\Graphpinator\ExtraTypes\PointInput`
    - Any pair of x/y values.
- `\Graphpinator\ExtraTypes\GpsType` & `\Graphpinator\ExtraTypes\GpsInput`
    - GPS coordinates.
    - Requires constraint-directives.
- `\Graphpinator\ExtraTypes\HslType` & `\Graphpinator\ExtraTypes\HslInput`
    - HSL color scheme.
    - Requires constraint-directives.
- `\Graphpinator\ExtraTypes\HslaType` & `\Graphpinator\ExtraTypes\HslaInput`
    - HSL color scheme with added alpha.
    - Requires constraint-directives.
- `\Graphpinator\ExtraTypes\RgbType` & `\Graphpinator\ExtraTypes\RgbInput`
    - RGB color scheme.
    - Requires constraint-directives.
- `\Graphpinator\ExtraTypes\RgbaType` & `\Graphpinator\ExtraTypes\RgbaInput`
    - RGB color scheme with added alpha.
    - Requires constraint-directives.

##### Directives

- `\Graphpinator\ExtraTypes\NotNullForArgDirective`
    - Directive on Field definition location. 
    - It guarantees that nullable field wont return null if specified argument value is provided.
