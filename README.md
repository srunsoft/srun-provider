##Srun-Provider
The srun4-api's ActiveDataProvider is parsed to use the GridView

解析`srun4k-api` 的`ActiveDataProvider` 数据结构以使用 `GirdView`

因为接口返回 `ActiveDataProvider` 数据结构,而页面需要搭配 `GridView` 组件。

所以需要将数据源转换成`DataProvider` ，将 `ArrayDataProvider` 去掉分页逻辑。
### Installation

Either run
```php
composer require srun/provider
```
or add
```php
"srun/provider":"*"
```
to the require section of your `composer.json` file.

Usage

```php
return new \srun\provider\ApiDataProvider([
    'allModels' => $data, /*@var array 数据源*/
    'totalCount' => $totalCount, /*@var int 总数*/
    'pagination' => [
        'pageSize' => 10, /*@var int 分页大小*/
    ],
]);
```