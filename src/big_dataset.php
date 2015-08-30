<?php

use Webmozart\Expression\Expr;

$rulerz = require __DIR__ . '/../bootstrap.php';

const DATASET_SIZE = 100000;

$dataset = [];

foreach (range(0, DATASET_SIZE) as $i) {
    $dataset[] = [
        'name'   => 'not relevant',
        'points' => mt_rand(0, DATASET_SIZE),
    ];
}

$rule = 'points > :points';

$bench = new Hoa\Bench\Bench();

$bench->rulerz->start();

$rulerz->filter($dataset, $rule, [
    'points' => DATASET_SIZE / 2
]);

$bench->rulerz->stop();


// Expression
$expr = Expr::greaterThan(DATASET_SIZE / 2, 'points');

$bench->expression->start();

$results = [];
foreach ($dataset as $row) {
    if ($expr->evaluate($row)) {
        $results[] = $row;
    }
}

$bench->expression->stop();

echo $bench;
