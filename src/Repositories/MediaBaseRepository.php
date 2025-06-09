<?php

namespace NguyenKhoi\FileManager\Repositories;

abstract class MediaBaseRepository implements MediaBaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($id, $data = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($data);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function getAllTrash()
    {
        return $this->model->whereNotNull('deleted_at')->get();

    }
}
