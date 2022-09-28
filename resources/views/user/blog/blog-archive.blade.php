@section('title', 'Blog')
@include('layouts.user.header')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"
    style="background-image: url({{ asset('/images/user/bg-02.jpg') }});">
    <h2 class="ltext-105 cl0 txt-center">
        Blog
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9 p-b-80">
                <div class="p-r-45 p-r-0-lg">
                    <div id="blog-data">
                        @include('user.blog.item-blog')
                    </div>
                    <input type="hidden" id="hidden_page" value="1" />
                    <input type="hidden" id="hidden_tag" value="{{$tagId}}">
                </div>
                
            </div>
            <div class="col-md-4 col-lg-3 p-b-80">
                <div class="side-menu">
                    <div class="bor17 of-hidden pos-relative">
                        <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55 blogSearch" type="text"
                            name="keyword" placeholder="Search">

                        <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </div>
                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Categories
                        </h4>

                        <ul>
                            @foreach ($tags as $tag)
                                <li class="bor18">
                                    <a href="{{ route('selectBlogByTag', ['id' => $tag->id]) }}"
                                        class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4 tag-selection">
                                        {{ $tag->tag_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="p-t-55">
                        <h4 class="mtext-112 cl2 p-b-20">
                            Archive
                        </h4>

                        <ul>
                            <li class="p-b-7">
                                @foreach ($countTheNumberBlogs as $item)
                                    <a href="{{ route('selectBlogByArchive', ['time' => $item->formatted_updated_at]) }}"
                                        class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2 blog-time_selection">
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
                    <div class="p-t-50">
                        <h4 class="mtext-112 cl2 p-b-27">
                            Tags
                        </h4>
                        <div class="flex-w m-r--5">
                            @foreach ($tags as $tag)
                                <a href="{{ route('selectBlogByTag', ['id' => $tag->id]) }}"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 tag-selection">
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
