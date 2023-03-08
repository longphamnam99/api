<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ApiNewsCategoriesRequest;
use App\Models\News_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class News extends Controller
{
    public function list_category(Request $request)
    {
        $category = new News_categories();
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

    public function add_category(ApiNewsCategoriesRequest $request)
    {
        $category = new News_categories();
        $category->title = $request->title;
        $category->description = $request->desc;
        $category->image = $request->image;
        $category->icon = $request->icon;
        $category->seo_desc = $request->seo_desc;
        $category->seo_key = $request->seo_key;
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

    public function edit_category(ApiNewsCategoriesRequest $request)
    {
        $category = new News_categories();
        $id = $request->route('id');
        if (empty($id)) {
            return response()->json([
                'code' => 400,
                'message' => "Error"
            ]);
        }

        $data = [
            'title' =>  $request->title,
            'description' => $request->desc,
            'image' => $request->image,
            'icon' => $request->icon,
            'seo_desc' => $request->seo_desc,
            'seo_key' => $request->seo_key,
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
        $category = new News_categories();

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
}
