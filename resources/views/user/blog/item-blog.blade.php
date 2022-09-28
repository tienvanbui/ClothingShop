   <!-- item blog -->
   @foreach ($blogs as $item)
     <div class="p-b-63">
       <a href="{{ route('detail-blog', ['id' => $item->id]) }}" class="hov-img0 how-pos5-parent">
         <img src="{{ asset($item->thumbnail) }}" alt="img-blog">
         <div class="flex-col-c-m size-123 bg9 how-pos5">
           <span class="ltext-107 cl2 txt-center">
             {{ date('d', strtotime($item->updated_at)) }}
           </span>

           <span class="stext-109 cl3 txt-center">
             {{ date('M Y', strtotime($item->updated_at)) }}
           </span>
         </div>
       </a>
       <div class="p-t-32">
         <h4 class="p-b-15">
           <a href="{{ route('detail-blog', ['id' => $item->id]) }}" class="ltext-108 cl2 hov-cl1 trans-04">
             {{ $item->blog_name }}
           </a>
         </h4>
         <p class="stext-117 cl6 overflow-hidden">
           {!! $item->short_introduction !!}
         </p>
         <div class="flex-w flex-sb-m p-t-18">
           <span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
             <span>
               <span class="cl4">By</span>: {{ $item->user->username }}
               <span class="cl12 m-l-4 m-r-6">{!! '|' !!}</span>
             </span>
             <span>
               @php
                 $stringTags = '';
                 foreach ($item->tags as $tagItem) {
                     $stringTags .= "$tagItem->tag_name" . ',';
                 }
                 echo rtrim($stringTags, ',');
               @endphp
             </span>
             <span class="cl12 m-l-4 m-r-6">{!! '|' !!}</span>
             <span>
               {{ $item->comments()->count() . ' ' . 'comments' }}
             </span>
           </span>
           <a href="{{ route('detail-blog', ['id' => $item->id]) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
             Continue Reading
             <i class="fa fa-long-arrow-right m-l-9"></i>
           </a>
         </div>
       </div>
       <!-- Pagination -->
       <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
         {{ $blogs->links('vendor.pagination.user-blog-ui-paginate') }}
       </div>

     </div>
   @endforeach
