<?php

namespace App\Models;

use App\Models\Trait\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    use UuidTrait;

    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $table = 'profiles';
    protected $fillable = ['name', 'description'];

    public function search($filter)
    {
        $records =  $this->query()
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")->paginate(10);

        return $records;
    }
}
