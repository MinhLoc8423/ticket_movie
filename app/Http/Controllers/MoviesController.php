<?php

namespace App\Http\Controllers;
use App\Models\moviesModel;
use Illuminate\Http\Request;
class MoviesController extends Controller
{

    public function detail_index(){
        $moviesDetail = moviesModel::all();
        return response($moviesDetail);
    }
//---------------------------------------------------------------------------------------------------
    public function detail($id)
    {   
        $moviesDetail = moviesModel::find($id);
        if (!$moviesDetail) {
            return response('Phim không tồn tại');
        }
        return response($moviesDetail);
    }
//---------------------------------------------------------------------------------------------------  
    public function create_detail(Request $request){
        $this->validate($request, [
            'movie_title' => 'required',
            'description' => 'required',
            'thumnail' => 'required',
            'genre_id' => 'required|numeric',
            'movie_time' => 'required',
        ]);
        $movide_detail = moviesModel::create($request->all());
        return response()->json(['data' => $movide_detail], 201);
    }
//---------------------------------------------------------------------------------------------------
    public function update_detail(Request $request, $id){
        $update_detail = moviesModel::find($id);
        if(!$update_detail){
            return response("Không tồn tại phim để sửa");
        }
        else{
            $update_detail->update($request->all());
            return response(['data' => $update_detail]);
        }
    }
//--------------------------------------------------------------------------------------------------- 
    public function delete_detail($id){
        $delete_detail = moviesModel::find($id);
        if(!$delete_detail){
            return response("Không tồn tại phim để xóa");
        }
        else{
            $delete_detail->delete();
            return response("Đã xóa thành công");
        }
    }

}
