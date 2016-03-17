<?php
require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

use \Uphpu\Propel2Quickstart\JobQuery;
use \Uphpu\Propel2Quickstart\Job;
use \Propel\Runtime\Propel;
Propel::getConnection()->useDebug(true);

$text = print_r(JobQuery::create()->find()->toArray(), true);

Propel::getConnection()->useDebug(true);

$colJobs = JobQuery::create()->find();
$colJobs->populateRelation('SupplierProductJobs');
foreach ($colJobs as $aJob) {
    $aJob->getSupplierProductJobs();
}

echo Propel::getConnection()
    ->getLastExecutedQuery();

?>
<pre><?=$text?></pre>
