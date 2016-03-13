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
use Uphpu\Propel2Quickstart\SupplierProductJob as ChildSupplierProductJob;
use Uphpu\Propel2Quickstart\SupplierProductJobQuery as ChildSupplierProductJobQuery;
use Uphpu\Propel2Quickstart\Map\SupplierProductJobTableMap;

/**
 * Base class that represents a query for the 'supplier_product_job' table.
 *
 *
 *
 * @method     ChildSupplierProductJobQuery orderBySnum($order = Criteria::ASC) Order by the snum column
 * @method     ChildSupplierProductJobQuery orderByPnum($order = Criteria::ASC) Order by the pnum column
 * @method     ChildSupplierProductJobQuery orderByJnum($order = Criteria::ASC) Order by the jnum column
 * @method     ChildSupplierProductJobQuery orderByQty($order = Criteria::ASC) Order by the qty column
 *
 * @method     ChildSupplierProductJobQuery groupBySnum() Group by the snum column
 * @method     ChildSupplierProductJobQuery groupByPnum() Group by the pnum column
 * @method     ChildSupplierProductJobQuery groupByJnum() Group by the jnum column
 * @method     ChildSupplierProductJobQuery groupByQty() Group by the qty column
 *
 * @method     ChildSupplierProductJobQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSupplierProductJobQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSupplierProductJobQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSupplierProductJobQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSupplierProductJobQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSupplierProductJobQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSupplierProductJobQuery leftJoinJob($relationAlias = null) Adds a LEFT JOIN clause to the query using the Job relation
 * @method     ChildSupplierProductJobQuery rightJoinJob($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Job relation
 * @method     ChildSupplierProductJobQuery innerJoinJob($relationAlias = null) Adds a INNER JOIN clause to the query using the Job relation
 *
 * @method     ChildSupplierProductJobQuery joinWithJob($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Job relation
 *
 * @method     ChildSupplierProductJobQuery leftJoinWithJob() Adds a LEFT JOIN clause and with to the query using the Job relation
 * @method     ChildSupplierProductJobQuery rightJoinWithJob() Adds a RIGHT JOIN clause and with to the query using the Job relation
 * @method     ChildSupplierProductJobQuery innerJoinWithJob() Adds a INNER JOIN clause and with to the query using the Job relation
 *
 * @method     ChildSupplierProductJobQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildSupplierProductJobQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildSupplierProductJobQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildSupplierProductJobQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildSupplierProductJobQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildSupplierProductJobQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildSupplierProductJobQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildSupplierProductJobQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method     ChildSupplierProductJobQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method     ChildSupplierProductJobQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method     ChildSupplierProductJobQuery joinWithSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Supplier relation
 *
 * @method     ChildSupplierProductJobQuery leftJoinWithSupplier() Adds a LEFT JOIN clause and with to the query using the Supplier relation
 * @method     ChildSupplierProductJobQuery rightJoinWithSupplier() Adds a RIGHT JOIN clause and with to the query using the Supplier relation
 * @method     ChildSupplierProductJobQuery innerJoinWithSupplier() Adds a INNER JOIN clause and with to the query using the Supplier relation
 *
 * @method     \Uphpu\Propel2Quickstart\JobQuery|\Uphpu\Propel2Quickstart\ProductQuery|\Uphpu\Propel2Quickstart\SupplierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSupplierProductJob findOne(ConnectionInterface $con = null) Return the first ChildSupplierProductJob matching the query
 * @method     ChildSupplierProductJob findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSupplierProductJob matching the query, or a new ChildSupplierProductJob object populated from the query conditions when no match is found
 *
 * @method     ChildSupplierProductJob findOneBySnum(string $snum) Return the first ChildSupplierProductJob filtered by the snum column
 * @method     ChildSupplierProductJob findOneByPnum(string $pnum) Return the first ChildSupplierProductJob filtered by the pnum column
 * @method     ChildSupplierProductJob findOneByJnum(string $jnum) Return the first ChildSupplierProductJob filtered by the jnum column
 * @method     ChildSupplierProductJob findOneByQty(int $qty) Return the first ChildSupplierProductJob filtered by the qty column *

 * @method     ChildSupplierProductJob requirePk($key, ConnectionInterface $con = null) Return the ChildSupplierProductJob by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProductJob requireOne(ConnectionInterface $con = null) Return the first ChildSupplierProductJob matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplierProductJob requireOneBySnum(string $snum) Return the first ChildSupplierProductJob filtered by the snum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProductJob requireOneByPnum(string $pnum) Return the first ChildSupplierProductJob filtered by the pnum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProductJob requireOneByJnum(string $jnum) Return the first ChildSupplierProductJob filtered by the jnum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProductJob requireOneByQty(int $qty) Return the first ChildSupplierProductJob filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplierProductJob[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSupplierProductJob objects based on current ModelCriteria
 * @method     ChildSupplierProductJob[]|ObjectCollection findBySnum(string $snum) Return ChildSupplierProductJob objects filtered by the snum column
 * @method     ChildSupplierProductJob[]|ObjectCollection findByPnum(string $pnum) Return ChildSupplierProductJob objects filtered by the pnum column
 * @method     ChildSupplierProductJob[]|ObjectCollection findByJnum(string $jnum) Return ChildSupplierProductJob objects filtered by the jnum column
 * @method     ChildSupplierProductJob[]|ObjectCollection findByQty(int $qty) Return ChildSupplierProductJob objects filtered by the qty column
 * @method     ChildSupplierProductJob[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SupplierProductJobQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Uphpu\Propel2Quickstart\Base\SupplierProductJobQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Uphpu\\Propel2Quickstart\\SupplierProductJob', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSupplierProductJobQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSupplierProductJobQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSupplierProductJobQuery) {
            return $criteria;
        }
        $query = new ChildSupplierProductJobQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$snum, $pnum, $jnum] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSupplierProductJob|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SupplierProductJobTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupplierProductJobTableMap::DATABASE_NAME);
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
     * @return ChildSupplierProductJob A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT snum, pnum, jnum, qty FROM supplier_product_job WHERE snum = :p0 AND pnum = :p1 AND jnum = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSupplierProductJob $obj */
            $obj = new ChildSupplierProductJob();
            $obj->hydrate($row);
            SupplierProductJobTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildSupplierProductJob|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SupplierProductJobTableMap::COL_SNUM, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SupplierProductJobTableMap::COL_PNUM, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(SupplierProductJobTableMap::COL_JNUM, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SupplierProductJobTableMap::COL_SNUM, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SupplierProductJobTableMap::COL_PNUM, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(SupplierProductJobTableMap::COL_JNUM, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupplierProductJobTableMap::COL_SNUM, $snum, $comparison);
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
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupplierProductJobTableMap::COL_PNUM, $pnum, $comparison);
    }

    /**
     * Filter the query on the jnum column
     *
     * Example usage:
     * <code>
     * $query->filterByJnum('fooValue');   // WHERE jnum = 'fooValue'
     * $query->filterByJnum('%fooValue%'); // WHERE jnum LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jnum The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByJnum($jnum = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jnum)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $jnum)) {
                $jnum = str_replace('*', '%', $jnum);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierProductJobTableMap::COL_JNUM, $jnum, $comparison);
    }

    /**
     * Filter the query on the qty column
     *
     * Example usage:
     * <code>
     * $query->filterByQty(1234); // WHERE qty = 1234
     * $query->filterByQty(array(12, 34)); // WHERE qty IN (12, 34)
     * $query->filterByQty(array('min' => 12)); // WHERE qty > 12
     * </code>
     *
     * @param     mixed $qty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(SupplierProductJobTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(SupplierProductJobTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierProductJobTableMap::COL_QTY, $qty, $comparison);
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\Job object
     *
     * @param \Uphpu\Propel2Quickstart\Job|ObjectCollection $job The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByJob($job, $comparison = null)
    {
        if ($job instanceof \Uphpu\Propel2Quickstart\Job) {
            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_JNUM, $job->getJnum(), $comparison);
        } elseif ($job instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_JNUM, $job->toKeyValue('PrimaryKey', 'Jnum'), $comparison);
        } else {
            throw new PropelException('filterByJob() only accepts arguments of type \Uphpu\Propel2Quickstart\Job or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Job relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function joinJob($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Job');

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
            $this->addJoinObject($join, 'Job');
        }

        return $this;
    }

    /**
     * Use the Job relation Job object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Uphpu\Propel2Quickstart\JobQuery A secondary query class using the current class as primary query
     */
    public function useJobQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJob($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Job', '\Uphpu\Propel2Quickstart\JobQuery');
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\Product object
     *
     * @param \Uphpu\Propel2Quickstart\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Uphpu\Propel2Quickstart\Product) {
            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_PNUM, $product->getPnum(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_PNUM, $product->toKeyValue('PrimaryKey', 'Pnum'), $comparison);
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \Uphpu\Propel2Quickstart\Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function joinProduct($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Uphpu\Propel2Quickstart\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\Uphpu\Propel2Quickstart\ProductQuery');
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\Supplier object
     *
     * @param \Uphpu\Propel2Quickstart\Supplier|ObjectCollection $supplier The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function filterBySupplier($supplier, $comparison = null)
    {
        if ($supplier instanceof \Uphpu\Propel2Quickstart\Supplier) {
            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_SNUM, $supplier->getSnum(), $comparison);
        } elseif ($supplier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierProductJobTableMap::COL_SNUM, $supplier->toKeyValue('PrimaryKey', 'Snum'), $comparison);
        } else {
            throw new PropelException('filterBySupplier() only accepts arguments of type \Uphpu\Propel2Quickstart\Supplier or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Supplier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function joinSupplier($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Supplier');

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
            $this->addJoinObject($join, 'Supplier');
        }

        return $this;
    }

    /**
     * Use the Supplier relation Supplier object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Uphpu\Propel2Quickstart\SupplierQuery A secondary query class using the current class as primary query
     */
    public function useSupplierQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Supplier', '\Uphpu\Propel2Quickstart\SupplierQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSupplierProductJob $supplierProductJob Object to remove from the list of results
     *
     * @return $this|ChildSupplierProductJobQuery The current query, for fluid interface
     */
    public function prune($supplierProductJob = null)
    {
        if ($supplierProductJob) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SupplierProductJobTableMap::COL_SNUM), $supplierProductJob->getSnum(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SupplierProductJobTableMap::COL_PNUM), $supplierProductJob->getPnum(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(SupplierProductJobTableMap::COL_JNUM), $supplierProductJob->getJnum(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the supplier_product_job table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductJobTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SupplierProductJobTableMap::clearInstancePool();
            SupplierProductJobTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductJobTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SupplierProductJobTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SupplierProductJobTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SupplierProductJobTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SupplierProductJobQuery
