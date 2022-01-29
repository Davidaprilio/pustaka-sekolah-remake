<div class="aside-menu flex-column-fluid">
  <!--begin::Aside Menu-->
  <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
    data-kt-scroll-offset="0">
    <!--begin::Menu-->
    <div
      class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
      id="#kt_aside_menu" data-kt-menu="true">
      <div class="menu-item">
        <div class="menu-content pb-2">
          <span class="menu-section text-muted text-uppercase fs-8 ls-1">Dashboard</span>
        </div>
      </div>
      <div class="menu-item">
        <a class="menu-link active" href="../../demo1/dist/index.html">
          <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
            <span class="svg-icon svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Default</span>
        </a>
      </div>
      <div class="menu-item">
        <a class="menu-link" href="{{ route('book.index') }}">
          <span class="menu-icon">
            <i class="fa fa-book svg-icon svg-icon-2"></i>
          </span>
          <span class="menu-title">Buku</span>
        </a>
      </div>
      <div class="menu-item">
        <a class="menu-link" href="{{ route('pustaka.activity') }}">
          <span class="menu-icon">
            <i class="fa fa-chart-line svg-icon svg-icon-2"></i>
          </span>
          <span class="menu-title">Aktivitas</span>
        </a>
      </div>
      <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
          <span class="menu-section text-muted text-uppercase fs-8 ls-1">Crafted</span>
        </div>
      </div>
      <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <span class="menu-link">
          <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
            <span class="svg-icon svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                  d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                  fill="black" />
                <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="black" />
                <path opacity="0.3"
                  d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                  fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Pages</span>
          <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">
          <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
            <span class="menu-link">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Profile</span>
              <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/overview.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Overview</span>
                </a>
              </div>
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/projects.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Projects</span>
                </a>
              </div>
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/campaigns.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Campaigns</span>
                </a>
              </div>
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/documents.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Documents</span>
                </a>
              </div>
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/connections.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Connections</span>
                </a>
              </div>
              <div class="menu-item">
                <a class="menu-link" href="../../demo1/dist/pages/profile/activity.html">
                  <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                  </span>
                  <span class="menu-title">Activity</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
          <span class="menu-section text-muted text-uppercase fs-8 ls-1">Apps</span>
        </div>
      </div>
      <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
        <span class="menu-link">
          <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
            <span class="svg-icon svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3"
                  d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                  fill="black" />
                <path
                  d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                  fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Customers</span>
          <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
          <div class="menu-item">
            <a class="menu-link" href="../../demo1/dist/apps/customers/getting-started.html">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Getting Started</span>
            </a>
          </div>
          <div class="menu-item">
            <a class="menu-link" href="../../demo1/dist/apps/customers/list.html">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Customer Listing</span>
            </a>
          </div>
          <div class="menu-item">
            <a class="menu-link" href="../../demo1/dist/apps/customers/view.html">
              <span class="menu-bullet">
                <span class="bullet bullet-dot"></span>
              </span>
              <span class="menu-title">Customer Details</span>
            </a>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <div class="menu-content">
          <div class="separator mx-1 my-4"></div>
        </div>
      </div>
      <div class="menu-item">
        <a class="menu-link" href="../../demo1/dist/documentation/getting-started/changelog.html">
          <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
            <span class="svg-icon svg-icon-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                  d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z"
                  fill="black" />
                <path opacity="0.3"
                  d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z"
                  fill="black" />
              </svg>
            </span>
            <!--end::Svg Icon-->
          </span>
          <span class="menu-title">Changelog v8.0.27</span>
        </a>
      </div>
    </div>
    <!--end::Menu-->
  </div>
  <!--end::Aside Menu-->
</div>