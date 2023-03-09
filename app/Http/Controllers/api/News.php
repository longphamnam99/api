<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ApiNewsCategoriesRequest;
use App\Models\News_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiNewsPostRequest;
use App\Models\News_posts;

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

    public function list_post(Request $request)
    {
        $post = new News_posts();
        $query = $request->query();
        $page = isset($query['page']) ? $query['page'] : 1;
        $limit = isset($query['limit']) ? $query['limit'] : 20;
        $count = DB::table($post->table)->where("deleted_at", null)->count();
        $results = DB::table($post->table)->where("deleted_at", null)->offset($page - 1)->limit($limit)->get();

        return response()->json([
            'code' => 200,
            'message' => 'ok',
            'data' => [
                "total" => $count,
                "items" => $results
            ]
        ]);
    }

    public function add_post(ApiNewsPostRequest $request)
    {
        $post = new News_posts();
        $post->category_id = $request->category_id;
        $post->name = $request->name;
        $post->content = $request->content;
        $post->introduce = $request->introduce;
        $post->photo = $request->image;
        $post->pin = $request->pin;
        $post->new = $request->new;
        $post->seo_description = $request->seo_desc;
        $post->seo_keyword = $request->seo_key;
        $post->seo_title = $request->seo_title;
        $post->status = $request->status;
        $saved = $post->save();

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

    public function edit_post(ApiNewsPostRequest $request) 
    {
        $post = new News_posts();
        $id = $request->route('id');

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'content' => $request->content,
            'introduce' => $request->content,
            'photo' => $request->image,
            'pin' => $request->pin,
            'new' => $request->new,
            'seo_description' => 'seo_desc',
            'seo_keyword' => $request->seo_key,
            'seo_title' => $request->seo_title,
            'status' => $request->status,
        ];

        if (empty($id)) {
            return response()->json([
                'code' => 400,
                'message' => 'Error'
            ]);
        }

        try {
            DB::table($post->table)
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

    public function delete_post(Request $request) 
    {
        $id = $request->route('id');
        $post = new News_posts();

        if (empty($id)) {
            return response()->json([
                'code' => 400,
                'message' => "Error"
            ]);
        }

        try {
            $datetime = new \DateTime("now", new \DateTimeZone("Asia/Ho_Chi_Minh"));

            DB::table($post->table)
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
