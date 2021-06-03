# GraPHPinator Extra types [![PHP](https://github.com/infinityloop-dev/graphpinator-extra-types/workflows/PHP/badge.svg?branch=master)](https://github.com/infinityloop-dev/graphpinator-extra-types/actions?query=workflow%3APHP) [![codecov](https://codecov.io/gh/infinityloop-dev/graphpinator-extra-types/branch/master/graph/badge.svg)](https://codecov.io/gh/infinityloop-dev/graphpinator-extra-types)

:zap::globe_with_meridians::zap: Some useful and commonly used types, both scalar or composite.

## Introduction

This package includes some commonly used types. Those types are not covered by the specs and therefore are not part of the main Graphpinator package.

## Installation

Install package using composer

```composer require infinityloop-dev/graphpinator-extra-types```

## How to use

In order to enable the types on your server, the only thing you need to do is to put selected types to your `Container`. You may use all or only some.

> Some of the types have special requirement on `infinityloop-dev/graphpinator-constraint-directives`, which needs be enabled first if you with to use according type.

This package contains following types:

- `\Graphpinator\ExtraTypes\AnyType`
    - Any scalar value is accepted = string | int | float | bool.
- `\Graphpinator\ExtraTypes\BigIntType`
    - GraphqQL `Int` is required to be 32bit, `BigInt` type bypasses that restriction and allows for 64bits integers.
