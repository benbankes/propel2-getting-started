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
use Uphpu\Propel2Quickstart\SupplierProduct as ChildSupplierProduct;
use Uphpu\Propel2Quickstart\SupplierProductQuery as ChildSupplierProductQuery;
use Uphpu\Propel2Quickstart\Map\SupplierProductTableMap;

/**
 * Base class that represents a query for the 'supplier_product' table.
 *
 *
 *
 * @method     ChildSupplierProductQuery orderBySnum($order = Criteria::ASC) Order by the snum column
 * @method     ChildSupplierProductQuery orderByPnum($order = Criteria::ASC) Order by the pnum column
 * @method     ChildSupplierProductQuery orderByQty($order = Criteria::ASC) Order by the qty column
 *
 * @method     ChildSupplierProductQuery groupBySnum() Group by the snum column
 * @method     ChildSupplierProductQuery groupByPnum() Group by the pnum column
 * @method     ChildSupplierProductQuery groupByQty() Group by the qty column
 *
 * @method     ChildSupplierProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSupplierProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSupplierProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSupplierProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSupplierProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSupplierProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSupplierProductQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildSupplierProductQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildSupplierProductQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildSupplierProductQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildSupplierProductQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildSupplierProductQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildSupplierProductQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     ChildSupplierProductQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method     ChildSupplierProductQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method     ChildSupplierProductQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method     ChildSupplierProductQuery joinWithSupplier($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Supplier relation
 *
 * @method     ChildSupplierProductQuery leftJoinWithSupplier() Adds a LEFT JOIN clause and with to the query using the Supplier relation
 * @method     ChildSupplierProductQuery rightJoinWithSupplier() Adds a RIGHT JOIN clause and with to the query using the Supplier relation
 * @method     ChildSupplierProductQuery innerJoinWithSupplier() Adds a INNER JOIN clause and with to the query using the Supplier relation
 *
 * @method     \Uphpu\Propel2Quickstart\ProductQuery|\Uphpu\Propel2Quickstart\SupplierQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSupplierProduct findOne(ConnectionInterface $con = null) Return the first ChildSupplierProduct matching the query
 * @method     ChildSupplierProduct findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSupplierProduct matching the query, or a new ChildSupplierProduct object populated from the query conditions when no match is found
 *
 * @method     ChildSupplierProduct findOneBySnum(string $snum) Return the first ChildSupplierProduct filtered by the snum column
 * @method     ChildSupplierProduct findOneByPnum(string $pnum) Return the first ChildSupplierProduct filtered by the pnum column
 * @method     ChildSupplierProduct findOneByQty(int $qty) Return the first ChildSupplierProduct filtered by the qty column *

 * @method     ChildSupplierProduct requirePk($key, ConnectionInterface $con = null) Return the ChildSupplierProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProduct requireOne(ConnectionInterface $con = null) Return the first ChildSupplierProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplierProduct requireOneBySnum(string $snum) Return the first ChildSupplierProduct filtered by the snum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProduct requireOneByPnum(string $pnum) Return the first ChildSupplierProduct filtered by the pnum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSupplierProduct requireOneByQty(int $qty) Return the first ChildSupplierProduct filtered by the qty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSupplierProduct[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSupplierProduct objects based on current ModelCriteria
 * @method     ChildSupplierProduct[]|ObjectCollection findBySnum(string $snum) Return ChildSupplierProduct objects filtered by the snum column
 * @method     ChildSupplierProduct[]|ObjectCollection findByPnum(string $pnum) Return ChildSupplierProduct objects filtered by the pnum column
 * @method     ChildSupplierProduct[]|ObjectCollection findByQty(int $qty) Return ChildSupplierProduct objects filtered by the qty column
 * @method     ChildSupplierProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SupplierProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Uphpu\Propel2Quickstart\Base\SupplierProductQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Uphpu\\Propel2Quickstart\\SupplierProduct', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSupplierProductQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSupplierProductQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSupplierProductQuery) {
            return $criteria;
        }
        $query = new ChildSupplierProductQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$snum, $pnum] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSupplierProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SupplierProductTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupplierProductTableMap::DATABASE_NAME);
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
     * @return ChildSupplierProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT snum, pnum, qty FROM supplier_product WHERE snum = :p0 AND pnum = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSupplierProduct $obj */
            $obj = new ChildSupplierProduct();
            $obj->hydrate($row);
            SupplierProductTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildSupplierProduct|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(SupplierProductTableMap::COL_SNUM, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(SupplierProductTableMap::COL_PNUM, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(SupplierProductTableMap::COL_SNUM, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(SupplierProductTableMap::COL_PNUM, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupplierProductTableMap::COL_SNUM, $snum, $comparison);
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupplierProductTableMap::COL_PNUM, $pnum, $comparison);
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
     */
    public function filterByQty($qty = null, $comparison = null)
    {
        if (is_array($qty)) {
            $useMinMax = false;
            if (isset($qty['min'])) {
                $this->addUsingAlias(SupplierProductTableMap::COL_QTY, $qty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qty['max'])) {
                $this->addUsingAlias(SupplierProductTableMap::COL_QTY, $qty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierProductTableMap::COL_QTY, $qty, $comparison);
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\Product object
     *
     * @param \Uphpu\Propel2Quickstart\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSupplierProductQuery The current query, for fluid interface
     */
    public function filterByProduct($product, $comparison = null)
    {
        if ($product instanceof \Uphpu\Propel2Quickstart\Product) {
            return $this
                ->addUsingAlias(SupplierProductTableMap::COL_PNUM, $product->getPnum(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierProductTableMap::COL_PNUM, $product->toKeyValue('PrimaryKey', 'Pnum'), $comparison);
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
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
     * @return ChildSupplierProductQuery The current query, for fluid interface
     */
    public function filterBySupplier($supplier, $comparison = null)
    {
        if ($supplier instanceof \Uphpu\Propel2Quickstart\Supplier) {
            return $this
                ->addUsingAlias(SupplierProductTableMap::COL_SNUM, $supplier->getSnum(), $comparison);
        } elseif ($supplier instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierProductTableMap::COL_SNUM, $supplier->toKeyValue('PrimaryKey', 'Snum'), $comparison);
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
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
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
     * @param   ChildSupplierProduct $supplierProduct Object to remove from the list of results
     *
     * @return $this|ChildSupplierProductQuery The current query, for fluid interface
     */
    public function prune($supplierProduct = null)
    {
        if ($supplierProduct) {
            $this->addCond('pruneCond0', $this->getAliasedColName(SupplierProductTableMap::COL_SNUM), $supplierProduct->getSnum(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(SupplierProductTableMap::COL_PNUM), $supplierProduct->getPnum(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the supplier_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SupplierProductTableMap::clearInstancePool();
            SupplierProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SupplierProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SupplierProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SupplierProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SupplierProductQuery
