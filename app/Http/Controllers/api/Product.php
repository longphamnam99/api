<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiProductCategoriesRequest;
use App\Models\Product_categories;
use App\Models\Product_post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Product extends Controller
{
    public function list_category(Request $request)
    {
        $category = new Product_categories();
        $query = $request->query();
        $page = isset($query['page']) ? $query['page'] : 1;
        $limit = isset($query['limit']) ? $query['limit'] : 20;
        $count = DB::table($category->table)->where("deleted_at", null)->count();
        $results = DB::table($category->table)->where("deleted_at", null)->offset($page - 1)->limit($limit)->get();

        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'data' => [
                "total" => $count,
                "items" => $results
            ]
        ]);
    }

    public function add_category(ApiProductCategoriesRequest $request)
    {
        $category = new Product_categories();
        $category->name = $request->name;
        $category->code = $request->code;
        $category->photo = $request->photo;
        $category->seo_description = $request->seo_desc;
        $category->seo_keyword = $request->seo_key;
        $category->seo_title = $request->seo_title;
        $category->status = $request->status;
        $saved = $category->save();

        if (!$saved) {
            return [
                'code' => 400,
                'message' => ''
            ];
        }

        return response()->json([
            'code' => 200,
            'message' => 'Add success'
        ]);
    }

    public function edit_category(ApiProductCategoriesRequest $request)
    {
        $category = new Product_categories();
        $id = $request->route('id');
        if (empty($id)) {
            return response()->json([
                'code' => 400,
                'message' => "Error"
            ]);
        }

        $data = [
            'name' =>  $request->name,
            'code' => $request->code,
            'photo' => $request->photo,
            'seo_description' => $request->seo_desc,
            'seo_keyword' => $request->seo_key,
            'seo_title' => $request->seo_title,
            'status' => $request->status,
        ];

        try {
            DB::table($category->table)
                ->where('id', $id)
                ->update($data);
            return response()->json([
                'code' => 200,
                'message' => 'ok'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'code' => 400,
                'message' => "Error"
            ]);
        }
    }



    public function delete_category(Request $request)
    {
        $id = $request->route('id');
        $category = new Product_categories();

        try {
            $datetime = new \DateTime("now", new \DateTimeZone("Asia/Ho_Chi_Minh"));

            DB::table($category->table)
                ->where('id', $id)
                ->update([
                    "deleted_at" => $datetime->format('Y-m-d H:i:s')
                ]);
            return response()->json([
                'code' => 200,
                'message' => 'ok'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'code' => 400,
                'message' => "Error"
            ]);
        }
    }

    public function list_post(Request $request)
    {
        $category = new Product_post();
        $query = $request->query();
        $page = isset($query['page']) ? $query['page'] : 1;
        $limit = isset($query['limit']) ? $query['limit'] : 20;
        $count = DB::table($category->table)->where("deleted_at", null)->count();
        $results = DB::table($category->table)->where("deleted_at", null)->offset($page - 1)->limit($limit)->get();

        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'data' => [
                "total" => $count,
                "items" => $results
            ]
        ]);
    }
}
