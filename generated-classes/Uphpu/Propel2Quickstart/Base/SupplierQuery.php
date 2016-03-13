<?php

namespace Uphpu\Propel2Quickstart\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Uphpu\Propel2Quickstart\Supplier as ChildSupplier;
use Uphpu\Propel2Quickstart\SupplierQuery as ChildSupplierQuery;
use Uphpu\Propel2Quickstart\Map\SupplierTableMap;

/**
 * Base class that represents a query for the 'supplier' table.
 *
 *
 *
 * @method     ChildSupplierQuery orderBySnum($order = Criteria::ASC) Order by the snum column
 * @method     ChildSupplierQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSupplierQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildSupplierQuery orderByCity($order = Criteria::ASC) Order by the city column
 *
 * @method     ChildSupplierQuery groupBySnum() Group by the snum column
 * @method     ChildSupplierQuery groupByName() Group by the name column
 * @method     ChildSupplierQuery groupByStatus() Group by the status column
 * @method     ChildSupplierQuery groupByCity() Group by the city column
 *
 * @method     ChildSupplierQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSupplierQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSupplierQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSupplierQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSupplierQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSupplierQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSupplierQuery leftJoinSupplierProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierProduct relation
 * @method     ChildSupplierQuery rightJoinSupplierProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierProduct relation
 * @method     ChildSupplierQuery innerJoinSupplierProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierProduct relation
 *
 * @method     ChildSupplierQuery joinWithSupplierProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierProduct relation
 *
 * @method     ChildSupplierQuery leftJoinWithSupplierProduct() Adds a LEFT JOIN clause and with to the query using the SupplierProduct relation
 * @method     ChildSupplierQuery rightJoinWithSupplierProduct() Adds a RIGHT JOIN clause and with to the query using the SupplierProduct relation
 * @method     ChildSupplierQuery innerJoinWithSupplierProduct() Adds a INNER JOIN clause and with to the query using the SupplierProduct relation
 *
 * @method     ChildSupplierQuery leftJoinSupplierProductJob($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildSupplierQuery rightJoinSupplierProductJob($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildSupplierQuery innerJoinSupplierProductJob($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierProductJob relation
 *
 * @method     ChildSupplierQuery joinWithSupplierProductJob($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierProductJob relation
 *
 * @method     ChildSupplierQuery leftJoinWithSupplierProductJob() Adds a LEFT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildSupplierQuery rightJoinWithSupplierProductJob() Adds a RIGHT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildSupplierQuery innerJoinWithSupplierProductJob() Adds a INNER JOIN clause and with to the query using the SupplierProductJob relation
 *
 * @method     \Uphpu\Propel2Quickstart\SupplierProductQuery|\Uphpu\Propel2Quickstart\SupplierProductJobQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSupplier findOne(ConnectionInterface $con = null) Return the first ChildSupplier matching the query
 * @method     ChildSupplier findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSupplier matching the query, or a new ChildSupplier object populated from the query conditions when no match is found
 *
 * @method     ChildSupplier findOneBySnum(string $snum) Return the first ChildSupplier filtered by the snum column
 * @method     ChildSupplier findOneByName(string $name) Return the first ChildSupplier filtered by the name column
 * @method     ChildSupplier findOneByStatus(int $status) Return the first ChildSupplier filtered by the status column
 * @method     ChildSupplier findOneByCity(string $city) Return the first ChildSupplier filtered by the city column *

 * @method     ChildSupplier requirePk($key, ConnectionInterface $con = null) Return the ChildSupplier by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplier requireOne(ConnectionInterface $con = null) Return the first ChildSupplier matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplier requireOneBySnum(string $snum) Return the first ChildSupplier filtered by the snum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplier requireOneByName(string $name) Return the first ChildSupplier filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplier requireOneByStatus(int $status) Return the first ChildSupplier filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplier requireOneByCity(string $city) Return the first ChildSupplier filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplier[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSupplier objects based on current ModelCriteria
 * @method     ChildSupplier[]|ObjectCollection findBySnum(string $snum) Return ChildSupplier objects filtered by the snum column
 * @method     ChildSupplier[]|ObjectCollection findByName(string $name) Return ChildSupplier objects filtered by the name column
 * @method     ChildSupplier[]|ObjectCollection findByStatus(int $status) Return ChildSupplier objects filtered by the status column
 * @method     ChildSupplier[]|ObjectCollection findByCity(string $city) Return ChildSupplier objects filtered by the city column
 * @method     ChildSupplier[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SupplierQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Uphpu\Propel2Quickstart\Base\SupplierQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'example_com', $modelName = '\\Uphpu\\Propel2Quickstart\\Supplier', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSupplierQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSupplierQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSupplierQuery) {
            return $criteria;
        }
        $query = new ChildSupplierQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSupplier|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SupplierTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupplierTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupplier A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT snum, name, status, city FROM supplier WHERE snum = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSupplier $obj */
            $obj = new ChildSupplier();
            $obj->hydrate($row);
            SupplierTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSupplier|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SupplierTableMap::COL_SNUM, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SupplierTableMap::COL_SNUM, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the snum column
     *
     * Example usage:
     * <code>
     * $query->filterBySnum('fooValue');   // WHERE snum = 'fooValue'
     * $query->filterBySnum('%fooValue%'); // WHERE snum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $snum The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterBySnum($snum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($snum)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $snum)) {
                $snum = str_replace('*', '%', $snum);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierTableMap::COL_SNUM, $snum, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(SupplierTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(SupplierTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\SupplierProduct object
     *
     * @param \Uphpu\Propel2Quickstart\SupplierProduct|ObjectCollection $supplierProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSupplierQuery The current query, for fluid interface
     */
    public function filterBySupplierProduct($supplierProduct, $comparison = null)
    {
        if ($supplierProduct instanceof \Uphpu\Propel2Quickstart\SupplierProduct) {
            return $this
                ->addUsingAlias(SupplierTableMap::COL_SNUM, $supplierProduct->getSnum(), $comparison);
        } elseif ($supplierProduct instanceof ObjectCollection) {
            return $this
                ->useSupplierProductQuery()
                ->filterByPrimaryKeys($supplierProduct->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySupplierProduct() only accepts arguments of type \Uphpu\Propel2Quickstart\SupplierProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SupplierProduct relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function joinSupplierProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SupplierProduct');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SupplierProduct');
        }

        return $this;
    }

    /**
     * Use the SupplierProduct relation SupplierProduct object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Uphpu\Propel2Quickstart\SupplierProductQuery A secondary query class using the current class as primary query
     */
    public function useSupplierProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupplierProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SupplierProduct', '\Uphpu\Propel2Quickstart\SupplierProductQuery');
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\SupplierProductJob object
     *
     * @param \Uphpu\Propel2Quickstart\SupplierProductJob|ObjectCollection $supplierProductJob the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSupplierQuery The current query, for fluid interface
     */
    public function filterBySupplierProductJob($supplierProductJob, $comparison = null)
    {
        if ($supplierProductJob instanceof \Uphpu\Propel2Quickstart\SupplierProductJob) {
            return $this
                ->addUsingAlias(SupplierTableMap::COL_SNUM, $supplierProductJob->getSnum(), $comparison);
        } elseif ($supplierProductJob instanceof ObjectCollection) {
            return $this
                ->useSupplierProductJobQuery()
                ->filterByPrimaryKeys($supplierProductJob->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterBySupplierProductJob() only accepts arguments of type \Uphpu\Propel2Quickstart\SupplierProductJob or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SupplierProductJob relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function joinSupplierProductJob($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SupplierProductJob');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'SupplierProductJob');
        }

        return $this;
    }

    /**
     * Use the SupplierProductJob relation SupplierProductJob object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Uphpu\Propel2Quickstart\SupplierProductJobQuery A secondary query class using the current class as primary query
     */
    public function useSupplierProductJobQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupplierProductJob($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SupplierProductJob', '\Uphpu\Propel2Quickstart\SupplierProductJobQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSupplier $supplier Object to remove from the list of results
     *
     * @return $this|ChildSupplierQuery The current query, for fluid interface
     */
    public function prune($supplier = null)
    {
        if ($supplier) {
            $this->addUsingAlias(SupplierTableMap::COL_SNUM, $supplier->getSnum(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the supplier table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SupplierTableMap::clearInstancePool();
            SupplierTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SupplierTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SupplierTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SupplierTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SupplierQuery
