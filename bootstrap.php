<?php

require __DIR__ . '/vendor/autoload.php';

// RulerZ compiler
$compiler = new \RulerZ\Compiler\FileCompiler(new \RulerZ\Parser\HoaParser());

// RulerZ engine
$rulerz = new \RulerZ\RulerZ(
    $compiler, [
        new \RulerZ\Compiler\Target\ArrayVisitor(),
    ]
);

return $rulerz;
