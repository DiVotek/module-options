<?php

namespace Modules\Options\Models;

use App\Traits\HasImages;
use App\Traits\HasSorting;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTable;
use App\Traits\HasTimestamps;
use App\Traits\HasTranslate;
use Modules\Product\Models\Product;

class OptionValue extends Model
{
    use HasTable;
    use HasTimestamps;
    use HasSorting;
    use HasTranslate;
    use HasImages;
    use HasStatus;

    public static function getDb():string{
        return 'option_values';
    }

    protected $fillable = [
        'option_id',
        'name',
        'status',
        'sorting',
        'image',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option', 'option_value_id', 'product_id')
            ->withPivot('sign', 'price');
    }
}
