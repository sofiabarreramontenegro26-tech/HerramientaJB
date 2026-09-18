<?php

namespace App\Interfaces;

interface AlertaInventarioInterface extends BaseInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
}
