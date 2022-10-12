<?php

namespace App\Services\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthService implements ServiceInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findRecordBy(array $attributes = [])
    {
        return $this->user->where($attributes);
    }

    public function updateRecord(Model $model, array $attributes): Model
    {
        DB::beginTransaction();
        try {
            return $model;
            DB::commit();
        } catch (Exception $th) {
            DB::rollback();
            $statusCode = method_exists($th, 'getStatusCode') ? $th->getStatusCode() : 500;
            throw_if($th, new HttpException($statusCode, $th->getMessage()));
        }
    }

    public function saveRecord(array $attributes): Model
    {
        DB::beginTransaction();
        try {

            $result = $this->user->fill(array_merge($attributes, [
                'created_at' => Carbon::now(),
            ]));
            $result->password = Hash::make($attributes['password']);
            $result->save();
            DB::commit();
            return $result;
        } catch (Exception $th) {
            DB::rollback();
            $statusCode = method_exists($th, 'getStatusCode') ? $th->getStatusCode() : 500;
            throw_if($th, new HttpException($statusCode, $th->getMessage()));
        }
    }
}
