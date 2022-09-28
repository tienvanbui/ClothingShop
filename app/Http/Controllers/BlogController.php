<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->setModel(Blog::class);
        $this->getAppMenu();
    }
    protected function listBlogs()
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $countBlogInEachTime = DB::table('blogs')
            ->selectRaw(("date_format(updated_at, '%M %Y') as formatted_updated_at"))
            ->selectRaw('count(*) as number_of_blogs')
            ->groupBy('formatted_updated_at')
            ->take(10)
            ->get();
        $blogs = Blog::where('outdate', '>=', config('timeVarConst.time_now'))->latest()->paginate(1);
        $tags = Tag::all();
        return view('user.blog.index', compact(['blogs', 'tags']))
            ->with('menus', $this->menus)
            ->with('countTheNumberBlogs', $countBlogInEachTime)
            ->with('tagId', null)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    public function fetchData(Request $request)
    {
        if ($request->ajax()) {
            if (empty($request->tag)) {
                $blogs = Blog::where('outdate', '>=', config('timeVarConst.time_now'))
                    ->where('blog_name', 'LIKE', '%' . $request->keyword . '%')
                    ->latest()
                    ->paginate(1);
                return view('user.blog.item-blog', compact('blogs'));
            } else {
                $blogs = Blog::join('blog_tag', 'blogs.id', '=', 'blog_tag.blog_id')
                    ->join('tags', 'blog_tag.tag_id', '=', 'tags.id')
                    ->select('blogs.*')
                    ->where('blogs.outdate', '>=', config('timeVarConst.time_now'))
                    ->where('tags.id', '=',  $request->tag)
                    ->where('blog_name', 'LIKE', '%' . $request->keyword . '%')
                    ->latest()
                    ->paginate(1);
                return view('user.blog.item-blog', compact('blogs'));
            }
        }
    }
    public function detailBlog($id)
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $countBlogInEachTime = DB::table('blogs')
            ->selectRaw(("date_format(updated_at, '%M %Y') as formatted_updated_at"))
            ->selectRaw('count(*) as number_of_blogs')
            ->groupBy('formatted_updated_at')
            ->latest()
            ->take(10)
            ->get();
        $blog = Blog::with(['tags', 'user'])->findOrFail($id);
        $blog->increment('viewed_number_count');
        $tags = Tag::all();
        $comments = $blog->comments()->latest()->paginate(10);
        return view('user.blog.blog-detail', compact(['blog', 'tags', 'comments']))
            ->with('menus', $this->menus)
            ->with('countTheNumberBlogs', $countBlogInEachTime)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    public function viewListBlogByTag($id, Request $request)
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $countBlogInEachTime = DB::table('blogs')
            ->selectRaw(("date_format(updated_at, '%M %Y') as formatted_updated_at"))
            ->selectRaw('count(*) as number_of_blogs')
            ->groupBy('formatted_updated_at')
            ->take(10)
            ->get();
        $blogs = Blog::join('blog_tag', 'blogs.id', '=', 'blog_tag.blog_id')
            ->join('tags', 'blog_tag.tag_id', '=', 'tags.id')
            ->select('blogs.*')
            ->where('blogs.outdate', '>=', config('timeVarConst.time_now'))
            ->where('tags.id', '=', $id)
            ->latest()
            ->paginate(1);
        $tags = Tag::all();
        return view('user.blog.index', compact(['blogs', 'tags']))
            ->with('menus', $this->menus)
            ->with('countTheNumberBlogs', $countBlogInEachTime)
            ->with('tagId', $id)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    public function viewListBlogByArchive($time, Request $request)
    {
        if (auth()->check()) {
            $this->cartDisplayInform(auth()->user()->id);
        }
        $countBlogInEachTime = DB::table('blogs')
            ->selectRaw(("date_format(updated_at, '%M %Y') as formatted_updated_at"))
            ->selectRaw('count(*) as number_of_blogs')
            ->groupBy('formatted_updated_at')
            ->take(10)
            ->get();
        $blogs = Blog::where('outdate', '>=', config('timeVarConst.time_now'))
            ->where(DB::raw("(DATE_FORMAT(updated_at,'%M %Y'))"), $time)
            ->latest()
            ->paginate(1);
        $tags = Tag::all();
        return view('user.blog.blog-archive', compact(['blogs', 'tags']))
            ->with('menus', $this->menus)
            ->with('countTheNumberBlogs', $countBlogInEachTime)
            ->with('tagId', null)
            ->with('cart', $this->cartOfUser)
            ->with('totalPrice', $this->totalPriceOfAllProductInCart)
            ->with('countCartProduct', $this->countCartItem);
    }
    public function loadCommentBlog(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('comments')
                    ->where('id', '<', $request->id)
                    ->where('commentable_type', '=', Blog::class)
                    ->where('commentable_id', '=', $request->blog_id)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->get();
            } else {
                $data = DB::table('comments')
                    ->where('commentable_type', '=', Blog::class)
                    ->where('commentable_id', '=', $request->blog_id)
                    ->orderBy('id', 'DESC')
                    ->limit(1)
                    ->get();
            }
            $output = '';
            $lastId = '';
            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $user = DB::table('users')->whereId($row->user_id)->first();
                    $output .= '
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 user_blog_comments-image">
                        <img src="' . asset($user->avatar) . '" alt="AVATAR">
                    </div>
                    <div class="size-207 mt-4" style="border-bottom-style: ridge;
                    margin-top: 10px;">
                        <div class="flex-w flex-sb-m p-b-17">
                            <span class="mtext-107 cl2 p-r-20">
                                ' . $user->name . '
                            </span>
                
                            <span class="fs-18 cl11">
                                ' . config('timeVarConst.time_now')->diffForHumans($row->updated_at) . '
                            </span>
                        </div>
                
                        <p class="stext-102 cl6">
                            ' . $row->comment_content . '
                        </p>
                    </div>';
                    $lastId = $row->id;
                }
                $output .= '
            <div class="text-center" style="width: 100%">
                <button class="buton-blog_loadmore stext-101 size-125  bor2 hov-btn3 mt-5" data-id ="' . $lastId . '">
                    + More Comments
                </button>
            </div>';
            } else {
                $output .= '
            <div class="text-center" style="width: 100%">
                <button class=" stext-101 size-125  bor2 hov-btn3 mt-5 ">
                    No Data Found
                </button>
            </div>';
            }
            return response($output);
        }
    }
    public function commentForBlog(Request $request)
    {
        if ($request->ajax()) {
            $blog = Blog::find($request->blogId);
            $comment = new Comment();
            $comment->comment_content = $request->commentContent;
            $comment->user_id = $request->userid;
            $blog->comments()->save($comment);
            $user = $comment->user;
            $output = '';
            $output .= '
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6 user_blog_comments-image">
                <img src="' . asset($user->avatar) . '" alt="AVATAR">
            </div>
            <div class="size-207 mt-4" style="border-bottom-style: ridge;
            margin-top: 10px;">
                <div class="flex-w flex-sb-m p-b-17">
                    <span class="mtext-107 cl2 p-r-20">
                        ' . $user->name . '
                    </span>
        
                    <span class="fs-18 cl11">
                        ' . $comment->time_comment . '
                    </span>
                </div>
        
                <p class="stext-102 cl6">
                    ' . $comment->comment_content . '
                </p>
            </div>';
            return response($output);
        }
    }
}
