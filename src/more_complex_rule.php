<?php

use Webmozart\Expression\Expr;
use Webmozart\Expression\Logic\Disjunction;

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

$rule = '(group = "guest" and points < 40) or (group = "vip" and points > 70)';

$bench = new Hoa\Bench\Bench();

$bench->rulerz->start();

foreach (range(0, REPETITIONS) as $i) {
    $rulerz->filter($dataset, $rule);
}

$bench->rulerz->stop();


// Expression
$firstPart  = Expr::lessThan(40, 'points')->andEquals('guest', 'group');
$secondPart = Expr::greaterThan(70, 'points')->andEquals('vip', 'group');

$expr = new Disjunction([$firstPart, $secondPart]);

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
