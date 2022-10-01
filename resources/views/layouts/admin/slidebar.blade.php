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
                class="fab fa-blogger-b"></i>Blog</span>
          </h2>
          <div id="flush-colllaspeThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('blog.index') }}">
                    <span>Blogs List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('blog.create') }}">
                    <span>Add Blog</span>
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
                class="fab fa-buromobelexperte"></i>Banner</span>
          </h2>
          <div id="flush-coll23" class="accordion-collapse collapse" aria-labelledby="flush-head23"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.index') }}">
                    <span>Banner Information</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('banner.create') }}">
                    <span>Create Banner</span>
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
                class="fab fa-product-hunt"></i>Product</span>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('product.index') }}">
                    <span>Products List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('product.create') }}">
                    <span>Create Product</span>
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
                class="fas fa-paint-brush"></i>Color</span>
          </h2>
          <div id="flush-collapseSixTeen" class="accordion-collapse collapse" aria-labelledby="flush-headdingSixten"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link"
                    href="
                                          {{ route('color.index') }}">
                    <span>Colors List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('color.create') }}">
                    <span>Create Color</span>
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
                class="fas fa-cut"></i>Size</span>
          </h2>
          <div id="flush-coll17" class="accordion-collapse collapse" aria-labelledby="flush-heading17"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('size.index') }}">
                    <span>Sizes List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('size.create') }}">
                    <span>Create Size</span>
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
                class="fas fa-gift"></i>Order</span>
          </h2>
          <div id="flush-coll19" class="accordion-collapse collapse" aria-labelledby="flush-head19"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('admin.order-check') }}">
                    <span>Order Check</span>
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
                class="fas fa-gift"></i>Coupon</span>
          </h2>
          <div id="flush-coll20" class="accordion-collapse collapse" aria-labelledby="flush-head20"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.index') }}">
                    <span>View Coupon</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('coupon.create') }}">
                    <span>Create A New Coupon Code</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <li class="sidebar-item accordion-item">
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
        </li>
        <li class="sidebar-item accordion-item">
          <h2 class="accordion-header" id="flush-headingTen">
            <span class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen"><i
                class="fas fa-table"></i>Menu</span>
          </h2>
          <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('menu.index') }}">
                    <span>Menu List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('menu.create') }}">
                    <span>Create Menu Item</span>
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
                class="fas fa-list-ul"></i>Category</span>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('category.index') }}">
                    <span>Categories List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('category.create') }}">
                    <span>Create Category</span>
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
                class="fas fa-tags"></i>Tag</span>
          </h2>
          <div id="flush-collapsedEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('tag.index') }}">
                    <span>Tag List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('tag.create') }}">
                    <span>Create Tag</span>
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
                class="fab fa-slideshare"></i>Slider</span>
          </h2>
          <div id="flush-collaspeFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('slider.index') }}">
                    <span>Sliders List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('slider.create') }}">
                    <span>Create Slider</span>
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
                class="fas fa-user-plus"></i>Users</span>
          </h2>
          <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('manage_user.index') }}">
                    <span>Users List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('manage_user.create') }}">
                    <span>Create User</span>
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
                class="fas fa-balance-scale"></i>User
              Role</span>
          </h2>
          <div id="flush-collapsedSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark item-link" href="{{ route('role.index') }}">
                    <span>User Role List</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('role.create') }}">
                    <span>Add User Role</span>
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
                class="fas fa-question"></i>Permission</span>
          </h2>
          <div id="flush-collapsedSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('permission.create') }}">
                    <span>Create Permission</span>
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
                class="fas fa-cog"></i>Contact</span>
          </h2>
          <div id="flush-coll21" class="accordion-collapse collapse" aria-labelledby="flush-head21"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('contact.index') }}">
                    <span>Contact Infor</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('contact.create') }}">
                    <span>Create Contact</span>
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
                class="fas fa-address-book"></i>About</span>
          </h2>
          <div id="flush-coll22" class="accordion-collapse collapse" aria-labelledby="flush-head22"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.index') }}">
                    <span>About Infor</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('about.create') }}">
                    <span>Create About</span>
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
                class="fa fa-credit-card" aria-hidden="true"></i>
              Payment Method</span>
          </h2>
          <div id="flush-coll29" class="accordion-collapse collapse" aria-labelledby="flush-head29"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
              <ul class="sidebar-nav">
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.index') }}">
                    <span>Payment Method Infor</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a class="waves-effect waves-dark sidebar-link item-link" href="{{ route('payment.create') }}">
                    <span>Create Payment Method</span>
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
            <span class="hide-menu">Profile</span>
          </a>
        </li>
        <li class="text-center p-20 upgrade-btn">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <div class="d-grid gap-2">
              <button class="btn d-grid btn-danger text-white">LogOut</button>
            </div>
          </form>

        </li>
      </ul>
    </nav>
    <!-- End Sidebar navigation -->
  </div>
</aside>
