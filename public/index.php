<?php
require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

use \Uphpu\Propel2Quickstart\SupplierQuery;

print_r(SupplierQuery::create()->find()->toArray());
