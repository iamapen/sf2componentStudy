<?php
/**
 * symfony/stopwatchのサンプル
 */
namespace com\studiopoppy\stopWatchStudy;
use Symfony\Component\Stopwatch\Stopwatch;

$loader = require __DIR__.'/../vendor/autoload.php';
//$loader->addPsr4('com\studiopoppy\stopWatchStudy\\', __DIR__.'/lib');

// セクションを使うと、タイムラインを論理的にグループ分けできる
// 複数のタイムラインが並行する場合には使うと理解しやすくなる
$stopwatch = new Stopwatch();
$stopwatch->openSection();
$stopwatch->start('parsing_config_file', 'filesystem_operations');
$stopwatch->stopSection('routing');
$events = $stopwatch->getSectionEvents('routing');

// 後からセクションを再度開くことができる
$stopwatch->openSection('routing');
$stopwatch->start('building_config_tree');
$stopwatch->stopSection('routing');

foreach($events as $sectionName=>$ev) {
    $periods = $ev->getPeriods();
    echo $sectionName, "\n";
    echo sprintf("  startTime: %s\n", $ev->getStartTime());
    foreach($periods as $i=>$p) {
        echo sprintf("  %s: %s\n", $i+1, $p->getEndTime());
    }
    echo sprintf("  endTime: %s\n", $ev->getEndTime());
}
