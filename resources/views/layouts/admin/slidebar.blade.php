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
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-headingThree">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-colllaspeThree" aria-expanded="false" aria-controls="flush-colllaspeThree"><i
                class="fab fa-blogger-b"></i>Tin tức</span>
          </h2>
          <div id="flush-colllaspeThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('blog.index') }}">
                    <span>Danh sách tin tức</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('blog.create') }}">
                    <span>Tạo tin tức</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.index') }}">
                    <span>Danh sách banner</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.create') }}">
                    <span>Tạo banner</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('product.index') }}">
                    <span>Danh sách sản phẩm</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('product.create') }}">
                    <span>Tạo sản phẩm</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link"
                    href="
                                          {{ route('color.index') }}">
                    <span>Danh sách màu sắc</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('color.create') }}">
                    <span>Tạo màu sắc</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-heading17">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-coll17" aria-expanded="false" aria-controls="flush-coll17"><i
                class="fas fa-cut"></i>Quản lý kích thước</span>
          </h2>
          <div id="flush-coll17" class="accordion-collapse collapse" aria-labelledby="flush-heading17"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('size.index') }}">
                    <span>Danh sách kích thước</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('size.create') }}">
                    <span>Tạo kích thước</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('admin.order-check') }}">
                    <span>Duyệt đơn hàng</span>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.index') }}">
                    <span>Danh sách phiếu giảm giá</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.create') }}">
                    <span>Tạo phiếu giảm giá</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('menu.index') }}">
                    <span>Danh sách menu</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('menu.create') }}">
                    <span>Tạo menu</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('category.index') }}">
                    <span>Danh sách danh mục</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('category.create') }}">
                    <span>Tạo danh mục sản phẩm</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('tag.index') }}">
                    <span>Danh sách từ khóa</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('tag.create') }}">
                    <span>Tạo từ khóa</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('slider.index') }}">
                    <span>Danh sách trình chiếu</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('slider.create') }}">
                    <span>Tạo trình chiếu</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('manage_user.index') }}">
                    <span>Danh sách người dùng</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('manage_user.create') }}">
                    <span>Tạo người dùng mới</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('role.index') }}">
                    <span>Danh sách vai trò</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('role.create') }}">
                    <span>Tạo vai trò</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-headingSeven">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapsedSeven" aria-expanded="false" aria-controls="flush-collapsedSeven"><i
                class="fas fa-question"></i>Quản lý quyền</span>
          </h2>
          <div id="flush-collapsedSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('permission.create') }}">
                    <span>Tạo quyền</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                    <span>Cập nhật thôn tin liên hệ</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.index') }}">
                    <span>Thông tin trang về chúng tôi</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.create') }}">
                    <span>Tạo thông tin</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-head29">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-coll29" aria-expanded="false" aria-controls="flush-coll29"><i
                class="fa fa-credit-card" aria-hidden="true"></i>Phương thức thanh toán</span>
          </h2>
          <div id="flush-coll29" class="accordion-collapse collapse" aria-labelledby="flush-head29"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.index') }}">
                    <span>Danh sách phương thức</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.create') }}">
                    <span>Tạo phương thức</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
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
