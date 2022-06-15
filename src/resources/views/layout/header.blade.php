<div class="header">
    <div class="main-title">
        <a href="{{route('posts.home')}}">
            <div class="header-first-letter">Y</div>et Another Generic News Board
        </a>
    </div>
    <div class="main-menu"> 
        Likes | Comments 
        @auth
            <a href="{{route('posts.new')}}">| New...</a> 
        @endauth
    </div>
    <div class="auth-box">
        @guest
            <a href="{{route('auth.page')}}">Login/Register</a>
        @endguest
        @auth
            {{auth()->user()->name}} | 
            <form action="{{route('auth.logout')}}" method="POST">
                @csrf
                <button class="link-button" type="submit">Logout</button>
            </form>
        @endauth
    </div>
</div>