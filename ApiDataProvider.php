<?php
/**
 * api接口数据提供类
 * User: yuantong
 * Date: 2023/2/13
 * Email: <yuantong@srun.com>
 */

namespace srun\provider;

use yii\data\BaseDataProvider;

/**
 * ApiDataProvider implements a data provider based on a data array.
 * The [[allModels]] property contains all data models that may be sorted and/or paginated.
 * ArrayDataProvider will provide the data after sorting and/or pagination.
 * You may configure the [[sort]] and [[pagination]] properties to
 * customize the sorting and pagination behaviors.
 *
 * Elements in the [[allModels]] array may be either objects (e.g. model objects)
 * or associative arrays (e.g. query results of DAO).
 * Make sure to set the [[key]] property to the name of the field that uniquely
 * identifies a data record or false if you do not have such a field.
 *
 * Compared to [[ActiveDataProvider]], ArrayDataProvider could be less efficient
 * because it needs to have [[allModels]] ready.
 *
 * ApiDataProvider may be used in the following way:
 *
 * ```php
 * $provider = new ApiDataProvider([
 *      'allModels' => $data,
 *      'totalCount' => $totalCount,
 *      'pagination' => [
 *          'pageSize => 10,
 *      ]
 * ```
 * @author yt <yuantong@srun.com>
 * @version 1.0
 * @link https://www.yiichina.com/doc/guide/2.0/output-data-providers
 * @link https://www.yiichina.com/doc/api/2.0/yii-data-arraydataprovider
 */
class ApiDataProvider extends BaseDataProvider
{
    /**
     * @var string|callable the column that is used as the key of the data models.
     * This can be either a column name, or a callable that returns the key value of a given data model.
     * If this is not set, the index of the [[models]] array will be used.
     * @see getKeys()
     */
    public $key;
    /**
     * @var array the data that is not paginated or sorted. When pagination is enabled,
     * this property usually contains more elements that [[models]].
     * The array elements must use zero-based integer keys.
     */
    public $allModels;

    /**
     * {@inheritdoc}
     */
    protected function prepareModels()
    {
        if (($models = $this->allModels) === null) {
            return [];
        }

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $this->getTotalCount();
        }
        return $models;
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareKeys($models)
    {
        if ($this->key === null) {
            return array_keys($models);
        } else {
            $keys = [];
            foreach ($models as $model) {
                if (is_string($this->key)) {
                    $keys[] = $model[$this->key];
                } else {
                    $keys[] = call_user_func($this->key, $model);
                }
            }

            return $keys;
        }

    }

    /**
     * {@inheritdoc}
     */
    protected function prepareTotalCount()
    {
        return $this->totalCount;
    }
}