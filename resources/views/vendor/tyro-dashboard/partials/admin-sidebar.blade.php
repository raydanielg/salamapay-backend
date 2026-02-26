<button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar" type="button" class="mobile-sidebar-toggle" onclick="toggleSidebar()">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 00.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 00-.75-.75zM2 10a.75.75 0 00.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

@php
  $paymentsOpen = request()->routeIs('tyro-dashboard.payments.*');
  $withdrawalsOpen = request()->routeIs('tyro-dashboard.withdrawals.*');
  $payoutsOpen = request()->routeIs('tyro-dashboard.payouts.*');
  $settingsOpen = request()->routeIs('tyro-dashboard.settings.*') || request()->routeIs('tyro-dashboard.profile');

  $developerOpen = request()->routeIs('tyro-dashboard.developer.*');

  $authUser = auth()->user();
  $isSuperAdmin = false;
  if ($authUser) {
      if (method_exists($authUser, 'tyroRoleSlugs')) {
          $slugs = (array) $authUser->tyroRoleSlugs();
          $isSuperAdmin = in_array('super-admin', $slugs);
      }

      if (!$isSuperAdmin && method_exists($authUser, 'hasRole')) {
          try {
              $isSuperAdmin = (bool) $authUser->hasRole('super-admin');
          } catch (\Throwable $e) {
              $isSuperAdmin = false;
          }
      }
  }
@endphp

 <aside id="sidebar" class="sidebar sidebar-admin" aria-label="Sidenav">
    <div class="sidebar-header" style="height: auto; padding: 2rem 1rem;">
        <div class="sidebar-logo-icon" style="background: none; padding: 0; display: flex; justify-content: center; align-items: center; width: 100%;">
            <img class="brand-logo brand-logo-light" src="{{ asset('salama-pay-logo.png') }}" alt="{{ $branding['app_name'] ?? config('app.name', 'SalamaPay') }}" style="height: 80px; width: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
            <img class="brand-logo brand-logo-dark" src="{{ asset('salama-pay-logo.png') }}" alt="{{ $branding['app_name'] ?? config('app.name', 'SalamaPay') }}" style="height: 80px; width: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
        </div>
    </div>
  <div class="sidebar-nav-container">
      <ul class="sidebar-menu-list">
    <li class="sidebar-section-label" style="color: #6366f1; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 1.5rem; border-bottom: 2px solid #e0e7ff; padding-bottom: 0.25rem; margin-bottom: 1rem;">Super Admin Panel</li>
    <li>
        <a href="{{ route('tyro-dashboard.index') }}#admin-menus" class="sidebar-item-link" style="font-weight: 600;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" style="color: #6366f1;"><path d="M4 6.5C4 5.11929 5.11929 4 6.5 4H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 12C4 10.6193 5.11929 9.5 6.5 9.5H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 17.5C4 16.1193 5.11929 15 6.5 15H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M19 7L21 9L19 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span>Master Control</span>
        </a>
    </li>
          <li>
              <a href="{{ route('tyro-dashboard.index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.index') ? 'active' : '' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M3 11.9896V14.5C3 17.7998 3 19.4497 4.02513 20.4749C5.05025 21.5 6.70017 21.5 10 21.5H14C17.2998 21.5 18.9497 21.5 19.9749 20.4749C21 19.4497 21 17.7998 21 14.5V11.9896C21 10.3083 21 9.46773 20.6441 8.74005C20.2882 8.01237 19.6247 7.49628 18.2976 6.46411L16.2976 4.90855C14.2331 3.30285 13.2009 2.5 12 2.5C10.7991 2.5 9.76689 3.30285 7.70242 4.90855L5.70241 6.46411C4.37533 7.49628 3.71179 8.01237 3.3559 8.74005C3 9.46773 3 10.3083 3 11.9896Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M15.0002 17C14.2007 17.6224 13.1504 18 12.0002 18C10.8499 18 9.79971 17.6224 9.00018 17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                  <span>Overview</span>
              </a>
          </li>
          <li>
              <a href="{{ route('tyro-dashboard.transactions') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.transactions') ? 'active' : '' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M3 6.5C3 4.61438 3 3.67157 3.58579 3.08579C4.17157 2.5 5.11438 2.5 7 2.5H17C18.8856 2.5 19.8284 2.5 20.4142 3.08579C21 3.67157 21 4.61438 21 6.5V17.5C21 19.3856 21 20.3284 20.4142 20.9142C19.8284 21.5 18.8856 21.5 17 21.5H7C5.11438 21.5 4.17157 21.5 3.58579 20.9142C3 20.3284 3 19.3856 3 17.5V6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path><path d="M7 7H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M7 12H17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M7 17H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path></svg>
                  <span>Transactions</span>
              </a>
          </li>
          <li>
              <button type="button" class="sidebar-dropdown-btn {{ $paymentsOpen ? 'open' : '' }}" onclick="toggleDropdown('dropdown-payments')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M2 12C2 8.46252 2 6.69377 3.0528 5.5129C3.22119 5.32403 3.40678 5.14935 3.60746 4.99087C4.86213 4 6.74142 4 10.5 4H13.5C17.2586 4 19.1379 4 20.3925 4.99087C20.5932 5.14935 20.7788 5.32403 20.9472 5.5129C22 6.69377 22 8.46252 22 12C22 15.5375 22 17.3062 20.9472 18.4871C20.7788 18.676 20.5932 18.8506 20.3925 19.0091C19.1379 20 17.2586 20 13.5 20H10.5C6.74142 20 4.86213 20 3.60746 19.0091C3.40678 18.8506 3.22119 18.676 3.0528 18.4871C2 17.3062 2 15.5375 2 12Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M10 16H11.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M14.5 16L18 16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M2 9H22" stroke="currentColor" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                  <span class="flex-1 text-left whitespace-nowrap">Payments</span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sidebar-chevron"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
              </button>
              <ul id="dropdown-payments" class="sidebar-dropdown-list {{ $paymentsOpen ? 'show' : '' }}">
                  <li><a href="{{ route('tyro-dashboard.payments.create') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.payments.create') ? 'active' : '' }}">Create Payment</a></li>
              </ul>
          </li>
          <li>
              <button type="button" class="sidebar-dropdown-btn {{ $withdrawalsOpen ? 'open' : '' }}" onclick="toggleDropdown('dropdown-withdrawals')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M3.50002 10V15C3.50002 17.8284 3.50002 19.2426 4.37869 20.1213C5.25737 21 6.67159 21 9.50002 21H14.5C17.3284 21 18.7427 21 19.6213 20.1213C20.5 19.2426 20.5 17.8284 20.5 15V10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M17 7.50184C17 8.88255 15.8807 9.99997 14.5 9.99997C13.1193 9.99997 12 8.88068 12 7.49997C12 8.88068 10.8807 9.99997 9.50002 9.99997C8.1193 9.99997 7.00002 8.88068 7.00002 7.49997C7.00002 8.88068 5.82655 9.99997 4.37901 9.99997C3.59984 9.99997 2.90008 9.67567 2.42 9.16087C1.59462 8.2758 2.12561 6.97403 2.81448 5.98842L3.20202 5.45851C4.08386 4.2527 4.52478 3.6498 5.16493 3.32494C5.80508 3.00008 6.55201 3.00018 8.04587 3.00038L15.9551 3.00143C17.4485 3.00163 18.1952 3.00173 18.8351 3.32658C19.475 3.65143 19.9158 4.25414 20.7974 5.45957L21.1855 5.99029C21.8744 6.97589 22.4054 8.27766 21.58 9.16273C21.0999 9.67754 20.4002 10.0018 19.621 10.0018C18.1734 10.0018 17 8.88255 17 7.50184Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M14.9971 17C14.3133 17.6072 13.2247 18 11.9985 18C10.7723 18 9.68376 17.6072 9 17" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                  <span class="flex-1 text-left whitespace-nowrap">Withdrawals</span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sidebar-chevron"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
              </button>
              <ul id="dropdown-withdrawals" class="sidebar-dropdown-list {{ $withdrawalsOpen ? 'show' : '' }}">
                  <li><a href="{{ route('tyro-dashboard.withdrawals.requested') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.withdrawals.requested') ? 'active' : '' }}">Requested</a></li>
                  <li><a href="{{ route('tyro-dashboard.withdrawals.pending') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.withdrawals.pending') ? 'active' : '' }}">Pending</a></li>
                  <li><a href="{{ route('tyro-dashboard.withdrawals.approved') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.withdrawals.approved') ? 'active' : '' }}">Approved</a></li>
              </ul>
          </li>
          <li>
              <button type="button" class="sidebar-dropdown-btn {{ $payoutsOpen ? 'open' : '' }}" onclick="toggleDropdown('dropdown-payouts')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M14.4998 14.001C14.4998 15.3817 13.3805 16.501 11.9998 16.501C10.619 16.501 9.49976 15.3817 9.49976 14.001C9.49976 12.6203 10.619 11.501 11.9998 11.501C13.3805 11.501 14.4998 12.6203 14.4998 14.001Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M8 7.88972C6.88069 7.88442 5.55979 7.75835 3.87798 7.42461C2.92079 7.23467 2 7.94632 2 8.92217V18.9392C2 19.6275 2.47265 20.232 3.1448 20.3802C10.1096 21.9161 11.2491 20.1104 16 20.1104C17.5107 20.1104 18.7361 20.253 19.6762 20.4305C20.7719 20.6375 22 19.7984 22 18.6833V8.90853C22 8.34037 21.6756 7.82599 21.1329 7.6578C20.3228 7.40675 18.9452 7.08767 17 7.00293" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M2 11.001C3.95133 11.001 5.70483 9.40605 5.92901 7.75514M18.5005 7.50098C18.5005 9.54062 20.2655 11.47 22 11.47M22 17.001C20.1009 17.001 18.2601 18.3112 18.102 20.0993M6.00049 20.4971C6.00049 18.2879 4.20963 16.4971 2.00049 16.4971" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M9.5 5.50098C9.5 5.50098 11.2998 3.00098 12 3.00098M14.5 5.50098C14.5 5.50098 12.7002 3.00098 12 3.00098M12 3.00098L12 8.50098" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                  <span class="flex-1 text-left whitespace-nowrap">Payouts</span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sidebar-chevron"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
              </button>
              <ul id="dropdown-payouts" class="sidebar-dropdown-list {{ $payoutsOpen ? 'show' : '' }}">
                  <li><a href="{{ route('tyro-dashboard.payouts.history') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.payouts.history') ? 'active' : '' }}">History</a></li>
                  <li><a href="{{ route('tyro-dashboard.payouts.credentials') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.payouts.credentials') ? 'active' : '' }}">Credentials</a></li>
              </ul>
          </li>
          <li>
              <button type="button" class="sidebar-dropdown-btn {{ $settingsOpen ? 'open' : '' }}" onclick="toggleDropdown('dropdown-settings')">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M21.3175 7.14139L20.8239 6.28479C20.4506 5.63696 20.264 5.31305 19.9464 5.18388C19.6288 5.05472 19.2696 5.15664 18.5513 5.36048L17.3311 5.70418C16.8725 5.80994 16.3913 5.74994 15.9726 5.53479L15.6357 5.34042C15.2766 5.11043 15.0004 4.77133 14.8475 4.37274L14.5136 3.37536C14.294 2.71534 14.1842 2.38533 13.9228 2.19657C13.6615 2.00781 13.3143 2.00781 12.6199 2.00781H11.5051C10.8108 2.00781 10.4636 2.00781 10.2022 2.19657C9.94085 2.38533 9.83106 2.71534 9.61149 3.37536L9.27753 4.37274C9.12465 4.77133 8.84845 5.11043 8.48937 5.34042L8.15249 5.53479C7.73374 5.74994 7.25259 5.80994 6.79398 5.70418L5.57375 5.36048C4.85541 5.15664 4.49625 5.05472 4.17867 5.18388C3.86109 5.31305 3.67445 5.63696 3.30115 6.28479L2.80757 7.14139C2.45766 7.74864 2.2827 8.05227 2.31666 8.37549C2.35061 8.69871 2.58483 8.95918 3.05326 9.48012L4.0843 10.6328C4.3363 10.9518 4.51521 11.5078 4.51521 12.0077C4.51521 12.5078 4.33636 13.0636 4.08433 13.3827L3.05326 14.5354C2.58483 15.0564 2.35062 15.3168 2.31666 15.6401C2.2827 15.9633 2.45766 16.2669 2.80757 16.8741L3.30114 17.7307C3.67443 18.3785 3.86109 18.7025 4.17867 18.8316C4.49625 18.9608 4.85542 18.8589 5.57377 18.655L6.79394 18.3113C7.25263 18.2055 7.73387 18.2656 8.15267 18.4808L8.4895 18.6752C8.84851 18.9052 9.12464 19.2442 9.2775 19.6428L9.61149 20.6403C9.83106 21.3003 9.94085 21.6303 10.2022 21.8191C10.4636 22.0078 10.8108 22.0078 11.5051 22.0078H12.6199C13.3143 22.0078 13.6615 22.0078 13.9228 21.8191C14.1842 21.6303 14.294 21.3003 14.5136 20.6403L14.8476 19.6428C15.0004 19.2442 15.2765 18.9052 15.6356 18.6752L15.9724 18.4808C16.3912 18.2656 16.8724 18.2055 17.3311 18.3113L18.5513 18.655C19.2696 18.8589 19.6288 18.9608 19.9464 18.8316C20.264 18.7025 20.4506 18.3785 20.8239 17.7307L21.3175 16.8741C21.6674 16.2669 21.8423 15.9633 21.8084 15.6401C21.7744 15.3168 21.5402 15.0564 21.0718 14.5354L20.0407 13.3827C19.7887 13.0636 19.6098 12.5078 19.6098 12.0077C19.6098 11.5078 19.7887 10.9518 20.0407 10.6328L21.0718 9.48012C21.5402 8.95918 21.7744 8.69871 21.8084 8.37549C21.8423 8.05227 21.6674 7.74864 21.3175 7.14139Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path><path d="M15 12.0078C15 13.6647 13.6569 15.0078 12 15.0078C10.3431 15.0078 9 13.6647 9 12.0078C9 10.3509 10.3431 9.00781 12 9.00781C13.6569 9.00781 15 10.3509 15 12.0078Z" stroke="currentColor" stroke-width="1.5"></path></svg>
                  <span class="flex-1 text-left whitespace-nowrap">Settings</span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sidebar-chevron"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
              </button>
              <ul id="dropdown-settings" class="sidebar-dropdown-list {{ $settingsOpen ? 'show' : '' }}">
                  <li><a href="{{ route('tyro-dashboard.profile') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.profile') ? 'active' : '' }}">My Profile</a></li>
                  <li><a href="{{ route('tyro-dashboard.settings.2fa') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.settings.2fa') ? 'active' : '' }}">2FA</a></li>
              </ul>
          </li>
      </ul>
      <ul class="sidebar-menu-list mt-5 pt-5 border-t border-gray-200">
          <li class="sidebar-section-label">Management</li>

          @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.users.index'))
              <li>
                  <a href="{{ route('tyro-dashboard.users.index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.users.*') ? 'active' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="8.5" cy="7" r="4" stroke="currentColor" stroke-width="1.5"/><path d="M20 8v6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M23 11h-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                      <span>Users</span>
                  </a>
              </li>
          @endif

          @if($isSuperAdmin)
              @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.roles.index'))
                  <li>
                      <a href="{{ route('tyro-dashboard.roles.index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.roles.*') ? 'active' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                          <span>Roles</span>
                      </a>
                  </li>
              @endif

              @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.privileges.index'))
                  <li>
                      <a href="{{ route('tyro-dashboard.privileges.index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.privileges.*') ? 'active' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M12 2l8 4v6c0 5-3.5 9.5-8 10-4.5-.5-8-5-8-10V6l8-4Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                          <span>Privileges</span>
                      </a>
                  </li>
              @endif

              @php
                  $resourcesIndexUrl = null;
                  if (\Illuminate\Support\Facades\Route::has('tyro-dashboard.resources.index')) {
                      try {
                          $resourcesIndexUrl = route('tyro-dashboard.resources.index');
                      } catch (\Throwable $e) {
                          $resourcesIndexUrl = null;
                      }
                  }
              @endphp

              @if($resourcesIndexUrl)
                  <li>
                      <a href="{{ $resourcesIndexUrl }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.resources.*') ? 'active' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M8 8h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M8 12h8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M8 16h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H8l-2 2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                          <span>Resources</span>
                      </a>
                  </li>
              @endif

              @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.audits.index'))
                  <li>
                      <a href="{{ route('tyro-dashboard.audits.index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.audits.*') ? 'active' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M9 12h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M9 16h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M6 20h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H8l-2 2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                          <span>Audit Logs</span>
                      </a>
                  </li>
              @endif

              @if(config('tyro-dashboard.features.invitation_system', true) && \Illuminate\Support\Facades\Route::has('tyro-dashboard.invitations.admin-index'))
                  <li>
                      <a href="{{ route('tyro-dashboard.invitations.admin-index') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.invitations.*') ? 'active' : '' }}">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M10 13a5 5 0 0 0 7.07 0l1.41-1.41a5 5 0 0 0-7.07-7.07L10 4.93" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 11a5 5 0 0 0-7.07 0L5.52 12.41a5 5 0 0 0 7.07 7.07L14 19.07" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                          <span>Invitations</span>
                      </a>
                  </li>
              @endif
          @endif
      </ul>

      <ul class="sidebar-menu-list mt-5 pt-5 border-t border-gray-200">
          <li class="sidebar-section-label">Tools</li>

          @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.business'))
              <li>
                  <a href="{{ route('tyro-dashboard.business') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.business') ? 'active' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M3.50002 10V15C3.50002 17.8284 3.50002 19.2426 4.37869 20.1213C5.25737 21 6.67159 21 9.50002 21H14.5C17.3284 21 18.7427 21 19.6213 20.1213C20.5 19.2426 20.5 17.8284 20.5 15V10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M17 7.50184C17 8.88255 15.8807 9.99997 14.5 9.99997C13.1193 9.99997 12 8.88068 12 7.49997C12 8.88068 10.8807 9.99997 9.50002 9.99997C8.1193 9.99997 7.00002 8.88068 7.00002 7.49997C7.00002 8.88068 5.82655 9.99997 4.37901 9.99997" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                      <span>Business</span>
                  </a>
              </li>
          @endif

          @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.support'))
              <li>
                  <a href="{{ route('tyro-dashboard.support') }}" class="sidebar-item-link {{ request()->routeIs('tyro-dashboard.support') ? 'active' : '' }}">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle><path d="M9.5 9.5C9.5 8.11929 10.6193 7 12 7C13.3807 7 14.5 8.11929 14.5 9.5C14.5 10.3569 14.0689 11.1131 13.4117 11.5636C12.7283 12.0319 12 12.6716 12 13.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path><path d="M12.0001 17H12.009" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"></path></svg>
                      <span>Support</span>
                  </a>
              </li>
          @endif
      </ul>

      @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.developer.api-keys'))
          <ul class="sidebar-menu-list mt-5 pt-5 border-t border-gray-200">
              <li class="sidebar-section-label">Developer</li>
              <li>
                  <button type="button" class="sidebar-dropdown-btn {{ $developerOpen ? 'open' : '' }}" onclick="toggleDropdown('dropdown-developer')">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor"><path d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z" stroke="currentColor" stroke-width="1.5"></path><path d="M8.5 9.5L6 12L8.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.5 9.5L18 12L15.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13 9L11 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                      <span class="flex-1 text-left whitespace-nowrap">Developer</span>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" color="currentColor" class="sidebar-chevron"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                  </button>
                  <ul id="dropdown-developer" class="sidebar-dropdown-list {{ $developerOpen ? 'show' : '' }}">
                      <li><a href="{{ route('tyro-dashboard.developer.api-keys') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.developer.api-keys') ? 'active' : '' }}">API Keys</a></li>
                      @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.developer.api-configuration'))
                          <li><a href="{{ route('tyro-dashboard.developer.api-configuration') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.developer.api-configuration') ? 'active' : '' }}">API Configuration</a></li>
                      @endif
                      @if(\Illuminate\Support\Facades\Route::has('tyro-dashboard.developer.webhooks'))
                          <li><a href="{{ route('tyro-dashboard.developer.webhooks') }}" class="sidebar-dropdown-item {{ request()->routeIs('tyro-dashboard.developer.webhooks') ? 'active' : '' }}">Webhooks</a></li>
                      @endif
                  </ul>
              </li>
          </ul>
      @endif
  </div>
</aside>
