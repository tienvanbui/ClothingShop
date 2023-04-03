@if (!$products->isEmpty())
    <input type="hidden" name="product_category_name" value="">
    @foreach ($products as $item)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ asset($item->product_image) }}" alt="{{ $item->product_image_name }}">
                    <form method="POST">
                        @csrf
                        <button
                            class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 qickView-product"
                            data-product_id="{{ $item->id }}'">
                            Xem nhanh
                        </button>
                    </form>

                </div>
                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l ">
                        <a href="{{ route('shop.show', ['product' => $item->id]) }}"
                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $item->product_name }}
                        </a>

                        <span class="stext-105 cl3">
                            {{ number_format($item->price ).'VNĐ' }}
                        </span>
                    </div>
                    <form method="POST">
                        @csrf
                        <input type="text" class="d-none" value="{{ $item->id }}" name="product_id">
                        <input type="number" class="d-none" value="1" name="isLove">
                        <div class="block2-txt-child2 flex-r p-t-3">
                            <button type="submit" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <img class="icon-heart1 dis-block trans-04"
                                    src="{{ asset('/images/user/icons/icon-heart-01.png') }}" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                    src="{{ asset('/images/user/icons/icon-heart-02.png') }}" alt="ICON">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <div class="flex-c-m flex-w w-full p-t-45">
        <form method="POST">
            @csrf
            <button
                class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 loadMoreButton-product_user_filter" data-product_id="{{$item->id}}">
                Hiển thị nhiều hơn
            </button>
        </form>
    </div>
@else
    <div class="flex-c-m flex-w w-full">
        <button class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 ">
            Không có dữ liệu
        </button>
    </div>
@endif
