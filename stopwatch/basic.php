<?php
/**
 * symfony/stopwatchのサンプル
 */
namespace com\studiopoppy\stopWatchStudy;
use Symfony\Component\Stopwatch\Stopwatch;

$loader = require __DIR__.'/../vendor/autoload.php';
//$loader->addPsr4('com\studiopoppy\stopWatchStudy\\', __DIR__.'/lib');

$stopwatch = new Stopwatch();

$stopwatch->start('event1', 'categoryName');
usleep(10000);
$stopwatch->lap('event1');  // 適当な単位でピリオドを打つ
usleep(15000);
$stopwatch->lap('event1');  // 適当な単位でピリオドを打つ
usleep(2500);
$ev = $stopwatch->stop('event1');

echo sprintf("category: %s\n", $ev->getCategory());
echo sprintf("origin: %s\n", $ev->getOrigin());         // 開始時刻のμ秒
echo sprintf("startTime: %s\n", $ev->getStartTime());   // 最初のピリオドの開始時刻(常に0)
echo sprintf("endTime: %s\n", $ev->getEndTime());       // 最後のピリオドの終了時刻(ms)
echo sprintf("duration: %s\n", $ev->getDuration());     // 全ピリオドの所要時間(ms)
echo sprintf("memory: %s\n", $ev->getMemory());         // 全ピリオドのメモリ使用量(byte)

// 打ったピリオドはこのように取得できる
// 件数は打ったピリオドの数+1になる。
// -----.---------.----
// S   E S       E S  E
$periods = $ev->getPeriods();
echo sprintf("startTime: %s\n", $periods[0]->getStartTime());   // 開始
echo sprintf("lap1: %sms\n", $periods[1]->getStartTime());
echo sprintf("lap2: %sms\n", $periods[2]->getStartTime());
echo sprintf("endTime: %sms\n", $periods[2]->getEndTime());     // 終了

// まだ終わっていないイベントをすべて止める場合に
$ev->ensureStopped();
