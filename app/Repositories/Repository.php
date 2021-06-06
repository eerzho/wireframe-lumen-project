<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Class Repository
 * @property $model
 * @package App\Repositories
 */
abstract class Repository
{
    private $model;

    /**
     * @return string
     */
    abstract protected function getModel(): string;

    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     * @throws RecordNotFoundException
     */
    public function getById($id)
    {
        $this->checkId($id);

        return $this->table()->where('id', $id)->first();
    }

    /**
     * @param $id
     *
     * @return bool
     * @throws RecordNotFoundException
     */
    private function checkId($id)
    {
        if (!$this->validateInt($id)) {
            throw new RecordNotFoundException();
        }

        return true;
    }

    /**
     * @param $variable
     *
     * @return bool
     */
    private function validateInt($variable)
    {
        $validator = Validator::make(
            ['variable' => $variable],
            ['variable' => ['required', 'integer',]]
        );

        return !$validator->fails();
    }

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function table()
    {
        return DB::table($this->model::getTableName());
    }
}
