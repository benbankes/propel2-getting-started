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
use Uphpu\Propel2Quickstart\Job as ChildJob;
use Uphpu\Propel2Quickstart\JobQuery as ChildJobQuery;
use Uphpu\Propel2Quickstart\Map\JobTableMap;

/**
 * Base class that represents a query for the 'job' table.
 *
 *
 *
 * @method     ChildJobQuery orderByJnum($order = Criteria::ASC) Order by the jnum column
 * @method     ChildJobQuery orderByJname($order = Criteria::ASC) Order by the jname column
 * @method     ChildJobQuery orderByCity($order = Criteria::ASC) Order by the city column
 *
 * @method     ChildJobQuery groupByJnum() Group by the jnum column
 * @method     ChildJobQuery groupByJname() Group by the jname column
 * @method     ChildJobQuery groupByCity() Group by the city column
 *
 * @method     ChildJobQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildJobQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildJobQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildJobQuery leftJoinSupplierProductJob($relationAlias = null) Adds a LEFT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildJobQuery rightJoinSupplierProductJob($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SupplierProductJob relation
 * @method     ChildJobQuery innerJoinSupplierProductJob($relationAlias = null) Adds a INNER JOIN clause to the query using the SupplierProductJob relation
 *
 * @method     ChildJobQuery joinWithSupplierProductJob($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SupplierProductJob relation
 *
 * @method     ChildJobQuery leftJoinWithSupplierProductJob() Adds a LEFT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildJobQuery rightJoinWithSupplierProductJob() Adds a RIGHT JOIN clause and with to the query using the SupplierProductJob relation
 * @method     ChildJobQuery innerJoinWithSupplierProductJob() Adds a INNER JOIN clause and with to the query using the SupplierProductJob relation
 *
 * @method     \Uphpu\Propel2Quickstart\SupplierProductJobQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildJob findOne(ConnectionInterface $con = null) Return the first ChildJob matching the query
 * @method     ChildJob findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJob matching the query, or a new ChildJob object populated from the query conditions when no match is found
 *
 * @method     ChildJob findOneByJnum(string $jnum) Return the first ChildJob filtered by the jnum column
 * @method     ChildJob findOneByJname(string $jname) Return the first ChildJob filtered by the jname column
 * @method     ChildJob findOneByCity(string $city) Return the first ChildJob filtered by the city column *

 * @method     ChildJob requirePk($key, ConnectionInterface $con = null) Return the ChildJob by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJob requireOne(ConnectionInterface $con = null) Return the first ChildJob matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJob requireOneByJnum(string $jnum) Return the first ChildJob filtered by the jnum column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJob requireOneByJname(string $jname) Return the first ChildJob filtered by the jname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJob requireOneByCity(string $city) Return the first ChildJob filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJob[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJob objects based on current ModelCriteria
 * @method     ChildJob[]|ObjectCollection findByJnum(string $jnum) Return ChildJob objects filtered by the jnum column
 * @method     ChildJob[]|ObjectCollection findByJname(string $jname) Return ChildJob objects filtered by the jname column
 * @method     ChildJob[]|ObjectCollection findByCity(string $city) Return ChildJob objects filtered by the city column
 * @method     ChildJob[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Uphpu\Propel2Quickstart\Base\JobQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Uphpu\\Propel2Quickstart\\Job', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobQuery) {
            return $criteria;
        }
        $query = new ChildJobQuery();
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
     * @return ChildJob|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobTableMap::DATABASE_NAME);
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
     * @return ChildJob A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT jnum, jname, city FROM job WHERE jnum = :p0';
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
            /** @var ChildJob $obj */
            $obj = new ChildJob();
            $obj->hydrate($row);
            JobTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildJob|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobTableMap::COL_JNUM, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobTableMap::COL_JNUM, $keys, Criteria::IN);
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
     * @return $this|ChildJobQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobTableMap::COL_JNUM, $jnum, $comparison);
    }

    /**
     * Filter the query on the jname column
     *
     * Example usage:
     * <code>
     * $query->filterByJname('fooValue');   // WHERE jname = 'fooValue'
     * $query->filterByJname('%fooValue%'); // WHERE jname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobQuery The current query, for fluid interface
     */
    public function filterByJname($jname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $jname)) {
                $jname = str_replace('*', '%', $jname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JobTableMap::COL_JNAME, $jname, $comparison);
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
     * @return $this|ChildJobQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobTableMap::COL_CITY, $city, $comparison);
    }

    /**
     * Filter the query by a related \Uphpu\Propel2Quickstart\SupplierProductJob object
     *
     * @param \Uphpu\Propel2Quickstart\SupplierProductJob|ObjectCollection $supplierProductJob the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildJobQuery The current query, for fluid interface
     */
    public function filterBySupplierProductJob($supplierProductJob, $comparison = null)
    {
        if ($supplierProductJob instanceof \Uphpu\Propel2Quickstart\SupplierProductJob) {
            return $this
                ->addUsingAlias(JobTableMap::COL_JNUM, $supplierProductJob->getJnum(), $comparison);
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
     * @return $this|ChildJobQuery The current query, for fluid interface
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
     * @param   ChildJob $job Object to remove from the list of results
     *
     * @return $this|ChildJobQuery The current query, for fluid interface
     */
    public function prune($job = null)
    {
        if ($job) {
            $this->addUsingAlias(JobTableMap::COL_JNUM, $job->getJnum(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the job table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobTableMap::clearInstancePool();
            JobTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // JobQuery
