<?php

namespace models\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use models\models\Images as ChildImages;
use models\models\ImagesQuery as ChildImagesQuery;
use models\models\Map\ImagesTableMap;

/**
 * Base class that represents a query for the 'images_table' table.
 *
 *
 *
 * @method     ChildImagesQuery orderByImageId($order = Criteria::ASC) Order by the image_id column
 * @method     ChildImagesQuery orderByMarkerid($order = Criteria::ASC) Order by the markerId column
 * @method     ChildImagesQuery orderByImageurl($order = Criteria::ASC) Order by the imageUrl column
 *
 * @method     ChildImagesQuery groupByImageId() Group by the image_id column
 * @method     ChildImagesQuery groupByMarkerid() Group by the markerId column
 * @method     ChildImagesQuery groupByImageurl() Group by the imageUrl column
 *
 * @method     ChildImagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildImagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildImagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildImagesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildImagesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildImagesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildImagesQuery leftJoinMarkers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Markers relation
 * @method     ChildImagesQuery rightJoinMarkers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Markers relation
 * @method     ChildImagesQuery innerJoinMarkers($relationAlias = null) Adds a INNER JOIN clause to the query using the Markers relation
 *
 * @method     ChildImagesQuery joinWithMarkers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Markers relation
 *
 * @method     ChildImagesQuery leftJoinWithMarkers() Adds a LEFT JOIN clause and with to the query using the Markers relation
 * @method     ChildImagesQuery rightJoinWithMarkers() Adds a RIGHT JOIN clause and with to the query using the Markers relation
 * @method     ChildImagesQuery innerJoinWithMarkers() Adds a INNER JOIN clause and with to the query using the Markers relation
 *
 * @method     \models\models\MarkersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildImages findOne(ConnectionInterface $con = null) Return the first ChildImages matching the query
 * @method     ChildImages findOneOrCreate(ConnectionInterface $con = null) Return the first ChildImages matching the query, or a new ChildImages object populated from the query conditions when no match is found
 *
 * @method     ChildImages findOneByImageId(int $image_id) Return the first ChildImages filtered by the image_id column
 * @method     ChildImages findOneByMarkerid(int $markerId) Return the first ChildImages filtered by the markerId column
 * @method     ChildImages findOneByImageurl(string $imageUrl) Return the first ChildImages filtered by the imageUrl column *

 * @method     ChildImages requirePk($key, ConnectionInterface $con = null) Return the ChildImages by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImages requireOne(ConnectionInterface $con = null) Return the first ChildImages matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImages requireOneByImageId(int $image_id) Return the first ChildImages filtered by the image_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImages requireOneByMarkerid(int $markerId) Return the first ChildImages filtered by the markerId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImages requireOneByImageurl(string $imageUrl) Return the first ChildImages filtered by the imageUrl column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImages[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildImages objects based on current ModelCriteria
 * @method     ChildImages[]|ObjectCollection findByImageId(int $image_id) Return ChildImages objects filtered by the image_id column
 * @method     ChildImages[]|ObjectCollection findByMarkerid(int $markerId) Return ChildImages objects filtered by the markerId column
 * @method     ChildImages[]|ObjectCollection findByImageurl(string $imageUrl) Return ChildImages objects filtered by the imageUrl column
 * @method     ChildImages[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ImagesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\ImagesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'teratour', $modelName = '\\models\\models\\Images', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildImagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildImagesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildImagesQuery) {
            return $criteria;
        }
        $query = new ChildImagesQuery();
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
     * @return ChildImages|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ImagesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ImagesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildImages A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT image_id, markerId, imageUrl FROM images_table WHERE image_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildImages $obj */
            $obj = new ChildImages();
            $obj->hydrate($row);
            ImagesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildImages|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the image_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImageId(1234); // WHERE image_id = 1234
     * $query->filterByImageId(array(12, 34)); // WHERE image_id IN (12, 34)
     * $query->filterByImageId(array('min' => 12)); // WHERE image_id > 12
     * </code>
     *
     * @param     mixed $imageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function filterByImageId($imageId = null, $comparison = null)
    {
        if (is_array($imageId)) {
            $useMinMax = false;
            if (isset($imageId['min'])) {
                $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $imageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imageId['max'])) {
                $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $imageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $imageId, $comparison);
    }

    /**
     * Filter the query on the markerId column
     *
     * Example usage:
     * <code>
     * $query->filterByMarkerid(1234); // WHERE markerId = 1234
     * $query->filterByMarkerid(array(12, 34)); // WHERE markerId IN (12, 34)
     * $query->filterByMarkerid(array('min' => 12)); // WHERE markerId > 12
     * </code>
     *
     * @see       filterByMarkers()
     *
     * @param     mixed $markerid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function filterByMarkerid($markerid = null, $comparison = null)
    {
        if (is_array($markerid)) {
            $useMinMax = false;
            if (isset($markerid['min'])) {
                $this->addUsingAlias(ImagesTableMap::COL_MARKERID, $markerid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($markerid['max'])) {
                $this->addUsingAlias(ImagesTableMap::COL_MARKERID, $markerid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagesTableMap::COL_MARKERID, $markerid, $comparison);
    }

    /**
     * Filter the query on the imageUrl column
     *
     * Example usage:
     * <code>
     * $query->filterByImageurl('fooValue');   // WHERE imageUrl = 'fooValue'
     * $query->filterByImageurl('%fooValue%', Criteria::LIKE); // WHERE imageUrl LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imageurl The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function filterByImageurl($imageurl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imageurl)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImagesTableMap::COL_IMAGEURL, $imageurl, $comparison);
    }

    /**
     * Filter the query by a related \models\models\Markers object
     *
     * @param \models\models\Markers|ObjectCollection $markers The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildImagesQuery The current query, for fluid interface
     */
    public function filterByMarkers($markers, $comparison = null)
    {
        if ($markers instanceof \models\models\Markers) {
            return $this
                ->addUsingAlias(ImagesTableMap::COL_MARKERID, $markers->getId(), $comparison);
        } elseif ($markers instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ImagesTableMap::COL_MARKERID, $markers->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMarkers() only accepts arguments of type \models\models\Markers or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Markers relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function joinMarkers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Markers');

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
            $this->addJoinObject($join, 'Markers');
        }

        return $this;
    }

    /**
     * Use the Markers relation Markers object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\MarkersQuery A secondary query class using the current class as primary query
     */
    public function useMarkersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMarkers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Markers', '\models\models\MarkersQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildImages $images Object to remove from the list of results
     *
     * @return $this|ChildImagesQuery The current query, for fluid interface
     */
    public function prune($images = null)
    {
        if ($images) {
            $this->addUsingAlias(ImagesTableMap::COL_IMAGE_ID, $images->getImageId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the images_table table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ImagesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ImagesTableMap::clearInstancePool();
            ImagesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ImagesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ImagesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ImagesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ImagesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ImagesQuery
