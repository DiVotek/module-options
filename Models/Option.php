<?php

namespace Modules\Options\Models;

use App\Traits\HasSorting;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;

class Option extends Model
{
    use HasTable;
    use HasTimestamps;
    use HasStatus;
    use HasSorting;
    use HasTranslate;

    public static function getDb(): string
    {
        return 'options';
    }

    protected $fillable = [
        'name',
        'status',
        'sorting',
        'required',
        'default_value',
    ];

    public function values()
    {
        return $this->hasMany(OptionValue::class);
    }

    public function defaultValue()
    {
        return $this->hasOne(OptionValue::class, 'id', 'default_value');
    }

}
