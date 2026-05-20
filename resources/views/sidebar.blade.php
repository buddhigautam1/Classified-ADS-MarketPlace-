<div class="card profile-sidebar">
    <div class="card-body text-center">
        @if(!auth()->user()->avatar)
            <img class="seller-avatar mx-auto d-block" src="/img/man.jpg" alt="{{ auth()->user()->name }}">
        @endif
        @if(auth()->user()->avatar && !auth()->user()->fb_id)
            <img class="seller-avatar mx-auto d-block" src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
        @endif
        @if(auth()->user()->fb_id)
            <img class="seller-avatar mx-auto d-block" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
        @endif
        <p class="mt-3 mb-0"><b>{{ auth()->user()->name }}</b></p>
    </div>
    <hr class="my-0">
    <div class="vertical-menu">
        <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-tasks"></i> Dashboard</a>
        <a href="{{ route('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}"><i class="fas fa-user"></i> Profile</a>
        <a href="{{ route('ads.create') }}" class="{{ request()->is('ads/create') ? 'active' : '' }}"><i class="fas fa-cloud-upload-alt"></i> Create ad</a>
        <a href="{{ route('ads.index') }}" class="{{ request()->is('ads') ? 'active' : '' }}"><i class="fas fa-images"></i> Published ads</a>
        <a href="{{ route('pending.ad') }}" class="{{ request()->is('ad-pending') ? 'active' : '' }}"><i class="fas fa-ban"></i> Pending ads</a>
        <a href="{{ route('saved.ad') }}" class="{{ request()->is('saved-ads') ? 'active' : '' }}"><i class="fas fa-heart"></i> Saved ads</a>
        <a href="{{ route('messages') }}" class="{{ request()->is('messages') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Messages</a>
    </div>
</div>