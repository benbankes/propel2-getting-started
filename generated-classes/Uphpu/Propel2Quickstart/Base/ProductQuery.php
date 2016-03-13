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
use Uphpu\Propel2Quickstart\Product as ChildProduct;
use Uphpu\Propel2Quickstart\ProductQuery as ChildProductQuery;
use Uphpu\Propel2Quickstart\Map\ProductTableMap;

/**
 * Base class that represents a query for the 'product' table.
 *
 *
 *
 * @method     ChildProductQuery orderByPnum($order = Criteria::ASC) Order by the pnum column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     ChildProductQuery orderByWeight($order = Criteria::ASC) Order by the weight column
 * @method     ChildProductQuery orderByCity($order = Criteria::ASC) Order by the city column
 *
 * @method     ChildProductQuery groupByPnum() Group by the pnum column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByColor() Group by the color column
 * @method     ChildProductQuery groupByWeight() Group by the weight column
 * @method     ChildProductQuery groupByCity() Group by the city column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinSupplierProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierProduct relation
 * @method     ChildProductQuery rightJoinSupplierProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierProduct relation
 * @method     ChildProductQuery innerJoinSupplierProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierProduct relation
 *
 * @method     ChildProductQuery joinWithSupplierProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierProduct relation
 *
 * @method     ChildProductQuery leftJoinWithSupplierProduct() Adds a LEFT JOIN clause and with to the query using the SupplierProduct relation
 * @method     ChildProductQuery rightJoinWithSupplierProduct() Adds a RIGHT JOIN clause and with to the query using the SupplierProduct relation
 * @method     ChildProductQuery innerJoinWithSupplierProduct() Adds a INNER JOIN clause and with to the query using the SupplierProduct relation
 *
 * @method     ChildProductQuery leftJoinSupplierProductJob($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildProductQuery rightJoinSupplierProductJob($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildProductQuery innerJoinSupplierProductJob($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierProductJob relation
 *
 * @method     ChildProductQuery joinWithSupplierProductJob($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierProductJob relation
 *
 * @method     ChildProductQuery leftJoinWithSupplierProductJob() Adds a LEFT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildProductQuery rightJoinWithSupplierProductJob() Adds a RIGHT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildProductQuery innerJoinWithSupplierProductJob() Adds a INNER JOIN clause and with to the query using the SupplierProductJob relation
 *
 * @method     \Uphpu\Propel2Quickstart\SupplierProductQuery|\Uphpu\Propel2Quickstart\SupplierProductJobQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct findOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when no match is found
 *
 * @method     ChildProduct findOneByPnum(string $pnum) Return the first ChildProduct filtered by the pnum column
 * @method     ChildProduct findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct findOneByColor(string $color) Return the first ChildProduct filtered by the color column
 * @method     ChildProduct findOneByWeight(string $weight) Return the first ChildProduct filtered by the weight column
 * @method     ChildProduct findOneByCity(string $city) Return the first ChildProduct filtered by the city column *

 * @method     ChildProduct requirePk($key, ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneByPnum(string $pnum) Return the first ChildProduct filtered by the pnum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByColor(string $color) Return the first ChildProduct filtered by the color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByWeight(string $weight) Return the first ChildProduct filtered by the weight column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCity(string $city) Return the first ChildProduct filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @method     ChildProduct[]|ObjectCollection findByPnum(string $pnum) Return ChildProduct objects filtered by the pnum column
 * @method     ChildProduct[]|ObjectCollection findByName(string $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|ObjectCollection findByColor(string $color) Return ChildProduct objects filtered by the color column
 * @method     ChildProduct[]|ObjectCollection findByWeight(string $weight) Return ChildProduct objects filtered by the weight column
 * @method     ChildProduct[]|ObjectCollection findByCity(string $city) Return ChildProduct objects filtered by the city column
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Uphpu\Propel2Quickstart\Base\ProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Uphpu\\Propel2Quickstart\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
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
     * @return ChildProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pnum, name, color, weight, city FROM product WHERE pnum = :p0';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PNUM, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductTableMap::COL_PNUM, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pnum column
     *
     * Example usage:
     * <code>
     * $query->filterByPnum('fooValue');   // WHERE pnum = 'fooValue'
     * $query->filterByPnum('%fooValue%'); // WHERE pnum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pnum The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByPnum($pnum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pnum)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pnum)) {
                $pnum = str_replace('*', '%', $pnum);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_PNUM, $pnum, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the color column
     *
     * Example usage:
     * <code>
     * $query->filterByColor('fooValue');   // WHERE color = 'fooValue'
     * $query->filterByColor('%fooValue%'); // WHERE color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $color The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByColor($color = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($color)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $color)) {
                $color = str_replace('*', '%', $color);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_COLOR, $color, $comparison);
    }

    /**
     * Filter the query on the weight column
     *
     * Example usage:
     * <code>
     * $query->filterByWeight(1234); // WHERE weight = 1234
     * $query->filterByWeight(array(12, 34)); // WHERE weight IN (12, 34)
     * $query->filterByWeight(array('min' => 12)); // WHERE weight > 12
     * </code>
     *
     * @param     mixed $weight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function filterByWeight($weight = null, $comparison = null)
    {
        if (is_array($weight)) {
            $useMinMax = false;
            if (isset($weight['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weight['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductTableMap::COL_WEIGHT, $weight, $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProductTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\SupplierProduct object
     *
     * @param \Uphpu\Propel2Quickstart\SupplierProduct|ObjectCollection $supplierProduct the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterBySupplierProduct($supplierProduct, $comparison = null)
    {
        if ($supplierProduct instanceof \Uphpu\Propel2Quickstart\SupplierProduct) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PNUM, $supplierProduct->getPnum(), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * @return ChildProductQuery The current query, for fluid interface
     */
    public function filterBySupplierProductJob($supplierProductJob, $comparison = null)
    {
        if ($supplierProductJob instanceof \Uphpu\Propel2Quickstart\SupplierProductJob) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_PNUM, $supplierProductJob->getPnum(), $comparison);
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
     * @return $this|ChildProductQuery The current query, for fluid interface
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
     * @param   ChildProduct $product Object to remove from the list of results
     *
     * @return $this|ChildProductQuery The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_PNUM, $product->getPnum(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductQuery
