<?php

namespace App\Http\Controllers\admin\posts;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\helper\RepairFileSrc;

/**
 * @method repair_file_src(\Symfony\Component\HttpFoundation\File\File $post_image)
 */
class adminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = Post::query()
            ->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::query()
            ->where('for_post', 1)
            ->get();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'post_title' => 'required|string|max:255',
            'post_nickname' => 'required|string|max:255',
            'post_image' => 'required|mimes:png,jpg,jpeg|max:255',
            'post_content' => 'required|string|max:50000',
            'post_meta_keywords' => 'required|string|max:255',
            'post_meta_description' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $file = $request->file('post_image');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'post_' . time() . '.' . $file_ext;
        $post_image = $file->move('site\assets\post_images', $file_name);

        $post = Post::query()->create([
            'post_title' => $input['post_title'],
            'post_nickname' => str_replace(' ', '-', $input['post_nickname']),
            'post_content' => $input['post_content'],
            'post_meta_keywords' => $input['post_meta_keywords'],
            'post_meta_description' => $input['post_meta_description'],
            'post_image' => RepairFileSrc::repair_file_src($post_image),
        ]);

        CategoryPost::query()->create([
            'post_id'=>$post['id'],
            'category_id'=>1
        ]);


        alert()->success('','مقاله با موفقیت افزوده شد');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $post_info = Post::query()->findOrFail($id);
        if (file_exists($post_info['post_image']) and !is_dir($post_info['post_image'])) {
            $post_info['post_image'] = asset($post_info['post_image']);
        } else {
            $post_info['post_image'] = asset('admin/assets/image_name/placeholders/img_placeholder.png');
        }

        return view('admin.posts.show', compact('post_info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $post = Post::query()
            ->where('id', $id)
            ->findOrFail($id);

        $validation = Validator::make($input, [
            'post_title' => 'required|string|max:255',
            'post_nickname' => 'required|string|max:255',
            'post_image' => 'required|mimes:png,jpg,jpeg|max:255',
            'post_content' => 'required|string|max:50000',
            'post_meta_keywords' => 'required|string|max:255',
            'post_meta_description' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        if ($request->has('post_image')) {
            //get posts image and delete old profile
            $old = $post->post_image;

            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('post_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'post_' . time() . '.' . $file_ext;
            $post_image = $file->move('site\assets\post_images', $file_name);

            $post->update([
                'post_image' => RepairFileSrc::repair_file_src($post_image),
            ]);
        }

        $post->update([
            'post_title' => $input['post_title'],
            'post_nickname' => str_replace(' ', '-', $input['post_nickname']),
            'post_content' => $input['post_content'],
            'post_meta_keywords' => $input['post_meta_keywords'],
            'post_meta_description' => $input['post_meta_description'],
        ]);

        alert()->success('','مقاله با موفقیت ویرایش شد');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $post = Post::query()->findOrFail($id);

        $old = $post->post_image;
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

