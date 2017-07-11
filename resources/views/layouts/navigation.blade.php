<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li id="dashboard">
    <a href="{{Help::url('dashboard')}}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  @if (Auth::user()->type == 'admin')
    <li id="a-users">
      <a href="{{Help::url('users')}}">
        <i class="fa fa-users"></i> <span>Users</span>
      </a>
    </li>
    <li id="a-packages">
      <a href="{{Help::url('packages')}}">
        <i class="fa fa-cloud"></i> <span>Packages</span>
      </a>
    </li>
    <li id="a-payments">
      <a href="{{Help::url('payments')}}">
        <i class="fa fa-money"></i> <span>Payments</span>
      </a>
    </li>
  @elseif (Auth::user()->type == 'kost_owner')

    <li id="k-house">
      <a href="{{Help::url('house-room')}}">
        <i class="fa fa-building"></i> <span>House & Rooms</span>
      </a>
    </li>
    <li id="k-members">
      <a href="{{Help::url('members')}}">
        <i class="fa fa-users"></i> <span>Kost Members</span>
      </a>
    </li>
    <li id="k-payments">
      <a href="{{Help::url('payments')}}">
        <i class="fa fa-money"></i> <span>Payments</span>
      </a>
    </li>
    <li id="k-report">
      <a href="{{Help::url('reports')}}">
        <i class="fa fa-bug"></i> <span>Reports</span>
      </a>
    </li>
    <li id="k-banks">
      <a href="{{Help::url('bank')}}">
        <i class="fa fa-bank"></i> <span>Banks</span>
      </a>
    </li>
    <li class="header">SYSTEM</li>
    <li id="k-packages">
      <a href="{{Help::url('packages')}}">
        <i class="fa fa-cloud"></i> <span>Packages</span>
      </a>
    </li>
    <li id="k-bill">
      <a href="{{Help::url('bills')}}">
        <i class="fa fa-paper-plane"></i> <span>Bills</span>
      </a>
    </li>
  @elseif(Auth::user()->type == 'tenant')
    <li id="t-bill">
      <a href="{{Help::url('billings')}}">
        <i class="fa fa-paper-plane"></i> <span>Bills</span>
      </a>
    </li>
    <li id="t-report">
      <a href="{{Help::url('reports')}}">
        <i class="fa fa-bug"></i> <span>Reports</span>
      </a>
    </li>
  @endif
</ul>
