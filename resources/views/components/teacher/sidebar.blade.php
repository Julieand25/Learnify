@props(['active' => 'dashboard'])

<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/learnify-logo.png') }}" alt="Learnify">
        <span>LEARNIFY</span>
    </div>

    <ul class="nav">
        <li @class(['active' => $active === 'dashboard'])>
            <a href="{{ route('teacher.dashboard') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
        </li>
        <li @class(['active' => $active === 'quiz'])>
            <a href="{{ route('teacher.edit-quiz') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Edit Quiz
            </a>
        </li>
        <li @class(['active' => $active === 'my-classes'])>
            <a href="{{ route('teacher.my-classes') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                My Classes
            </a>
        </li>
        <li @class(['active' => $active === 'settings'])>
            <a href="{{ route('teacher.settings') }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
        </li>
    </ul>

    <div class="sidebar-logout">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-modal').style.display='flex';">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
    </div>
</aside>

{{-- Logout confirmation modal --}}
<div id="logout-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.45);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:32px 28px 24px;max-width:320px;width:90%;text-align:center;box-shadow:0 12px 40px rgba(0,0,0,0.2);">
        <div style="width:48px;height:48px;border-radius:50%;background:#fee2e2;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
        </div>
        <p style="font-size:1rem;font-weight:700;color:#1a2b3c;margin-bottom:8px;">Log out?</p>
        <p style="font-size:0.82rem;color:#5a6a7a;margin-bottom:24px;">Are you sure you want to log out of your account?</p>
        <div style="display:flex;gap:10px;">
            <button onclick="document.getElementById('logout-modal').style.display='none';"
                style="flex:1;padding:9px;border-radius:999px;border:1.5px solid #d0e4e8;background:#f0f6f8;color:#5a6a7a;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:600;cursor:pointer;">
                Cancel
            </button>
            <button onclick="document.getElementById('logout-form').submit();"
                style="flex:1;padding:9px;border-radius:999px;border:none;background:#ef4444;color:#fff;font-family:'Poppins',sans-serif;font-size:0.82rem;font-weight:600;cursor:pointer;">
                Log out
            </button>
        </div>
    </div>
</div>
