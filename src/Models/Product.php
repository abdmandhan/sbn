<?php

namespace Abdmandhan\Sbn\Models;

class Product extends BaseModel
{
    protected $fillable = [];

    protected $casts = [
        'yield'         => 'decimal:2',
        'yield_high'    => 'decimal:2',
        'yield_low'     => 'decimal:2',
    ];

    public function product_type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function yield_accept()
    {
        return $this->belongsTo(YieldAccept::class, 'yield_accept_id');
    }

    public function yield_type()
    {
        return $this->belongsTo(YieldType::class, 'yield_type_id');
    }
}
