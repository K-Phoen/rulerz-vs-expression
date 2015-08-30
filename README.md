rulerz-vs-expression
====================

Set of benchmarks used to compare the speed of
[K-Phoen/rulerz](https://github.com/K-Phoen/rulerz) and
[webmozart/expression](https://github.com/webmozart/expression).

## Usage

Install the dependencies using composer:

```bash
composer.phar install
```

And execute one of the file in the `src` directory:

```bash
php ./src/more_complex_rule.php
```

**N.B.**: these benchmarks are NOT meant to be thorough. I just wanted to have
an idea of how bad rulerz would perform compared to webmozart/expression
(spoiler alert: the speed of both libraries are quite similar).
