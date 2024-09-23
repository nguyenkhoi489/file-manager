<?php

namespace Nguyenkhoi\FileManager\Repositories;

interface MediaBaseRepositoryInterface
{
    public function getAll();
    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
