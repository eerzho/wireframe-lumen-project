<?php

namespace App\Repositories;

use App\Exceptions\RecordNotFoundException;
use App\Models\Model;
use Illuminate\Database\Query\Builder;
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
     * @return mixed
     */
    public function query()
    {
        return clone $this->model::query();
    }

    /**
     * @param $id
     *
     * @return Model
     * @throws RecordNotFoundException
     */
    public function getById($id)
    {
        $this->checkId($id);

        return $this->query()->where('id', $id)->first() ?: throw new RecordNotFoundException();
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
            ['variable' => ['required', 'integer']]
        );

        return !$validator->fails();
    }
}
