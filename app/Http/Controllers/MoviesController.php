<?php

namespace App\Http\Controllers;
use App\Models\moviesModel;
class MoviesController extends Controller
{

    public function detail($id)
    {   
        $moviesDetail = moviesModel::find($id);
        if (!$moviesDetail) {
            return response('Sản phẩm không tồn tại');
        }
        return response($moviesDetail);

    }
    

}
