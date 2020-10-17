<?php

namespace Abdmandhan\Sbn\Controllers;

use Abdmandhan\Sbn\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $data = Product::paginate();
        return $this->reSuccess($data);
    }
}
