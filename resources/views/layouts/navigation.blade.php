<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu">
                    <em class="icon ni ni-menu"></em>
                </a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    {{ config('app.name') }}</a>
            </div>
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    <a class="nk-news-item" href="#">
                        <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                        <div class="nk-news-text">
                            <p>Welcome to Lost & Found AI - Your Trusted Document Recovery Solution!</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <!-- Navigation Links -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active fw-bold' : '' }}" href="{{ route('admin.users.index') }}">
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('documents.index') ? 'active fw-bold' : '' }}" href="{{ route('documents.index-ai') }}">
                            Lost Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('found_documents.index') ? 'active fw-bold' : '' }}" href="{{ route('found_documents.index') }}">
                            Found Documents
                        </a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="modal" data-bs-target="#lostModal">
                            Report Lost ID
                        </button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reports.index') ? 'active fw-bold' : '' }}" href="{{ route('reports.index') }}">
                            Reports
                        </a>
                    </li>
                    <li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">{{ auth()->user()->role }}</div>
                                    <div class="user-name dropdown-indicator">{{ auth()->user()->name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar"><span>{{ auth()->user()->name[0] }}</span></div>
                                    <div class="user-info"><span class="lead-text">{{ auth()->user()->name }}</span><span
                                            class="sub-text">{{ auth()->user()->email }}</span></div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><em class="icon ni ni-signout"></em><span>Sign
                                                    out</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- <li class="dropdown notification-dropdown me-n1"><a href="#"
                            class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-head"><span
                                    class="sub-title nk-dropdown-title">Notifications</span><a
                                    href="#">Mark All as Read</a></div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to
                                                <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit
                                                    Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to
                                                <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit
                                                    Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">You have requested to
                                                <span>Widthdrawl</span>
                                            </div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                    <div class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon"><em
                                                class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Your <span>Deposit
                                                    Order</span> is placed</div>
                                            <div class="nk-notification-time">2 hrs ago</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-foot center"><a href="#">View All</a></div>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Lost Modal -->
<div class="modal fade" tabindex="-1" id="lostModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                    class="icon ni ni-cross"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Lost Documents (AI)</h5>
                <div class="nk-block">
                    <div class="row gy-gs">
                        <div class="col-md-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">How it works?</h6>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <p>This feature leverages advanced AI algorithms to help you
                                            locate lost documents quickly and efficiently. By analyzing
                                            patterns and utilizing machine learning, our AI can provide
                                            accurate suggestions and improve the chances of recovering
                                            your lost items.</p>
                                        <p>To use this feature, simply upload any relevant information or
                                            images related to the lost document. The AI will process the
                                            data and provide you with potential matches or locations where
                                            the document might be found.</p>
                                        <p>Experience the power of AI in document recovery and increase
                                            your chances of finding lost items with ease.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Get Started</h6>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <form action="{{ route('lost.process') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="type" class="form-label">Type</label>
                                                <select name="type" id="type" class="form-select">
                                                    <option value="">-- select type --</option>
                                                    <option value="lost">Lost</option>
                                                    <option value="found">Found</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="image">Upload Image</label>
                                                <input type="file" class="form-control" id="document" name="document"
                                                    accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- AI Modal End -->