<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
        @php
            $unread_messages = \App\Models\MailMessages::latest()->where('is_read', 0)->get();
            $unread_subscribers = \App\Models\Subscribers::latest()->where('is_read', 0)->get();
        @endphp
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ count($unread_messages) }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('message.index') }}" class="dropdown-item">
            <!-- Message Start -->
                @foreach ($unread_messages as $message)
                    <div class="media">
                        <div class="media-body">
                            <h2 class="dropdown-item-title">
                                {{ $message->name }}
                            </h2>
                            <p class="text-sm">{{ substr($message->message, 0 , 50) }}..</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $message->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @if (count($unread_messages) == 0)
            <a href="#" class="dropdown-item dropdown-footer">No new Messages</a>
          @else
            <a href="{{ route('message.index') }}" class="dropdown-item dropdown-footer">See All Messages</a>
          @endif
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">
            @if (count($unread_subscribers) > 0)
                1
            @else
                0
            @endif
        </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="{{ route('subscribers.index') }}" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> {{ count($unread_subscribers) }} new Subscribers
            </a>
            <div class="dropdown-divider"></div>
          <a href="{{ route('subscribers.index') }}" class="dropdown-item dropdown-footer">See All Subscribers</a>
        </div>
      </li>

      <li>
        <a class="nav-link" href="https://cakkailali.org.np/" target="_blank">
          <i class="fas fa-globe"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">{{ Auth::user()->name }}</a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">Manage Account</span>
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->
