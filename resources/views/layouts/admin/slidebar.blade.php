<aside class="left-sidebar" data-sidebarbg="skin6">
  <div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
      <ul id="accordionFlushExample" class="accordion-flush">
        <!-- User Profile-->
        <li class="sidebar-item ">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}"
            aria-expanded="false">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="hide-menu">Tổng quan</span>
          </a>
        </li>
        @if (auth()->user()->hasPermission('Blog_list') ||
                auth()->user()->hasPermission('Blog_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-colllaspeThree" aria-expanded="false" aria-controls="flush-colllaspeThree"><i
                  class="fab fa-blogger-b"></i>Quản lý tin tức</span>
            </h2>
            <div id="flush-colllaspeThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Blog_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('blog.index') }}">
                        <span>Danh sách tin tức</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Blog_list'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('blog.create') }}">
                        <span>Tạo tin tức</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Banner_list') ||
                auth()->user()->hasPermission('Banner_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-head23">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll23" aria-expanded="false" aria-controls="flush-coll23"><i
                  class="fab fa-buromobelexperte"></i>Quản lý banner</span>
            </h2>
            <div id="flush-coll23" class="accordion-collapse collapse" aria-labelledby="flush-head23"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Banner_list'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.index') }}">
                        <span>Danh sách banner</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Banner_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.create') }}">
                        <span>Tạo banner</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Product_list') ||
                auth()->user()->hasPermission('Product_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"><i
                  class="fab fa-product-hunt"></i>Quản lý sản phẩm</span>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Product_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('product.index') }}">
                        <span>Danh sách sản phẩm</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Product_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('product.create') }}">
                        <span>Tạo sản phẩm</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Color_list') ||
                auth()->user()->hasPermission('Color_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headdingSixten">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseSixTeen" aria-expanded="false" aria-controls="flush-collapseSixTeen"><i
                  class="fas fa-paint-brush"></i>Quản lý màu sắc</span>
            </h2>
            <div id="flush-collapseSixTeen" class="accordion-collapse collapse" aria-labelledby="flush-headdingSixten"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Color_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link"
                        href="
                                          {{ route('color.index') }}">
                        <span>Danh sách màu sắc</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Color_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('color.create') }}">
                        <span>Tạo màu sắc</span>
                      </a>
                    </li>
                  @endif

                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Size_list') ||
                auth()->user()->hasPermission('Size_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-heading17">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll17" aria-expanded="false" aria-controls="flush-coll17"><i
                  class="fas fa-cut"></i>Quản lý kích cỡ</span>
            </h2>
            <div id="flush-coll17" class="accordion-collapse collapse" aria-labelledby="flush-heading17"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Size_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('size.index') }}">
                        <span>Danh sách kích cỡ</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Size_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('size.create') }}">
                        <span>Tạo kích cỡ</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Order_list'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-head19">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll19" aria-expanded="false" aria-controls="flush-coll19"><i
                  class="fas fa-gift"></i>Quản lý đơn hàng</span>
            </h2>
            <div id="flush-coll19" class="accordion-collapse collapse" aria-labelledby="flush-head19"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Order_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link"
                        href="{{ route('admin.order-check') }}">
                        <span>Duyệt đơn hàng</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Coupon_list') ||
                auth()->user()->hasPermission('Coupon_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-head20">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll20" aria-expanded="false" aria-controls="flush-coll20"><i
                  class="fas fa-gift"></i>Quản lý phiếu giảm giá</span>
            </h2>
            <div id="flush-coll20" class="accordion-collapse collapse" aria-labelledby="flush-head20"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Coupon_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.index') }}">
                        <span>Danh sách phiếu giảm giá</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Coupon_create'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.create') }}">
                        <span>Tạo phiếu giảm giá</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        {{-- <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-head40">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-coll40" aria-expanded="false" aria-controls="flush-head40"><i
                class="fas fa-gift"></i>Sự kiện giảm giá</span>
          </h2>
          <div id="flush-coll40" class="accordion-collapse collapse" aria-labelledby="flush-head40"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('discount.index') }}">
                    <span>Danh sách sự kiện giảm giá</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('discount.create') }}">
                    <span>Tạo sự kiện giảm giá mới</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li> --}}
        {{-- @if (auth()->user()->hasPermission('Menu_list') ||
                auth()->user()->hasPermission('Menu_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingTen">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen"><i
                  class="fas fa-table"></i>Quản lý menu</span>
            </h2>
            <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Menu_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('menu.index') }}">
                        <span>Danh sách menu</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Menu_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('menu.create') }}">
                        <span>Tạo menu</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif --}}
        @if (auth()->user()->hasPermission('Category_list') ||
                auth()->user()->hasPermission('Category_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"><i
                  class="fas fa-list-ul"></i>Quản lý danh mục</span>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Category_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('category.index') }}">
                        <span>Danh sách danh mục</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Category_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link"
                        href="{{ route('category.create') }}">
                        <span>Tạo danh mục sản phẩm</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Tag_list') ||
                auth()->user()->hasPermission('Tag_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingEight">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapsedEight" aria-expanded="false" aria-controls="flush-collapsedEight"><i
                  class="fas fa-tags"></i>Quản lý từ khóa</span>
            </h2>
            <div id="flush-collapsedEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Tag_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('tag.index') }}">
                        <span>Danh sách từ khóa</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Tag_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('tag.create') }}">
                        <span>Tạo từ khóa</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Slider_list') ||
                auth()->user()->hasPermission('Slider_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingFour">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collaspeFour" aria-expanded="false" aria-controls="flush-collaspeFour"><i
                  class="fab fa-slideshare"></i>Quản lý trình chiếu</span>
            </h2>
            <div id="flush-collaspeFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Slider_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('slider.index') }}">
                        <span>Danh sách trình chiếu</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Slider_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('slider.create') }}">
                        <span>Tạo trình chiếu</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('User_list') ||
                auth()->user()->hasPermission('User_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingFive">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive"><i
                  class="fas fa-user-plus"></i>Quản lý người dùng</span>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('User_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link"
                        href="{{ route('manage_user.index') }}">
                        <span>Danh sách người dùng</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('User_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link"
                        href="{{ route('manage_user.create') }}">
                        <span>Tạo người dùng mới</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Role_list') ||
                auth()->user()->hasPermission('Role_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-headingSix">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapsedSix" aria-expanded="false" aria-controls="flush-collapsedSix"><i
                  class="fas fa-balance-scale"></i>Quản lý vai trò</span>
            </h2>
            <div id="flush-collapsedSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Role_list'))
                    <li class="sidebar-item">
                      <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('role.index') }}">
                        <span>Danh sách vai trò</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Role_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('role.create') }}">
                        <span>Tạo vai trò</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-head21">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-coll21" aria-expanded="false" aria-controls="flush-coll21"><i
                class="fas fa-cog"></i>Thông tin liên hệ</span>
          </h2>
          <div id="flush-coll21" class="accordion-collapse collapse" aria-labelledby="flush-head21"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('contact.create') }}">
                    <span>Cập nhật thông tin liên hệ</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        @if (auth()->user()->hasPermission('About_list') ||
                auth()->user()->hasPermission('About_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-head22">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll22" aria-expanded="false" aria-controls="flush-coll22"><i
                  class="fas fa-address-book"></i>Về chúng tôi</span>
            </h2>
            <div id="flush-coll22" class="accordion-collapse collapse" aria-labelledby="flush-head22"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('About_list'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.index') }}">
                        <span>Thông tin về chúng tôi</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('About_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.create') }}">
                        <span>Tạo thông tin</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        @if (auth()->user()->hasPermission('Payment Method_list') ||
                auth()->user()->hasPermission('Payment Method_create'))
          <li class="sidebar-item accordion-item">
            <h2 class="accordion-header" id="flush-head29">
              <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-coll29" aria-expanded="false" aria-controls="flush-coll29"><i
                  class="fa fa-credit-card" aria-hidden="true"></i>Thanh toán</span>
            </h2>
            <div id="flush-coll29" class="accordion-collapse collapse" aria-labelledby="flush-head29"
              data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                <ul class="sidebar-nav">
                  @if (auth()->user()->hasPermission('Payment Method_list'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.index') }}">
                        <span>Danh sách phương thức</span>
                      </a>
                    </li>
                  @endif
                  @if (auth()->user()->hasPermission('Payment Method_create'))
                    <li class="sidebar-item">
                      <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.create') }}">
                        <span>Tạo phương thức</span>
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </li>
        @endif
        <li class="sidebar-item">
          <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('profile.index') }}"
            aria-expanded="false">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span class="hide-menu">Thông tin cá nhân</span>
          </a>
        </li>
        <li class="text-center p-20 upgrade-btn">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <div class="d-grid gap-2">
              <button class="btn d-grid btn-danger text-white">Đăng xuất</button>
            </div>
          </form>

        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
</aside>
