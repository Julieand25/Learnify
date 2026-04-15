@props(['active' => 'dashboard'])

<style>
    .sidebar {
        width: 180px;
        background: #ffffff;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 0 20px;
        flex-shrink: 0;
        box-shadow: 2px 0 12px rgba(0,0,0,0.06);
        z-index: 10;
    }

    .sidebar-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        margin-bottom: 36px;
        padding: 0 16px;
    }

    .sidebar-logo img { width: 44px; height: auto; }

    .sidebar-logo span {
        font-size: 0.78rem;
        font-weight: 800;
        color: #1c3d6b;
        letter-spacing: 2px;
    }

    .nav {
        list-style: none;
        width: 100%;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 0 12px;
    }

    .nav li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        color: #5a6a7a;
        transition: background 0.2s, color 0.2s;
        white-space: nowrap;
    }

    .nav li a:hover { background: #dff4f2; color: #2e8b84; }
    .nav li.active a { background: #dff4f2; color: #2e8b84; font-weight: 600; }
    .nav li a .icon { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.7; }
    .nav li.active a .icon { opacity: 1; }

    .sidebar-logout { width: calc(100% - 24px); margin: 0 12px; }

    .sidebar-logout a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 14px;
        border-radius: 10px;
        background: #1c3d6b;
        color: #fff;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
        transition: opacity 0.2s;
        white-space: nowrap;
    }

    .sidebar-logout a:hover { opacity: 0.85; }
</style>

<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify">
        <span>LEARNIFY</span>
    </div>

    <ul class="nav">
        <li @class(['active' => $active === 'dashboard'])>
            <a href="{{ route('student.dashboard') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
        </li>
        <li @class(['active' => $active === 'learning-module'])>
            <a href="{{ route('student.learning-module') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Learning Module
            </a>
        </li>
        <li @class(['active' => $active === 'quiz'])>
            <a href="{{ route('student.quiz') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Quiz
            </a>
        </li>
        <li @class(['active' => $active === 'settings'])>
            <a href="#">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
        </li>
    </ul>

    <div class="sidebar-logout">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>
</aside>
