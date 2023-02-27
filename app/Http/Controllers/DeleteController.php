<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        Post::destroy($ids);

        return redirect()->route('posts.index')->with('success', 'Selected Posts Deleted Successfully');
    }
}
