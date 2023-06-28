<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index()
    {
        $comments = DB::table('product_comments')->select( 'products.image as product_img', 'products.name as product_name', 'users.name as username', 'users.email as useremail', 'product_comments.*')
        ->join('users', 'product_comments.user_id', '=', 'users.id')
        ->join('products', 'product_comments.product_id', '=', 'products.id')
        ->get();
        
        return view('admin.comment.index', [
            'comments' => $comments,
        ]);
    }
}
