<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-2 py-4 px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0"></h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>



    <div class="navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">99+</span>
                    <i class="fas fa-bell fa-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item" href="#">Notification 1</a>
                    <a class="dropdown-item" href="#">Notification 2</a>
                    <a class="dropdown-item" href="#">Notification 3</a>
                </div>
            </li>
            <li class="nav-item dropdown ms-4">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="unseencommentDropdown" role="button"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   @if($unSeenComment->count() !== 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{$unSeenComment->count()}}

                            @if($unSeenComment->count() > 99)
                                +99
                            @endif

                        </span>
                    @endif

                    <i class="fas fa-message fa-lg"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="unseencommentDropdown">
              {{--      @foreach($unSeenComment as $comment)
                        <a class="dropdown-item" href="#"> {{$comment->user->FullName}}</a>
                    @endforeach--}}
                    <a class="dropdown-item" href="#">Comment 1</a>
                    <a class="dropdown-item" href="#">Comment 2</a>
                    <a class="dropdown-item" href="#">Comment 3</a>
                </div>
            </li>
        </ul>
        <div class="ms-auto d-flex justify-content-center align-items-center">

            <div class="me-3">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('admin/images/icons/usa_icon.png')}}" alt="user_profile"
                                 class="rounded-circle" height="25" width="25" loading="lazy"/>
                            <span class="ms-1">English</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="langDropdown">
                            <a class="dropdown-item" href="#">Persian</a>
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">French</a>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="input-group">
                <input class="form-control border-end-0 border" aria-label="search" type="search" value="search" id="example-search-input">
                <span class="input-group-append">
                    <button class="btn btn-outline-dark  border" type="button" style="margin-top: 1px;">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>



        </div>
    </div>
</nav>



{{--      <form class="input-group">
              <label>
                  <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search"
                         style="min-width: 130px;"/>
              </label>
              <span class="input-group-text border-0 d-none d-lg-flex "><i class="fas fa-search"></i></span>
          </form>--}}
