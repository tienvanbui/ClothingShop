@section('title', 'Blog Detail')
@include('layouts.user.header')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('/images/user/bg-02.jpg') }});">
  <h2 class="ltext-105 cl0 txt-center">
    Blog
  </h2>
</section>
<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-lg-9 p-b-80">
        <div class="p-r-45 p-r-0-lg">
          <div class="wrap-pic-w how-pos5-parent">
            <img src="{{ $blog->thumbnail }}" alt="IMG-BLOG">

            <div class="flex-col-c-m size-123 bg9 how-pos5">
              <span class="ltext-107 cl2 txt-center">
                {{ date('d', strtotime($blog->updated_at)) }}
              </span>

              <span class="stext-109 cl3 txt-center">
                {{ date('M Y', strtotime($blog->updated_at)) }}
              </span>
            </div>
          </div>

          <div class="p-t-32">
            <span class="flex-w flex-m stext-111 cl2 p-b-19">
              <span>
                <span class="cl4">By</span> :{{ $blog->user->username }}
                <span class="cl12 m-l-4 m-r-6">|</span>
              </span>

              <span>
                {{ date('d M,Y', strtotime($blog->updated_at)) }}
                <span class="cl12 m-l-4 m-r-6">|</span>
              </span>

              <span>
                @php
                  $stringTags = '';
                  foreach ($blog->tags as $tagItem) {
                      $stringTags .= "$tagItem->tag_name" . ',';
                  }
                  echo rtrim($stringTags, ',');
                @endphp
              </span>
            </span>

            <h4 class="ltext-109 cl2 p-b-28">
              {{ $blog->blog_name }}
            </h4>

            <p class="stext-117 cl6 p-b-26">
              {!! $blog->blog_content !!}
            </p>
          </div>
          {{-- Tags --}}
          <div class="flex-w flex-t p-t-16">
            <span class="size-216 stext-116 cl8 p-t-4">
              Tags
            </span>
            <div class="flex-w size-217">
              @foreach ($blog->tags as $item)
                <a href="{{ route('selectBlogByTag', ['id' => $item->id]) }}"
                  class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  {{ $item->tag_name }}
                </a>
              @endforeach
            </div>
          </div>
          {{-- User's comments --}}
          <div class="flex-w p-t-60 p-b-40 user_blog-comments"></div>
          <input type="hidden" id="hidden_tagId-blog-page" value="{{ $blog->id }}">
          {{-- Comment --}}
          <div class="p-t-40">
            <h5 class="mtext-113 cl2 p-b-12">
              Leave a Comment
            </h5>

            <p class="stext-107 cl6 p-b-40">
              Your email address will not be published. Required fields are marked *
            </p>
            @auth
              <form method="POST" id="comment-post_with_ajax">
                @csrf
                <div class="bor19 m-b-20">
                  <input class="stext-111 cl2 plh3 size-116 p-lr-18 comment-user_blog" type="text" name="username"
                    placeholder="Name *" value="{{ auth()->user()->name }}" disabled>
                </div>
                <input type="hidden" id="comment-user_id_blog" value="{{ auth()->user()->id }}">
                <div class="bor19 m-b-20">
                  <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15 comment-user_comment" name="cmt_blog"
                    placeholder="Comment..."></textarea>
                </div>

                <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04 buton-post_comment">
                  Post Comment
                </button>
              </form>

            @endauth
            @guest
              <form method="POST" id="comment-post_with_ajax">
                @csrf
                <div class="bor19 m-b-20">
                  <input class="stext-111 cl2 plh3 size-116 p-lr-18 comment-user_blog" type="text" name="username"
                    placeholder="Name *">
                </div>
                <div class="bor19 m-b-20">
                  <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15 comment-user_comment" name="cmt_blog"
                    placeholder="Comment..."></textarea>
                </div>

                <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04 buton-post_comment">
                  Post Comment
                </button>
              </form>

            @endguest
          </div>
        </div>
      </div>

      <div class="col-md-4 col-lg-3 p-b-80">
        <div class="side-menu">
          {{-- Categories --}}
          <div class="p-t-55">
            <h4 class="mtext-112 cl2 p-b-33">
              Categories
            </h4>
            <ul>
              @foreach ($tags as $tag)
                <li class="bor18">
                  <a href="{{ route('selectBlogByTag', ['id' => $tag->id]) }}"
                    class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                    {{ $tag->tag_name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          {{-- Archive --}}
          <div class="p-t-55">
            <h4 class="mtext-112 cl2 p-b-20">
              Archive
            </h4>
            <ul>
              <li class="p-b-7">
                @foreach ($countTheNumberBlogs as $item)
                  <a href="{{ route('selectBlogByArchive', ['time' => $item->formatted_updated_at]) }}"
                    class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2 ">
                    <span>
                      {{ date('M Y', strtotime($item->formatted_updated_at)) }}
                    </span>

                    <span>
                      ({{ $item->number_of_blogs }})
                    </span>
                  </a>
                @endforeach
              </li>
            </ul>
          </div>
          {{-- Tags --}}
          <div class="p-t-50">
            <h4 class="mtext-112 cl2 p-b-27">
              Tags
            </h4>
            <div class="flex-w m-r--5">
              @foreach ($tags as $tag)
                <a href="{{ route('selectBlogByTag', ['id' => $tag->id]) }}"
                  class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                  {{ $tag->tag_name }}
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('layouts.user.footer')
