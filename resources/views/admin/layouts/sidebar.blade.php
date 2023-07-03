      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo text-white fw-bold" href="{{ url('/') }}">
                Ogani
            </a>
            <a class="sidebar-brand brand-logo-mini text-white fw-bold" href="{{ url('/') }}">
                O
            </a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{ asset(url(auth()->user()->profile_photo)) }}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                </div>
              </div>

            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#product_category_list" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">{{ __('Product Categories') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product_category_list">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/admin/product-categories') }}">{{ __('Category List') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('admin/product-categories/create') }}">{{ __('Create new Category') }}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#product_list" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">{{ __('Products') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product_list">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Product List') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Create new Product') }}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#blog_category_list" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">{{ __('Blog Categories') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog_category_list">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Blog List') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Create new Blog') }}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#blog_list" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
              <span class="menu-title">{{ __('Blog List') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog_list">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Blog List') }}</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">{{ __('Create new Blog') }}</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('admin/profile/') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">{{ __('Profile') }}</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('admin/contact-list/') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">{{ __('Contact List') }}</span>
            </a>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('admin/settings/') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">{{ __('Settings') }}</span>
            </a>
          </li>

        </ul>
      </nav>
      <!-- partial -->
