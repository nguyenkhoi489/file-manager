<?php

namespace NguyenKhoi\FileManager\Repositories;

interface MediaBaseRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function insert(array $data);

    public function getAllTrash();

    public function getQuery();
}
