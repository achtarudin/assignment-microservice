<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public function findRecordBy(array $attributes = []);

    public function updateRecord (Model $model, array $attributes) : Model;

    public function saveRecord(array $attributes): Model;
}
