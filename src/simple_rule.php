<?php

use Webmozart\Expression\Expr;

$rulerz = require __DIR__ . '/../bootstrap.php';

const REPETITIONS = 10000;

$dataset = [
    ['name' => 'Joe',  'group' => 'guest',  'points' => 50],
    ['name' => 'Moe',  'group' => 'member', 'points' => 25],
    ['name' => 'Al',   'group' => 'guest',  'points' => 30],
    ['name' => 'Jane', 'group' => 'admin',  'points' => 75],
    ['name' => 'Jude', 'group' => 'vip',    'points' => 70],
    ['name' => 'Lucy', 'group' => 'vip',    'points' => 72],
];

$rule = 'group = "guest" and points > 42';

$bench = new Hoa\Bench\Bench();

$bench->rulerz->start();

foreach (range(0, REPETITIONS) as $i) {
    $rulerz->filter($dataset, $rule);
}

$bench->rulerz->stop();


// Expression
$expr = Expr::greaterThan(42, 'points')->andEquals('guest', 'group');

$bench->expression->start();
foreach (range(0, REPETITIONS) as $i) {
    $results = [];
    foreach ($dataset as $row) {
        if ($expr->evaluate($row)) {
            $results[] = $row;
        }
    }
}
$bench->expression->stop();

echo $bench;
