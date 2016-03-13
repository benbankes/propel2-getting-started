<?php

namespace Uphpu\Propel2Quickstart\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Uphpu\Propel2Quickstart\Supplier as ChildSupplier;
use Uphpu\Propel2Quickstart\SupplierProduct as ChildSupplierProduct;
use Uphpu\Propel2Quickstart\SupplierProductJob as ChildSupplierProductJob;
use Uphpu\Propel2Quickstart\SupplierProductJobQuery as ChildSupplierProductJobQuery;
use Uphpu\Propel2Quickstart\SupplierProductQuery as ChildSupplierProductQuery;
use Uphpu\Propel2Quickstart\SupplierQuery as ChildSupplierQuery;
use Uphpu\Propel2Quickstart\Map\SupplierProductJobTableMap;
use Uphpu\Propel2Quickstart\Map\SupplierProductTableMap;
use Uphpu\Propel2Quickstart\Map\SupplierTableMap;

/**
 * Base class that represents a row from the 'supplier' table.
 *
 *
 *
* @package    propel.generator.Uphpu.Propel2Quickstart.Base
*/
abstract class Supplier implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Uphpu\\Propel2Quickstart\\Map\\SupplierTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the snum field.
     *
     * @var        string
     */
    protected $snum;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the status field.
     *
     * @var        int
     */
    protected $status;

    /**
     * The value for the city field.
     *
     * @var        string
     */
    protected $city;

    /**
     * @var        ObjectCollection|ChildSupplierProduct[] Collection to store aggregation of ChildSupplierProduct objects.
     */
    protected $collSupplierProducts;
    protected $collSupplierProductsPartial;

    /**
     * @var        ObjectCollection|ChildSupplierProductJob[] Collection to store aggregation of ChildSupplierProductJob objects.
     */
    protected $collSupplierProductJobs;
    protected $collSupplierProductJobsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSupplierProduct[]
     */
    protected $supplierProductsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildSupplierProductJob[]
     */
    protected $supplierProductJobsScheduledForDeletion = null;

    /**
     * Initializes internal state of Uphpu\Propel2Quickstart\Base\Supplier object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Supplier</code> instance.  If
     * <code>obj</code> is an instance of <code>Supplier</code>, delegates to
     * <code>equals(Supplier)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Supplier The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [snum] column value.
     *
     * @return string
     */
    public function getSnum()
    {
        return $this->snum;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of [snum] column.
     *
     * @param string $v new value
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function setSnum($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->snum !== $v) {
            $this->snum = $v;
            $this->modifiedColumns[SupplierTableMap::COL_SNUM] = true;
        }

        return $this;
    } // setSnum()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[SupplierTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [status] column.
     *
     * @param int $v new value
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[SupplierTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[SupplierTableMap::COL_CITY] = true;
        }

        return $this;
    } // setCity()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : SupplierTableMap::translateFieldName('Snum', TableMap::TYPE_PHPNAME, $indexType)];
            $this->snum = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : SupplierTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : SupplierTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : SupplierTableMap::translateFieldName('City', TableMap::TYPE_PHPNAME, $indexType)];
            $this->city = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = SupplierTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Uphpu\\Propel2Quickstart\\Supplier'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SupplierTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildSupplierQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collSupplierProducts = null;

            $this->collSupplierProductJobs = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Supplier::setDeleted()
     * @see Supplier::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildSupplierQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(SupplierTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                SupplierTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->supplierProductsScheduledForDeletion !== null) {
                if (!$this->supplierProductsScheduledForDeletion->isEmpty()) {
                    \Uphpu\Propel2Quickstart\SupplierProductQuery::create()
                        ->filterByPrimaryKeys($this->supplierProductsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->supplierProductsScheduledForDeletion = null;
                }
            }

            if ($this->collSupplierProducts !== null) {
                foreach ($this->collSupplierProducts as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->supplierProductJobsScheduledForDeletion !== null) {
                if (!$this->supplierProductJobsScheduledForDeletion->isEmpty()) {
                    \Uphpu\Propel2Quickstart\SupplierProductJobQuery::create()
                        ->filterByPrimaryKeys($this->supplierProductJobsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->supplierProductJobsScheduledForDeletion = null;
                }
            }

            if ($this->collSupplierProductJobs !== null) {
                foreach ($this->collSupplierProductJobs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(SupplierTableMap::COL_SNUM)) {
            $modifiedColumns[':p' . $index++]  = 'snum';
        }
        if ($this->isColumnModified(SupplierTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(SupplierTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(SupplierTableMap::COL_CITY)) {
            $modifiedColumns[':p' . $index++]  = 'city';
        }

        $sql = sprintf(
            'INSERT INTO supplier (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'snum':
                        $stmt->bindValue($identifier, $this->snum, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'city':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SupplierTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getSnum();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getStatus();
                break;
            case 3:
                return $this->getCity();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Supplier'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Supplier'][$this->hashCode()] = true;
        $keys = SupplierTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getSnum(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getStatus(),
            $keys[3] => $this->getCity(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collSupplierProducts) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'supplierProducts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'supplier_products';
                        break;
                    default:
                        $key = 'SupplierProducts';
                }

                $result[$key] = $this->collSupplierProducts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSupplierProductJobs) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'supplierProductJobs';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'supplier_product_jobs';
                        break;
                    default:
                        $key = 'SupplierProductJobs';
                }

                $result[$key] = $this->collSupplierProductJobs->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Uphpu\Propel2Quickstart\Supplier
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = SupplierTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Uphpu\Propel2Quickstart\Supplier
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setSnum($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setStatus($value);
                break;
            case 3:
                $this->setCity($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = SupplierTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setSnum($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCity($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(SupplierTableMap::DATABASE_NAME);

        if ($this->isColumnModified(SupplierTableMap::COL_SNUM)) {
            $criteria->add(SupplierTableMap::COL_SNUM, $this->snum);
        }
        if ($this->isColumnModified(SupplierTableMap::COL_NAME)) {
            $criteria->add(SupplierTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(SupplierTableMap::COL_STATUS)) {
            $criteria->add(SupplierTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(SupplierTableMap::COL_CITY)) {
            $criteria->add(SupplierTableMap::COL_CITY, $this->city);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildSupplierQuery::create();
        $criteria->add(SupplierTableMap::COL_SNUM, $this->snum);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getSnum();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getSnum();
    }

    /**
     * Generic method to set the primary key (snum column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setSnum($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getSnum();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Uphpu\Propel2Quickstart\Supplier (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setSnum($this->getSnum());
        $copyObj->setName($this->getName());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setCity($this->getCity());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getSupplierProducts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupplierProduct($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSupplierProductJobs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupplierProductJob($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Uphpu\Propel2Quickstart\Supplier Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('SupplierProduct' == $relationName) {
            return $this->initSupplierProducts();
        }
        if ('SupplierProductJob' == $relationName) {
            return $this->initSupplierProductJobs();
        }
    }

    /**
     * Clears out the collSupplierProducts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSupplierProducts()
     */
    public function clearSupplierProducts()
    {
        $this->collSupplierProducts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSupplierProducts collection loaded partially.
     */
    public function resetPartialSupplierProducts($v = true)
    {
        $this->collSupplierProductsPartial = $v;
    }

    /**
     * Initializes the collSupplierProducts collection.
     *
     * By default this just sets the collSupplierProducts collection to an empty array (like clearcollSupplierProducts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSupplierProducts($overrideExisting = true)
    {
        if (null !== $this->collSupplierProducts && !$overrideExisting) {
            return;
        }

        $collectionClassName = SupplierProductTableMap::getTableMap()->getCollectionClassName();

        $this->collSupplierProducts = new $collectionClassName;
        $this->collSupplierProducts->setModel('\Uphpu\Propel2Quickstart\SupplierProduct');
    }

    /**
     * Gets an array of ChildSupplierProduct objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSupplier is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSupplierProduct[] List of ChildSupplierProduct objects
     * @throws PropelException
     */
    public function getSupplierProducts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSupplierProductsPartial && !$this->isNew();
        if (null === $this->collSupplierProducts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSupplierProducts) {
                // return empty collection
                $this->initSupplierProducts();
            } else {
                $collSupplierProducts = ChildSupplierProductQuery::create(null, $criteria)
                    ->filterBySupplier($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSupplierProductsPartial && count($collSupplierProducts)) {
                        $this->initSupplierProducts(false);

                        foreach ($collSupplierProducts as $obj) {
                            if (false == $this->collSupplierProducts->contains($obj)) {
                                $this->collSupplierProducts->append($obj);
                            }
                        }

                        $this->collSupplierProductsPartial = true;
                    }

                    return $collSupplierProducts;
                }

                if ($partial && $this->collSupplierProducts) {
                    foreach ($this->collSupplierProducts as $obj) {
                        if ($obj->isNew()) {
                            $collSupplierProducts[] = $obj;
                        }
                    }
                }

                $this->collSupplierProducts = $collSupplierProducts;
                $this->collSupplierProductsPartial = false;
            }
        }

        return $this->collSupplierProducts;
    }

    /**
     * Sets a collection of ChildSupplierProduct objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $supplierProducts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSupplier The current object (for fluent API support)
     */
    public function setSupplierProducts(Collection $supplierProducts, ConnectionInterface $con = null)
    {
        /** @var ChildSupplierProduct[] $supplierProductsToDelete */
        $supplierProductsToDelete = $this->getSupplierProducts(new Criteria(), $con)->diff($supplierProducts);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->supplierProductsScheduledForDeletion = clone $supplierProductsToDelete;

        foreach ($supplierProductsToDelete as $supplierProductRemoved) {
            $supplierProductRemoved->setSupplier(null);
        }

        $this->collSupplierProducts = null;
        foreach ($supplierProducts as $supplierProduct) {
            $this->addSupplierProduct($supplierProduct);
        }

        $this->collSupplierProducts = $supplierProducts;
        $this->collSupplierProductsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SupplierProduct objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SupplierProduct objects.
     * @throws PropelException
     */
    public function countSupplierProducts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSupplierProductsPartial && !$this->isNew();
        if (null === $this->collSupplierProducts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSupplierProducts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSupplierProducts());
            }

            $query = ChildSupplierProductQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySupplier($this)
                ->count($con);
        }

        return count($this->collSupplierProducts);
    }

    /**
     * Method called to associate a ChildSupplierProduct object to this object
     * through the ChildSupplierProduct foreign key attribute.
     *
     * @param  ChildSupplierProduct $l ChildSupplierProduct
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function addSupplierProduct(ChildSupplierProduct $l)
    {
        if ($this->collSupplierProducts === null) {
            $this->initSupplierProducts();
            $this->collSupplierProductsPartial = true;
        }

        if (!$this->collSupplierProducts->contains($l)) {
            $this->doAddSupplierProduct($l);

            if ($this->supplierProductsScheduledForDeletion and $this->supplierProductsScheduledForDeletion->contains($l)) {
                $this->supplierProductsScheduledForDeletion->remove($this->supplierProductsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSupplierProduct $supplierProduct The ChildSupplierProduct object to add.
     */
    protected function doAddSupplierProduct(ChildSupplierProduct $supplierProduct)
    {
        $this->collSupplierProducts[]= $supplierProduct;
        $supplierProduct->setSupplier($this);
    }

    /**
     * @param  ChildSupplierProduct $supplierProduct The ChildSupplierProduct object to remove.
     * @return $this|ChildSupplier The current object (for fluent API support)
     */
    public function removeSupplierProduct(ChildSupplierProduct $supplierProduct)
    {
        if ($this->getSupplierProducts()->contains($supplierProduct)) {
            $pos = $this->collSupplierProducts->search($supplierProduct);
            $this->collSupplierProducts->remove($pos);
            if (null === $this->supplierProductsScheduledForDeletion) {
                $this->supplierProductsScheduledForDeletion = clone $this->collSupplierProducts;
                $this->supplierProductsScheduledForDeletion->clear();
            }
            $this->supplierProductsScheduledForDeletion[]= clone $supplierProduct;
            $supplierProduct->setSupplier(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Supplier is new, it will return
     * an empty collection; or if this Supplier has previously
     * been saved, it will retrieve related SupplierProducts from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Supplier.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSupplierProduct[] List of ChildSupplierProduct objects
     */
    public function getSupplierProductsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSupplierProductQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getSupplierProducts($query, $con);
    }

    /**
     * Clears out the collSupplierProductJobs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addSupplierProductJobs()
     */
    public function clearSupplierProductJobs()
    {
        $this->collSupplierProductJobs = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collSupplierProductJobs collection loaded partially.
     */
    public function resetPartialSupplierProductJobs($v = true)
    {
        $this->collSupplierProductJobsPartial = $v;
    }

    /**
     * Initializes the collSupplierProductJobs collection.
     *
     * By default this just sets the collSupplierProductJobs collection to an empty array (like clearcollSupplierProductJobs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSupplierProductJobs($overrideExisting = true)
    {
        if (null !== $this->collSupplierProductJobs && !$overrideExisting) {
            return;
        }

        $collectionClassName = SupplierProductJobTableMap::getTableMap()->getCollectionClassName();

        $this->collSupplierProductJobs = new $collectionClassName;
        $this->collSupplierProductJobs->setModel('\Uphpu\Propel2Quickstart\SupplierProductJob');
    }

    /**
     * Gets an array of ChildSupplierProductJob objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildSupplier is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildSupplierProductJob[] List of ChildSupplierProductJob objects
     * @throws PropelException
     */
    public function getSupplierProductJobs(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collSupplierProductJobsPartial && !$this->isNew();
        if (null === $this->collSupplierProductJobs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSupplierProductJobs) {
                // return empty collection
                $this->initSupplierProductJobs();
            } else {
                $collSupplierProductJobs = ChildSupplierProductJobQuery::create(null, $criteria)
                    ->filterBySupplier($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collSupplierProductJobsPartial && count($collSupplierProductJobs)) {
                        $this->initSupplierProductJobs(false);

                        foreach ($collSupplierProductJobs as $obj) {
                            if (false == $this->collSupplierProductJobs->contains($obj)) {
                                $this->collSupplierProductJobs->append($obj);
                            }
                        }

                        $this->collSupplierProductJobsPartial = true;
                    }

                    return $collSupplierProductJobs;
                }

                if ($partial && $this->collSupplierProductJobs) {
                    foreach ($this->collSupplierProductJobs as $obj) {
                        if ($obj->isNew()) {
                            $collSupplierProductJobs[] = $obj;
                        }
                    }
                }

                $this->collSupplierProductJobs = $collSupplierProductJobs;
                $this->collSupplierProductJobsPartial = false;
            }
        }

        return $this->collSupplierProductJobs;
    }

    /**
     * Sets a collection of ChildSupplierProductJob objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $supplierProductJobs A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildSupplier The current object (for fluent API support)
     */
    public function setSupplierProductJobs(Collection $supplierProductJobs, ConnectionInterface $con = null)
    {
        /** @var ChildSupplierProductJob[] $supplierProductJobsToDelete */
        $supplierProductJobsToDelete = $this->getSupplierProductJobs(new Criteria(), $con)->diff($supplierProductJobs);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->supplierProductJobsScheduledForDeletion = clone $supplierProductJobsToDelete;

        foreach ($supplierProductJobsToDelete as $supplierProductJobRemoved) {
            $supplierProductJobRemoved->setSupplier(null);
        }

        $this->collSupplierProductJobs = null;
        foreach ($supplierProductJobs as $supplierProductJob) {
            $this->addSupplierProductJob($supplierProductJob);
        }

        $this->collSupplierProductJobs = $supplierProductJobs;
        $this->collSupplierProductJobsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related SupplierProductJob objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related SupplierProductJob objects.
     * @throws PropelException
     */
    public function countSupplierProductJobs(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collSupplierProductJobsPartial && !$this->isNew();
        if (null === $this->collSupplierProductJobs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSupplierProductJobs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSupplierProductJobs());
            }

            $query = ChildSupplierProductJobQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterBySupplier($this)
                ->count($con);
        }

        return count($this->collSupplierProductJobs);
    }

    /**
     * Method called to associate a ChildSupplierProductJob object to this object
     * through the ChildSupplierProductJob foreign key attribute.
     *
     * @param  ChildSupplierProductJob $l ChildSupplierProductJob
     * @return $this|\Uphpu\Propel2Quickstart\Supplier The current object (for fluent API support)
     */
    public function addSupplierProductJob(ChildSupplierProductJob $l)
    {
        if ($this->collSupplierProductJobs === null) {
            $this->initSupplierProductJobs();
            $this->collSupplierProductJobsPartial = true;
        }

        if (!$this->collSupplierProductJobs->contains($l)) {
            $this->doAddSupplierProductJob($l);

            if ($this->supplierProductJobsScheduledForDeletion and $this->supplierProductJobsScheduledForDeletion->contains($l)) {
                $this->supplierProductJobsScheduledForDeletion->remove($this->supplierProductJobsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildSupplierProductJob $supplierProductJob The ChildSupplierProductJob object to add.
     */
    protected function doAddSupplierProductJob(ChildSupplierProductJob $supplierProductJob)
    {
        $this->collSupplierProductJobs[]= $supplierProductJob;
        $supplierProductJob->setSupplier($this);
    }

    /**
     * @param  ChildSupplierProductJob $supplierProductJob The ChildSupplierProductJob object to remove.
     * @return $this|ChildSupplier The current object (for fluent API support)
     */
    public function removeSupplierProductJob(ChildSupplierProductJob $supplierProductJob)
    {
        if ($this->getSupplierProductJobs()->contains($supplierProductJob)) {
            $pos = $this->collSupplierProductJobs->search($supplierProductJob);
            $this->collSupplierProductJobs->remove($pos);
            if (null === $this->supplierProductJobsScheduledForDeletion) {
                $this->supplierProductJobsScheduledForDeletion = clone $this->collSupplierProductJobs;
                $this->supplierProductJobsScheduledForDeletion->clear();
            }
            $this->supplierProductJobsScheduledForDeletion[]= clone $supplierProductJob;
            $supplierProductJob->setSupplier(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Supplier is new, it will return
     * an empty collection; or if this Supplier has previously
     * been saved, it will retrieve related SupplierProductJobs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Supplier.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSupplierProductJob[] List of ChildSupplierProductJob objects
     */
    public function getSupplierProductJobsJoinJob(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSupplierProductJobQuery::create(null, $criteria);
        $query->joinWith('Job', $joinBehavior);

        return $this->getSupplierProductJobs($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Supplier is new, it will return
     * an empty collection; or if this Supplier has previously
     * been saved, it will retrieve related SupplierProductJobs from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Supplier.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildSupplierProductJob[] List of ChildSupplierProductJob objects
     */
    public function getSupplierProductJobsJoinProduct(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildSupplierProductJobQuery::create(null, $criteria);
        $query->joinWith('Product', $joinBehavior);

        return $this->getSupplierProductJobs($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->snum = null;
        $this->name = null;
        $this->status = null;
        $this->city = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collSupplierProducts) {
                foreach ($this->collSupplierProducts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSupplierProductJobs) {
                foreach ($this->collSupplierProductJobs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collSupplierProducts = null;
        $this->collSupplierProductJobs = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(SupplierTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
