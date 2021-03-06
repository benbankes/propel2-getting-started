<?php

namespace Uphpu\Propel2Quickstart\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Uphpu\Propel2Quickstart\SupplierProductJob;
use Uphpu\Propel2Quickstart\SupplierProductJobQuery;


/**
 * This class defines the structure of the 'supplier_product_job' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SupplierProductJobTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Uphpu.Propel2Quickstart.Map.SupplierProductJobTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'supplier_product_job';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Uphpu\\Propel2Quickstart\\SupplierProductJob';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Uphpu.Propel2Quickstart.SupplierProductJob';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the snum field
     */
    const COL_SNUM = 'supplier_product_job.snum';

    /**
     * the column name for the pnum field
     */
    const COL_PNUM = 'supplier_product_job.pnum';

    /**
     * the column name for the jnum field
     */
    const COL_JNUM = 'supplier_product_job.jnum';

    /**
     * the column name for the qty field
     */
    const COL_QTY = 'supplier_product_job.qty';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Snum', 'Pnum', 'Jnum', 'Qty', ),
        self::TYPE_CAMELNAME     => array('snum', 'pnum', 'jnum', 'qty', ),
        self::TYPE_COLNAME       => array(SupplierProductJobTableMap::COL_SNUM, SupplierProductJobTableMap::COL_PNUM, SupplierProductJobTableMap::COL_JNUM, SupplierProductJobTableMap::COL_QTY, ),
        self::TYPE_FIELDNAME     => array('snum', 'pnum', 'jnum', 'qty', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Snum' => 0, 'Pnum' => 1, 'Jnum' => 2, 'Qty' => 3, ),
        self::TYPE_CAMELNAME     => array('snum' => 0, 'pnum' => 1, 'jnum' => 2, 'qty' => 3, ),
        self::TYPE_COLNAME       => array(SupplierProductJobTableMap::COL_SNUM => 0, SupplierProductJobTableMap::COL_PNUM => 1, SupplierProductJobTableMap::COL_JNUM => 2, SupplierProductJobTableMap::COL_QTY => 3, ),
        self::TYPE_FIELDNAME     => array('snum' => 0, 'pnum' => 1, 'jnum' => 2, 'qty' => 3, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('supplier_product_job');
        $this->setPhpName('SupplierProductJob');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Uphpu\\Propel2Quickstart\\SupplierProductJob');
        $this->setPackage('Uphpu.Propel2Quickstart');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('snum', 'Snum', 'CHAR' , 'supplier', 'snum', true, 5, null);
        $this->addForeignPrimaryKey('pnum', 'Pnum', 'CHAR' , 'product', 'pnum', true, 6, null);
        $this->addForeignPrimaryKey('jnum', 'Jnum', 'CHAR' , 'job', 'jnum', true, 5, null);
        $this->addColumn('qty', 'Qty', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Job', '\\Uphpu\\Propel2Quickstart\\Job', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':jnum',
    1 => ':jnum',
  ),
), null, null, null, false);
        $this->addRelation('Product', '\\Uphpu\\Propel2Quickstart\\Product', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':pnum',
    1 => ':pnum',
  ),
), null, null, null, false);
        $this->addRelation('Supplier', '\\Uphpu\\Propel2Quickstart\\Supplier', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':snum',
    1 => ':snum',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Uphpu\Propel2Quickstart\SupplierProductJob $obj A \Uphpu\Propel2Quickstart\SupplierProductJob object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getSnum() || is_scalar($obj->getSnum()) || is_callable([$obj->getSnum(), '__toString']) ? (string) $obj->getSnum() : $obj->getSnum()), (null === $obj->getPnum() || is_scalar($obj->getPnum()) || is_callable([$obj->getPnum(), '__toString']) ? (string) $obj->getPnum() : $obj->getPnum()), (null === $obj->getJnum() || is_scalar($obj->getJnum()) || is_callable([$obj->getJnum(), '__toString']) ? (string) $obj->getJnum() : $obj->getJnum())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Uphpu\Propel2Quickstart\SupplierProductJob object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Uphpu\Propel2Quickstart\SupplierProductJob) {
                $key = serialize([(null === $value->getSnum() || is_scalar($value->getSnum()) || is_callable([$value->getSnum(), '__toString']) ? (string) $value->getSnum() : $value->getSnum()), (null === $value->getPnum() || is_scalar($value->getPnum()) || is_callable([$value->getPnum(), '__toString']) ? (string) $value->getPnum() : $value->getPnum()), (null === $value->getJnum() || is_scalar($value->getJnum()) || is_callable([$value->getJnum(), '__toString']) ? (string) $value->getJnum() : $value->getJnum())]);

            } elseif (is_array($value) && count($value) === 3) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Uphpu\Propel2Quickstart\SupplierProductJob object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('Pnum', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('Jnum', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? SupplierProductJobTableMap::CLASS_DEFAULT : SupplierProductJobTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (SupplierProductJob object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SupplierProductJobTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SupplierProductJobTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SupplierProductJobTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SupplierProductJobTableMap::OM_CLASS;
            /** @var SupplierProductJob $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SupplierProductJobTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SupplierProductJobTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SupplierProductJobTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SupplierProductJob $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SupplierProductJobTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SupplierProductJobTableMap::COL_SNUM);
            $criteria->addSelectColumn(SupplierProductJobTableMap::COL_PNUM);
            $criteria->addSelectColumn(SupplierProductJobTableMap::COL_JNUM);
            $criteria->addSelectColumn(SupplierProductJobTableMap::COL_QTY);
        } else {
            $criteria->addSelectColumn($alias . '.snum');
            $criteria->addSelectColumn($alias . '.pnum');
            $criteria->addSelectColumn($alias . '.jnum');
            $criteria->addSelectColumn($alias . '.qty');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(SupplierProductJobTableMap::DATABASE_NAME)->getTable(SupplierProductJobTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SupplierProductJobTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SupplierProductJobTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SupplierProductJobTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a SupplierProductJob or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or SupplierProductJob object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductJobTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Uphpu\Propel2Quickstart\SupplierProductJob) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SupplierProductJobTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SupplierProductJobTableMap::COL_SNUM, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SupplierProductJobTableMap::COL_PNUM, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(SupplierProductJobTableMap::COL_JNUM, $value[2]));
                $criteria->addOr($criterion);
            }
        }

        $query = SupplierProductJobQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SupplierProductJobTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SupplierProductJobTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the supplier_product_job table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SupplierProductJobQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SupplierProductJob or Criteria object.
     *
     * @param mixed               $criteria Criteria or SupplierProductJob object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductJobTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SupplierProductJob object
        }


        // Set the correct dbName
        $query = SupplierProductJobQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SupplierProductJobTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SupplierProductJobTableMap::buildTableMap();
