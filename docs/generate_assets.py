import os

images_dir = "/home/imran/project/new/online-tutoring-marketplace-booking-and-live-classes/docs/images"
os.makedirs(images_dir, exist_ok=True)

# 1. Hero Banner SVG
hero_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 500" width="1200" height="500">
  <defs>
    <linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#090D16" />
      <stop offset="50%" stop-color="#0F172A" />
      <stop offset="100%" stop-color="#050811" />
    </linearGradient>
    <linearGradient id="primaryGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#6366F1" />
      <stop offset="50%" stop-color="#8B5CF6" />
      <stop offset="100%" stop-color="#EC4899" />
    </linearGradient>
    <linearGradient id="cardGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" stop-opacity="0.85" />
      <stop offset="100%" stop-color="#0F172A" stop-opacity="0.95" />
    </linearGradient>
    <linearGradient id="accentCyan" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#06B6D4" />
      <stop offset="100%" stop-color="#3B82F6" />
    </linearGradient>
    <linearGradient id="accentGreen" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#10B981" />
      <stop offset="100%" stop-color="#059669" />
    </linearGradient>
    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
      <feGaussianBlur stdDeviation="60" result="blur" />
    </filter>
    <filter id="shadow" x="-5%" y="-5%" width="110%" height="110%">
      <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="#000000" flood-opacity="0.5" />
    </filter>
  </defs>

  <!-- Background Base -->
  <rect width="1200" height="500" fill="url(#bg)" />

  <!-- Ambient Light Orbs -->
  <circle cx="200" cy="80" r="140" fill="#4F46E5" opacity="0.25" filter="url(#glow)" />
  <circle cx="1000" cy="180" r="180" fill="#EC4899" opacity="0.18" filter="url(#glow)" />
  <circle cx="600" cy="420" r="160" fill="#06B6D4" opacity="0.15" filter="url(#glow)" />

  <!-- Grid Pattern Overlay -->
  <g opacity="0.08" stroke="#FFFFFF" stroke-width="1">
    <line x1="0" y1="50" x2="1200" y2="50" />
    <line x1="0" y1="100" x2="1200" y2="100" />
    <line x1="0" y1="150" x2="1200" y2="150" />
    <line x1="0" y1="200" x2="1200" y2="200" />
    <line x1="0" y1="250" x2="1200" y2="250" />
    <line x1="0" y1="300" x2="1200" y2="300" />
    <line x1="0" y1="350" x2="1200" y2="350" />
    <line x1="0" y1="400" x2="1200" y2="400" />
    <line x1="0" y1="450" x2="1200" y2="450" />
    <line x1="100" y1="0" x2="100" y2="500" />
    <line x1="200" y1="0" x2="200" y2="500" />
    <line x1="300" y1="0" x2="300" y2="500" />
    <line x1="400" y1="0" x2="400" y2="500" />
    <line x1="500" y1="0" x2="500" y2="500" />
    <line x1="600" y1="0" x2="600" y2="500" />
    <line x1="700" y1="0" x2="700" y2="500" />
    <line x1="800" y1="0" x2="800" y2="500" />
    <line x1="900" y1="0" x2="900" y2="500" />
    <line x1="1000" y1="0" x2="1000" y2="500" />
    <line x1="1100" y1="0" x2="1100" y2="500" />
  </g>

  <!-- Top Pill / Status Tag -->
  <g transform="translate(60, 48)">
    <rect width="320" height="32" rx="16" fill="#1E293B" stroke="#334155" stroke-width="1" />
    <circle cx="16" cy="16" r="5" fill="#10B981" />
    <text x="32" y="21" fill="#94A3B8" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="12" font-weight="600" letter-spacing="0.5">THE ULTIMATE EDTECH MONOLITH 2026</text>
  </g>

  <!-- Main Headline -->
  <text x="60" y="130" fill="#FFFFFF" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="44" font-weight="800" letter-spacing="-1">
    EduFlow OS™
  </text>
  <text x="60" y="174" fill="url(#primaryGrad)" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="34" font-weight="700" letter-spacing="-0.5">
    Online Tutoring Marketplace &amp; Institutional Live Learning
  </text>

  <!-- Subtitle -->
  <text x="60" y="216" fill="#94A3B8" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="16" font-weight="400">
    Built with PHP 8.3+, Laravel 11.57 &amp; Filament v3.3. Featuring 50 Plug-and-Play Modules, 11 Dedicated Role Panels,
  </text>
  <text x="60" y="240" fill="#94A3B8" font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif" font-size="16" font-weight="400">
    Zero-Latency WebRTC Whiteboard, Biometric Turnstiles, Escrow Wallets, and Multi-LLM AI Gateway.
  </text>

  <!-- Tech Badges Row -->
  <g transform="translate(60, 268)">
    <!-- Badge 1 -->
    <g transform="translate(0, 0)">
      <rect width="135" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#E2E8F0" font-family="sans-serif" font-size="12" font-weight="600">⚡ Laravel 11.57</text>
    </g>
    <!-- Badge 2 -->
    <g transform="translate(145, 0)">
      <rect width="135" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#F59E0B" font-family="sans-serif" font-size="12" font-weight="600">💎 Filament v3.3</text>
    </g>
    <!-- Badge 3 -->
    <g transform="translate(290, 0)">
      <rect width="145" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#38BDF8" font-family="sans-serif" font-size="12" font-weight="600">🧩 50 Core Modules</text>
    </g>
    <!-- Badge 4 -->
    <g transform="translate(445, 0)">
      <rect width="145" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#A855F7" font-family="sans-serif" font-size="12" font-weight="600">👥 11 Role Panels</text>
    </g>
    <!-- Badge 5 -->
    <g transform="translate(600, 0)">
      <rect width="165" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#10B981" font-family="sans-serif" font-size="12" font-weight="600">📹 WebRTC Classroom</text>
    </g>
    <!-- Badge 6 -->
    <g transform="translate(775, 0)">
      <rect width="165" height="30" rx="6" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="12" y="19" fill="#EC4899" font-family="sans-serif" font-size="12" font-weight="600">🤖 Multi-LLM AI Hub</text>
    </g>
  </g>

  <!-- 4 Feature Highlight Cards at the bottom -->
  <g transform="translate(60, 328)">
    <!-- Card 1 -->
    <g transform="translate(0, 0)" filter="url(#shadow)">
      <rect width="250" height="130" rx="12" fill="url(#cardGrad)" stroke="#334155" stroke-width="1.5" />
      <circle cx="36" cy="36" r="18" fill="#4F46E5" fill-opacity="0.2" stroke="#6366F1" stroke-width="1.5" />
      <text x="36" y="41" text-anchor="middle" fill="#818CF8" font-size="16">🚀</text>
      <text x="64" y="34" fill="#F8FAFC" font-family="sans-serif" font-size="14" font-weight="700">Turnkey Velocity</text>
      <text x="64" y="52" fill="#38BDF8" font-family="sans-serif" font-size="12" font-weight="600">Saves 9-12 Mo &amp; $120k</text>
      <text x="20" y="84" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Replace 8 fragmented SaaS tools.</text>
      <text x="20" y="104" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Deploy and monetize in 5 mins.</text>
    </g>

    <!-- Card 2 -->
    <g transform="translate(275, 0)" filter="url(#shadow)">
      <rect width="250" height="130" rx="12" fill="url(#cardGrad)" stroke="#334155" stroke-width="1.5" />
      <circle cx="36" cy="36" r="18" fill="#059669" fill-opacity="0.2" stroke="#10B981" stroke-width="1.5" />
      <text x="36" y="41" text-anchor="middle" fill="#34D399" font-size="16">💳</text>
      <text x="64" y="34" fill="#F8FAFC" font-family="sans-serif" font-size="14" font-weight="700">Fintech &amp; Escrow</text>
      <text x="64" y="52" fill="#34D399" font-family="sans-serif" font-size="12" font-weight="600">Zero Payment Disputes</text>
      <text x="20" y="84" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Automated tutor commission splits,</text>
      <text x="20" y="104" fill="#94A3B8" font-family="sans-serif" font-size="11.5">multi-currency wallets &amp; tax PDFs.</text>
    </g>

    <!-- Card 3 -->
    <g transform="translate(550, 0)" filter="url(#shadow)">
      <rect width="250" height="130" rx="12" fill="url(#cardGrad)" stroke="#334155" stroke-width="1.5" />
      <circle cx="36" cy="36" r="18" fill="#D97706" fill-opacity="0.2" stroke="#F59E0B" stroke-width="1.5" />
      <text x="36" y="41" text-anchor="middle" fill="#FBBF24" font-size="16">🏢</text>
      <text x="64" y="34" fill="#F8FAFC" font-family="sans-serif" font-size="14" font-weight="700">Multi-Branch Campus</text>
      <text x="64" y="52" fill="#FBBF24" font-family="sans-serif" font-size="12" font-weight="600">Physical + Online Hybrid</text>
      <text x="20" y="84" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Biometric RFID turnstiles synced</text>
      <text x="20" y="104" fill="#94A3B8" font-family="sans-serif" font-size="11.5">directly to live class attendances.</text>
    </g>

    <!-- Card 4 -->
    <g transform="translate(825, 0)" filter="url(#shadow)">
      <rect width="250" height="130" rx="12" fill="url(#cardGrad)" stroke="#334155" stroke-width="1.5" />
      <circle cx="36" cy="36" r="18" fill="#7C3AED" fill-opacity="0.2" stroke="#8B5CF6" stroke-width="1.5" />
      <text x="36" y="41" text-anchor="middle" fill="#C084FC" font-size="16">🧠</text>
      <text x="64" y="34" fill="#F8FAFC" font-family="sans-serif" font-size="14" font-weight="700">Autonomous AI Hub</text>
      <text x="64" y="52" fill="#C084FC" font-family="sans-serif" font-size="12" font-weight="600">Multi-Provider Failover</text>
      <text x="20" y="84" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Auto quiz generation, 24/7 AI</text>
      <text x="20" y="104" fill="#94A3B8" font-family="sans-serif" font-size="11.5">tutor assistant &amp; syllabus parsing.</text>
    </g>
  </g>
</svg>'''

with open(os.path.join(images_dir, "hero-banner.svg"), "w") as f:
    f.write(hero_svg)

print("Created hero-banner.svg")

admin_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 700" width="1200" height="700">
  <defs>
    <linearGradient id="adminBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0F172A" />
      <stop offset="100%" stop-color="#020617" />
    </linearGradient>
    <linearGradient id="sidebarGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#0F172A" />
    </linearGradient>
    <linearGradient id="cardGradDark" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#141E33" />
    </linearGradient>
    <linearGradient id="chartGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#6366F1" stop-opacity="0.5" />
      <stop offset="100%" stop-color="#6366F1" stop-opacity="0.0" />
    </linearGradient>
    <filter id="shadowSm">
      <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#000000" flood-opacity="0.4" />
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1200" height="700" fill="url(#adminBg)" />

  <!-- TOP HEADER BAR -->
  <rect width="1200" height="60" fill="#1E293B" stroke="#334155" stroke-width="1" />
  
  <!-- Logo & Title -->
  <rect x="20" y="14" width="32" height="32" rx="8" fill="#6366F1" />
  <text x="36" y="36" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="18" font-weight="900">E</text>
  <text x="64" y="35" fill="#FFFFFF" font-family="sans-serif" font-size="17" font-weight="700">EduFlow<tspan fill="#818CF8">OS</tspan></text>
  <rect x="156" y="19" width="56" height="22" rx="11" fill="#312E81" />
  <text x="184" y="34" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="11" font-weight="600">v3.3</text>

  <!-- Campus Selector Dropdown -->
  <g transform="translate(240, 14)">
    <rect width="210" height="32" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
    <circle cx="16" cy="16" r="4" fill="#10B981" />
    <text x="28" y="21" fill="#E2E8F0" font-family="sans-serif" font-size="12" font-weight="500">Global Campus (Main HQ) ▾</text>
  </g>

  <!-- APM Health Live Metric Pill -->
  <g transform="translate(470, 14)">
    <rect width="250" height="32" rx="16" fill="#064E3B" stroke="#059669" stroke-width="1" />
    <circle cx="18" cy="16" r="4.5" fill="#34D399" />
    <text x="32" y="21" fill="#A7F3D0" font-family="sans-serif" font-size="11.5" font-weight="600">⚡ Drutogoti APM: 18ms | 0 Slow Q</text>
  </g>

  <!-- Global Search Bar -->
  <g transform="translate(740, 14)">
    <rect width="240" height="32" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
    <text x="14" y="21" fill="#64748B" font-family="sans-serif" font-size="12">🔍 Search tutors, sessions, invoices...</text>
  </g>

  <!-- User Profile Header -->
  <g transform="translate(1000, 12)">
    <circle cx="22" cy="18" r="16" fill="#4F46E5" />
    <text x="22" y="23" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="12" font-weight="700">IA</text>
    <text x="48" y="19" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="600">Imran Ahmed</text>
    <text x="48" y="32" fill="#94A3B8" font-family="sans-serif" font-size="11">Super Administrator</text>
  </g>

  <!-- SIDEBAR (LEFT) -->
  <rect x="0" y="60" width="220" height="640" fill="url(#sidebarGrad)" stroke="#334155" stroke-width="1" />

  <!-- Navigation Items -->
  <g transform="translate(15, 80)">
    <!-- Active Item: Dashboard -->
    <rect width="190" height="34" rx="6" fill="#4F46E5" />
    <text x="14" y="22" fill="#FFFFFF" font-family="sans-serif" font-size="13" font-weight="600">📊  Business Dashboard</text>

    <!-- Nav group 1 -->
    <text x="10" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700" letter-spacing="0.5">MARKETPLACE &amp; CORE</text>
    <text x="14" y="88" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🧩  Module Center (50)</text>
    <text x="14" y="118" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🪄  Setup Wizard</text>
    <text x="14" y="148" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">👨‍🏫  Tutors Directory (142)</text>
    <text x="14" y="178" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🎓  Students &amp; Parents</text>
    <text x="14" y="208" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📅  Bookings &amp; Timetable</text>

    <!-- Nav group 2 -->
    <text x="10" y="246" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700" letter-spacing="0.5">LIVE LEARNING &amp; LMS</text>
    <text x="14" y="272" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📹  Live WebRTC Rooms</text>
    <text x="14" y="302" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🎨  Whiteboard Sessions</text>
    <text x="14" y="332" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📚  Courses &amp; Batches</text>
    <text x="14" y="362" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📝  Quizzes &amp; Homework</text>

    <!-- Nav group 3 -->
    <text x="10" y="400" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700" letter-spacing="0.5">FINTECH &amp; OPERATIONS</text>
    <text x="14" y="426" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">💳  Escrow &amp; Wallets</text>
    <text x="14" y="456" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🏢  Branch Campuses (8)</text>
    <text x="14" y="486" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📶  Biometric Hub (12)</text>
    <text x="14" y="516" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">🤖  AI Gateway &amp; Bots</text>
    <text x="14" y="546" fill="#CBD5E1" font-family="sans-serif" font-size="12.5">📄  Unicode PDF Invoices</text>
  </g>

  <!-- MAIN BODY CANVAS (RIGHT) -->
  <g transform="translate(240, 80)">

    <!-- Top Action Row -->
    <text x="0" y="22" fill="#FFFFFF" font-family="sans-serif" font-size="20" font-weight="700">Marketplace Real-Time Pulse</text>
    <text x="0" y="40" fill="#94A3B8" font-family="sans-serif" font-size="12.5">Synchronized across 8 physical branches &amp; 42 virtual classrooms</text>

    <!-- 4 KPI Metrics Cards -->
    <g transform="translate(0, 56)">
      <!-- Metric 1 -->
      <g transform="translate(0, 0)" filter="url(#shadowSm)">
        <rect width="220" height="96" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="16" y="28" fill="#94A3B8" font-family="sans-serif" font-size="12" font-weight="600">TOTAL GMV (THIS MONTH)</text>
        <text x="16" y="62" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="800">$184,920.00</text>
        <rect x="148" y="44" width="56" height="20" rx="10" fill="#064E3B" />
        <text x="176" y="58" text-anchor="middle" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">+24.5%</text>
      </g>

      <!-- Metric 2 -->
      <g transform="translate(235, 0)" filter="url(#shadowSm)">
        <rect width="220" height="96" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="16" y="28" fill="#94A3B8" font-family="sans-serif" font-size="12" font-weight="600">LIVE CLASSROOMS NOW</text>
        <text x="16" y="62" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="800">1,420 Active</text>
        <rect x="148" y="44" width="56" height="20" rx="10" fill="#1E3A8A" />
        <text x="176" y="58" text-anchor="middle" fill="#60A5FA" font-family="sans-serif" font-size="11" font-weight="700">WebRTC</text>
      </g>

      <!-- Metric 3 -->
      <g transform="translate(470, 0)" filter="url(#shadowSm)">
        <rect width="220" height="96" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="16" y="28" fill="#94A3B8" font-family="sans-serif" font-size="12" font-weight="600">TUTOR SATISFACTION</text>
        <text x="16" y="62" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="800">4.96 ★★★★★</text>
        <rect x="150" y="44" width="54" height="20" rx="10" fill="#78350F" />
        <text x="177" y="58" text-anchor="middle" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">99.4%</text>
      </g>

      <!-- Metric 4 -->
      <g transform="translate(705, 0)" filter="url(#shadowSm)">
        <rect width="235" height="96" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="16" y="28" fill="#94A3B8" font-family="sans-serif" font-size="12" font-weight="600">BIOMETRIC HARDWARE</text>
        <text x="16" y="62" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="800">12 Online / 0 Err</text>
        <rect x="164" y="44" width="56" height="20" rx="10" fill="#064E3B" />
        <text x="192" y="58" text-anchor="middle" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">99.8%</text>
      </g>
    </g>

    <!-- Two Mid Charts / Analytics Cards -->
    <g transform="translate(0, 170)">
      <!-- Left Chart: Weekly Booking Velocity -->
      <g transform="translate(0, 0)" filter="url(#shadowSm)">
        <rect width="575" height="200" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="20" y="30" fill="#FFFFFF" font-family="sans-serif" font-size="14" font-weight="700">Hourly Booking Velocity &amp; Active Student Streams</text>
        <text x="20" y="48" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Last 7 days real-time Redis telemetry</text>
        
        <!-- Spline Area Mockup -->
        <path d="M 30,160 Q 120,70 200,120 T 360,90 T 480,50 L 540,80 L 540,175 L 30,175 Z" fill="url(#chartGrad)" />
        <path d="M 30,160 Q 120,70 200,120 T 360,90 T 480,50 L 540,80" fill="none" stroke="#6366F1" stroke-width="3" />
        <circle cx="480" cy="50" r="5" fill="#818CF8" stroke="#FFFFFF" stroke-width="2" />
        <text x="480" y="38" text-anchor="middle" fill="#C7D2FE" font-family="sans-serif" font-size="11" font-weight="700">Peak: 1,840</text>
      </g>

      <!-- Right Breakdown: Revenue Allocation -->
      <g transform="translate(595, 0)" filter="url(#shadowSm)">
        <rect width="345" height="200" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
        <text x="20" y="30" fill="#FFFFFF" font-family="sans-serif" font-size="14" font-weight="700">Revenue Stream Mix</text>
        <text x="20" y="48" fill="#94A3B8" font-family="sans-serif" font-size="11.5">Escrow splits &amp; direct subscriptions</text>

        <!-- Progress Bars -->
        <g transform="translate(20, 70)">
          <text x="0" y="0" fill="#CBD5E1" font-family="sans-serif" font-size="12">1-on-1 Tutoring Commissions (20% take rate)</text>
          <text x="300" y="0" text-anchor="end" fill="#818CF8" font-family="sans-serif" font-size="12" font-weight="700">$107,250</text>
          <rect x="0" y="8" width="300" height="8" rx="4" fill="#334155" />
          <rect x="0" y="8" width="175" height="8" rx="4" fill="#6366F1" />
        </g>
        <g transform="translate(20, 112)">
          <text x="0" y="0" fill="#CBD5E1" font-family="sans-serif" font-size="12">Batch Cohorts &amp; Group Lessons</text>
          <text x="300" y="0" text-anchor="end" fill="#34D399" font-family="sans-serif" font-size="12" font-weight="700">$48,070</text>
          <rect x="0" y="8" width="300" height="8" rx="4" fill="#334155" />
          <rect x="0" y="8" width="80" height="8" rx="4" fill="#10B981" />
        </g>
        <g transform="translate(20, 154)">
          <text x="0" y="0" fill="#CBD5E1" font-family="sans-serif" font-size="12">Institutional B2B Seat Licensing</text>
          <text x="300" y="0" text-anchor="end" fill="#FBBF24" font-family="sans-serif" font-size="12" font-weight="700">$29,600</text>
          <rect x="0" y="8" width="300" height="8" rx="4" fill="#334155" />
          <rect x="0" y="8" width="45" height="8" rx="4" fill="#F59E0B" />
        </g>
      </g>
    </g>

    <!-- Bottom Data Table: Live Teaching Sessions -->
    <g transform="translate(0, 390)" filter="url(#shadowSm)">
      <rect width="940" height="210" rx="10" fill="url(#cardGradDark)" stroke="#334155" stroke-width="1.2" />
      <text x="20" y="30" fill="#FFFFFF" font-family="sans-serif" font-size="14" font-weight="700">Active Live Classrooms &amp; Hybrid Campus Streams</text>
      
      <!-- Table Header -->
      <rect x="20" y="44" width="900" height="28" rx="4" fill="#0F172A" />
      <text x="35" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700">CLASSROOM / COURSE</text>
      <text x="300" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700">TUTOR</text>
      <text x="480" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700">BRANCH / ROOM</text>
      <text x="660" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700">ATTENDEES</text>
      <text x="790" y="62" fill="#64748B" font-family="sans-serif" font-size="11" font-weight="700">STATUS</text>

      <!-- Row 1 -->
      <g transform="translate(0, 78)">
        <text x="35" y="20" fill="#F8FAFC" font-family="sans-serif" font-size="12" font-weight="600">Advanced Calculus &amp; Linear Algebra</text>
        <text x="300" y="20" fill="#CBD5E1" font-family="sans-serif" font-size="12">Dr. Sarah Jenkins</text>
        <text x="480" y="20" fill="#94A3B8" font-family="sans-serif" font-size="12">Virtual Room #42</text>
        <text x="660" y="20" fill="#38BDF8" font-family="sans-serif" font-size="12" font-weight="600">24 Students</text>
        <rect x="790" y="6" width="90" height="20" rx="10" fill="#064E3B" />
        <circle cx="802" cy="16" r="3.5" fill="#34D399" />
        <text x="812" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="600">Live Streaming</text>
      </g>
      <line x1="20" y1="112" x2="920" y2="112" stroke="#334155" stroke-width="0.8" />

      <!-- Row 2 -->
      <g transform="translate(0, 118)">
        <text x="35" y="20" fill="#F8FAFC" font-family="sans-serif" font-size="12" font-weight="600">Full-Stack Laravel 11 &amp; Filament v3</text>
        <text x="300" y="20" fill="#CBD5E1" font-family="sans-serif" font-size="12">Imran Ahmed</text>
        <text x="480" y="20" fill="#94A3B8" font-family="sans-serif" font-size="12">London Campus 102</text>
        <text x="660" y="20" fill="#38BDF8" font-family="sans-serif" font-size="12" font-weight="600">45 Students</text>
        <rect x="790" y="6" width="90" height="20" rx="10" fill="#064E3B" />
        <circle cx="802" cy="16" r="3.5" fill="#34D399" />
        <text x="812" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="600">Biometric Sync</text>
      </g>
      <line x1="20" y1="152" x2="920" y2="152" stroke="#334155" stroke-width="0.8" />

      <!-- Row 3 -->
      <g transform="translate(0, 158)">
        <text x="35" y="20" fill="#F8FAFC" font-family="sans-serif" font-size="12" font-weight="600">IELTS Speaking Mock Simulation</text>
        <text x="300" y="20" fill="#CBD5E1" font-family="sans-serif" font-size="12">Michael Chang</text>
        <text x="480" y="20" fill="#94A3B8" font-family="sans-serif" font-size="12">1-on-1 Studio A</text>
        <text x="660" y="20" fill="#38BDF8" font-family="sans-serif" font-size="12" font-weight="600">1 Student</text>
        <rect x="790" y="6" width="90" height="20" rx="10" fill="#312E81" />
        <circle cx="802" cy="16" r="3.5" fill="#818CF8" />
        <text x="812" y="20" fill="#A5B4FC" font-family="sans-serif" font-size="11" font-weight="600">AI Evaluating</text>
      </g>
    </g>
  </g>
</svg>'''

with open(os.path.join(images_dir, "admin-dashboard.svg"), "w") as f:
    f.write(admin_svg)

print("Created admin-dashboard.svg")

classroom_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 700" width="1200" height="700">
  <defs>
    <linearGradient id="classBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0B0F19" />
      <stop offset="100%" stop-color="#030712" />
    </linearGradient>
    <linearGradient id="boardBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#0F172A" />
    </linearGradient>
    <linearGradient id="videoGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#334155" />
      <stop offset="100%" stop-color="#1E293B" />
    </linearGradient>
    <filter id="glowGreen">
      <feDropShadow dx="0" dy="0" stdDeviation="4" flood-color="#10B981" flood-opacity="0.6" />
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1200" height="700" fill="url(#classBg)" />

  <!-- TOP CLASSROOM STATUS BAR -->
  <rect width="1200" height="54" fill="#111827" stroke="#1F2937" stroke-width="1" />
  
  <!-- Left info -->
  <g transform="translate(20, 16)">
    <rect width="10" height="10" rx="5" fill="#EF4444">
      <animate attributeName="opacity" values="1;0.4;1" dur="2s" repeatCount="indefinite" />
    </rect>
    <text x="18" y="10" fill="#EF4444" font-family="sans-serif" font-size="11" font-weight="700">REC 00:48:15</text>
    <text x="110" y="10" fill="#E5E7EB" font-family="sans-serif" font-size="14" font-weight="700">Advanced Quantum Mechanics &amp; Linear Algebra</text>
    <rect x="475" y="-2" width="75" height="20" rx="10" fill="#065F46" />
    <text x="512" y="12" text-anchor="middle" fill="#6EE7B7" font-family="sans-serif" font-size="11" font-weight="600">1080p HD</text>
    <rect x="558" y="-2" width="85" height="20" rx="10" fill="#1E3A8A" />
    <text x="600" y="12" text-anchor="middle" fill="#93C5FD" font-family="sans-serif" font-size="11" font-weight="600">WebRTC 24ms</text>
  </g>

  <!-- Right Actions: Participants & Layout -->
  <g transform="translate(980, 14)">
    <rect width="100" height="28" rx="6" fill="#1F2937" stroke="#374151" stroke-width="1" />
    <text x="50" y="18" text-anchor="middle" fill="#D1D5DB" font-family="sans-serif" font-size="12">👥 24 Online</text>
    <rect x="110" y="0" width="90" height="28" rx="6" fill="#4F46E5" />
    <text x="155" y="18" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="12" font-weight="600">Invite +</text>
  </g>

  <!-- CENTER: COLLABORATIVE WHITEBOARD CANVAS (WIDTH 840, HEIGHT 570) -->
  <g transform="translate(20, 68)">
    <rect width="840" height="560" rx="12" fill="url(#boardBg)" stroke="#334155" stroke-width="1.5" />
    
    <!-- Whiteboard Dot Grid -->
    <g opacity="0.12" fill="#94A3B8">
      <circle cx="50" cy="50" r="1.5" /><circle cx="100" cy="50" r="1.5" /><circle cx="150" cy="50" r="1.5" /><circle cx="200" cy="50" r="1.5" /><circle cx="250" cy="50" r="1.5" /><circle cx="300" cy="50" r="1.5" /><circle cx="350" cy="50" r="1.5" /><circle cx="400" cy="50" r="1.5" /><circle cx="450" cy="50" r="1.5" /><circle cx="500" cy="50" r="1.5" /><circle cx="550" cy="50" r="1.5" /><circle cx="600" cy="50" r="1.5" /><circle cx="650" cy="50" r="1.5" /><circle cx="700" cy="50" r="1.5" /><circle cx="750" cy="50" r="1.5" /><circle cx="800" cy="50" r="1.5" />
      <circle cx="50" cy="100" r="1.5" /><circle cx="100" cy="100" r="1.5" /><circle cx="150" cy="100" r="1.5" /><circle cx="200" cy="100" r="1.5" /><circle cx="250" cy="100" r="1.5" /><circle cx="300" cy="100" r="1.5" /><circle cx="350" cy="100" r="1.5" /><circle cx="400" cy="100" r="1.5" /><circle cx="450" cy="100" r="1.5" /><circle cx="500" cy="100" r="1.5" /><circle cx="550" cy="100" r="1.5" /><circle cx="600" cy="100" r="1.5" /><circle cx="650" cy="100" r="1.5" /><circle cx="700" cy="100" r="1.5" /><circle cx="750" cy="100" r="1.5" /><circle cx="800" cy="100" r="1.5" />
      <circle cx="50" cy="150" r="1.5" /><circle cx="100" cy="150" r="1.5" /><circle cx="150" cy="150" r="1.5" /><circle cx="200" cy="150" r="1.5" /><circle cx="250" cy="150" r="1.5" /><circle cx="300" cy="150" r="1.5" /><circle cx="350" cy="150" r="1.5" /><circle cx="400" cy="150" r="1.5" /><circle cx="450" cy="150" r="1.5" /><circle cx="500" cy="150" r="1.5" /><circle cx="550" cy="150" r="1.5" /><circle cx="600" cy="150" r="1.5" /><circle cx="650" cy="150" r="1.5" /><circle cx="700" cy="150" r="1.5" /><circle cx="750" cy="150" r="1.5" /><circle cx="800" cy="150" r="1.5" />
      <circle cx="50" cy="200" r="1.5" /><circle cx="100" cy="200" r="1.5" /><circle cx="150" cy="200" r="1.5" /><circle cx="200" cy="200" r="1.5" /><circle cx="250" cy="200" r="1.5" /><circle cx="300" cy="200" r="1.5" /><circle cx="350" cy="200" r="1.5" /><circle cx="400" cy="200" r="1.5" /><circle cx="450" cy="200" r="1.5" /><circle cx="500" cy="200" r="1.5" /><circle cx="550" cy="200" r="1.5" /><circle cx="600" cy="200" r="1.5" /><circle cx="650" cy="200" r="1.5" /><circle cx="700" cy="200" r="1.5" /><circle cx="750" cy="200" r="1.5" /><circle cx="800" cy="200" r="1.5" />
    </g>

    <!-- Drawn Mathematical Formulas & Geometry on Whiteboard -->
    <text x="70" y="80" fill="#38BDF8" font-family="'Courier New', monospace" font-size="22" font-weight="700">iℏ ∂/∂t |Ψ(t)⟩ = Ĥ |Ψ(t)⟩</text>
    <text x="70" y="115" fill="#94A3B8" font-family="sans-serif" font-size="13">Time-Dependent Schrödinger Wave Equation</text>

    <!-- Vector Field Graphic -->
    <g transform="translate(80, 160)">
      <!-- Coordinate Axis -->
      <line x1="0" y1="120" x2="220" y2="120" stroke="#64748B" stroke-width="2" />
      <line x1="30" y1="140" x2="30" y2="10" stroke="#64748B" stroke-width="2" />
      <!-- Parabola Curve -->
      <path d="M 30,120 Q 110,-20 190,120" fill="none" stroke="#EC4899" stroke-width="3" />
      <!-- Tangent vector -->
      <line x1="70" y1="80" x2="160" y2="20" stroke="#F59E0B" stroke-width="2.5" stroke-dasharray="4" />
      <circle cx="110" cy="50" r="4" fill="#F59E0B" />
      <text x="120" y="45" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="600">Eigenstate λ₁</text>
    </g>

    <!-- Interactive Code Snippet Runner Window -->
    <g transform="translate(360, 140)">
      <rect width="360" height="180" rx="8" fill="#090D16" stroke="#475569" stroke-width="1.2" />
      <rect width="360" height="26" rx="8" fill="#1E293B" />
      <circle cx="16" cy="13" r="4" fill="#EF4444" /><circle cx="28" cy="13" r="4" fill="#F59E0B" /><circle cx="40" cy="13" r="4" fill="#10B981" />
      <text x="60" y="17" fill="#94A3B8" font-family="sans-serif" font-size="11">quantum_circuit.py (Live Runner)</text>
      <text x="18" y="52" fill="#A5B4FC" font-family="'Courier New', monospace" font-size="12">import qiskit as qk</text>
      <text x="18" y="74" fill="#E2E8F0" font-family="'Courier New', monospace" font-size="12">qc = qk.QuantumCircuit(2, 2)</text>
      <text x="18" y="96" fill="#38BDF8" font-family="'Courier New', monospace" font-size="12">qc.h(0)  <tspan fill="#64748B"># Hadamard superposition</tspan></text>
      <text x="18" y="118" fill="#38BDF8" font-family="'Courier New', monospace" font-size="12">qc.cx(0, 1)  <tspan fill="#64748B"># Entanglement Bell State</tspan></text>
      <rect x="18" y="136" width="90" height="24" rx="4" fill="#059669" />
      <text x="63" y="152" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="11" font-weight="700">▶ Run Circuit</text>
      <text x="120" y="152" fill="#34D399" font-family="'Courier New', monospace" font-size="11">State: |00⟩ + |11⟩</text>
    </g>

    <!-- Sticky Note on Whiteboard -->
    <g transform="translate(80, 360)">
      <rect width="220" height="130" rx="4" fill="#FEF08A" stroke="#FDE047" stroke-width="1" />
      <rect width="220" height="16" fill="#FACC15" />
      <text x="12" y="38" fill="#854D0E" font-family="sans-serif" font-size="12" font-weight="700">📌 Tutor Note for Batch #42:</text>
      <text x="12" y="60" fill="#713F12" font-family="sans-serif" font-size="11.5">1. Complete Exercise 4.2 in</text>
      <text x="12" y="78" fill="#713F12" font-family="sans-serif" font-size="11.5">   the Student Assignment tab.</text>
      <text x="12" y="96" fill="#713F12" font-family="sans-serif" font-size="11.5">2. Mock exam starts Friday.</text>
      <text x="12" y="118" fill="#A16207" font-family="sans-serif" font-size="10.5">— Dr. Elena Rostova</text>
    </g>

    <!-- Multi-cursor collaboration pointer -->
    <g transform="translate(340, 420)">
      <path d="M 0,0 L 12,12 L 6,14 L 4,20 Z" fill="#6366F1" />
      <rect x="14" y="8" width="94" height="20" rx="4" fill="#6366F1" />
      <text x="61" y="22" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="10.5" font-weight="600">Sarah (Student)</text>
    </g>

    <!-- FLOATING WHITEBOARD TOOL DOCK (VERTICAL LEFT) -->
    <g transform="translate(16, 80)">
      <rect width="44" height="340" rx="22" fill="#0F172A" stroke="#334155" stroke-width="1.5" />
      <circle cx="22" cy="30" r="16" fill="#4F46E5" />
      <text x="22" y="35" text-anchor="middle" fill="#FFFFFF" font-size="15">✏️</text>
      <text x="22" y="75" text-anchor="middle" fill="#94A3B8" font-size="15">📐</text>
      <text x="22" y="115" text-anchor="middle" fill="#94A3B8" font-size="15">🔲</text>
      <text x="22" y="155" text-anchor="middle" fill="#94A3B8" font-size="15">∑ </text>
      <text x="22" y="195" text-anchor="middle" fill="#94A3B8" font-size="15">💻</text>
      <text x="22" y="235" text-anchor="middle" fill="#94A3B8" font-size="15">🧹</text>
      <text x="22" y="275" text-anchor="middle" fill="#94A3B8" font-size="15">📝</text>
      <text x="22" y="315" text-anchor="middle" fill="#94A3B8" font-size="15">↩️</text>
    </g>
  </g>

  <!-- RIGHT COLUMN: VIDEO TILES & LIVE CHAT (WIDTH 300) -->
  <g transform="translate(880, 68)">
    
    <!-- Top: Tutor Video Stream Tile -->
    <rect width="300" height="175" rx="10" fill="url(#videoGrad)" stroke="#10B981" stroke-width="2" filter="url(#glowGreen)" />
    <!-- Center Avatar / Feed -->
    <circle cx="150" cy="80" r="38" fill="#4338CA" />
    <text x="150" y="88" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="700">ER</text>
    <!-- Waveform indicator -->
    <g transform="translate(20, 142)">
      <rect x="0" y="4" width="3" height="12" fill="#10B981" />
      <rect x="6" y="0" width="3" height="20" fill="#10B981" />
      <rect x="12" y="6" width="3" height="10" fill="#10B981" />
      <rect x="18" y="2" width="3" height="16" fill="#10B981" />
    </g>
    <!-- Name badge -->
    <rect x="48" y="140" width="175" height="22" rx="4" fill="#000000" fill-opacity="0.6" />
    <text x="56" y="155" fill="#FFFFFF" font-family="sans-serif" font-size="11" font-weight="600">Dr. Elena Rostova (Host / Tutor)</text>

    <!-- 2 Small Student Video Tiles -->
    <g transform="translate(0, 185)">
      <rect width="145" height="85" rx="6" fill="#1E293B" stroke="#334155" stroke-width="1" />
      <circle cx="72" cy="38" r="18" fill="#64748B" />
      <text x="72" y="43" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="12">SJ</text>
      <text x="10" y="74" fill="#94A3B8" font-family="sans-serif" font-size="10">Sarah Jenkins</text>

      <g transform="translate(155, 0)">
        <rect width="145" height="85" rx="6" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <circle cx="72" cy="38" r="18" fill="#0D9488" />
        <text x="72" y="43" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="12">TL</text>
        <text x="10" y="74" fill="#94A3B8" font-family="sans-serif" font-size="10">Tanvir Latif ✋</text>
      </g>
    </g>

    <!-- Bottom: Interactive Live Q&A & AI Co-Pilot Feed -->
    <g transform="translate(0, 280)">
      <rect width="300" height="275" rx="10" fill="#111827" stroke="#334155" stroke-width="1" />
      <text x="16" y="26" fill="#F9FAFB" font-family="sans-serif" font-size="13" font-weight="700">Class Discussion &amp; AI Bot</text>
      <line x1="0" y1="38" x2="300" y2="38" stroke="#1F2937" stroke-width="1" />

      <!-- Message 1 -->
      <g transform="translate(14, 52)">
        <text x="0" y="0" fill="#93C5FD" font-family="sans-serif" font-size="11" font-weight="700">Sarah Jenkins <tspan fill="#6B7280" font-weight="400">10:44 AM</tspan></text>
        <text x="0" y="16" fill="#D1D5DB" font-family="sans-serif" font-size="11.5">How do we normalize the wave vector?</text>
      </g>

      <!-- Message 2: AI Co-Pilot Assistant -->
      <g transform="translate(14, 102)">
        <rect width="272" height="65" rx="6" fill="#1E1B4B" stroke="#4338CA" stroke-width="1" />
        <text x="10" y="16" fill="#C7D2FE" font-family="sans-serif" font-size="11" font-weight="700">🤖 AI Teaching Co-Pilot (DeepSeek-R1)</text>
        <text x="10" y="34" fill="#E0E7FF" font-family="sans-serif" font-size="11">Normalization condition requires:</text>
        <text x="10" y="50" fill="#818CF8" font-family="'Courier New', monospace" font-size="11.5">⟨Ψ|Ψ⟩ = ∫ |ψ(x)|² dx = 1</text>
      </g>

      <!-- Message 3 -->
      <g transform="translate(14, 185)">
        <text x="0" y="0" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Dr. Elena (Tutor) <tspan fill="#6B7280" font-weight="400">10:46 AM</tspan></text>
        <text x="0" y="16" fill="#D1D5DB" font-family="sans-serif" font-size="11.5">Spot on AI bot! Let's solve one together.</text>
      </g>

      <!-- Chat input box -->
      <g transform="translate(12, 230)">
        <rect width="276" height="32" rx="6" fill="#1F2937" stroke="#374151" stroke-width="1" />
        <text x="12" y="21" fill="#6B7280" font-family="sans-serif" font-size="11">Ask question or request whiteboard control...</text>
      </g>
    </g>
  </g>

  <!-- BOTTOM WEBRTC CLASSROOM CONTROLS BAR -->
  <g transform="translate(0, 640)">
    <rect width="1200" height="60" fill="#0F172A" stroke="#1E293B" stroke-width="1" />
    
    <!-- Controls cluster -->
    <g transform="translate(420, 10)">
      <!-- Mic -->
      <circle cx="20" cy="20" r="18" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="20" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">🎙️</text>
      <!-- Camera -->
      <circle cx="68" cy="20" r="18" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="68" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">📹</text>
      <!-- Screen Share -->
      <circle cx="116" cy="20" r="18" fill="#4F46E5" />
      <text x="116" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">🖥️</text>
      <!-- Whiteboard -->
      <circle cx="164" cy="20" r="18" fill="#059669" />
      <text x="164" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">🎨</text>
      <!-- Raise Hand -->
      <circle cx="212" cy="20" r="18" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="212" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">✋</text>
      <!-- Breakout -->
      <circle cx="260" cy="20" r="18" fill="#1E293B" stroke="#475569" stroke-width="1" />
      <text x="260" y="25" text-anchor="middle" fill="#FFFFFF" font-size="14">👥</text>
      <!-- End Class button -->
      <rect x="298" y="2" width="110" height="36" rx="8" fill="#DC2626" />
      <text x="353" y="24" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="13" font-weight="700">End Class</text>
    </g>
  </g>
</svg>'''

with open(os.path.join(images_dir, "live-classroom.svg"), "w") as f:
    f.write(classroom_svg)

print("Created live-classroom.svg")

# 4. Tutor Booking SVG
booking_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 700" width="1200" height="700">
  <defs>
    <linearGradient id="bookBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0F172A" />
      <stop offset="100%" stop-color="#020617" />
    </linearGradient>
    <linearGradient id="tutorCardGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#111827" />
    </linearGradient>
    <linearGradient id="primaryGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#6366F1" />
      <stop offset="100%" stop-color="#8B5CF6" />
    </linearGradient>
    <filter id="shadowCard">
      <feDropShadow dx="0" dy="6" stdDeviation="10" flood-color="#000000" flood-opacity="0.5" />
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1200" height="700" fill="url(#bookBg)" />

  <!-- TOP SEARCH & FILTER BAR -->
  <g transform="translate(60, 30)">
    <rect width="1080" height="60" rx="12" fill="#1E293B" stroke="#334155" stroke-width="1.2" />
    
    <!-- Search field -->
    <text x="24" y="36" fill="#94A3B8" font-family="sans-serif" font-size="13">🔍 Subject: <tspan fill="#FFFFFF" font-weight="700">Computer Science &amp; Python</tspan></text>
    <line x1="320" y1="12" x2="320" y2="48" stroke="#334155" stroke-width="1" />
    
    <!-- Filter: Availability -->
    <text x="340" y="36" fill="#94A3B8" font-family="sans-serif" font-size="13">🗓️ Date: <tspan fill="#FFFFFF" font-weight="700">Today / This Week</tspan></text>
    <line x1="560" y1="12" x2="560" y2="48" stroke="#334155" stroke-width="1" />

    <!-- Filter: Price -->
    <text x="580" y="36" fill="#94A3B8" font-family="sans-serif" font-size="13">💰 Hourly: <tspan fill="#FFFFFF" font-weight="700">$30 - $60/hr</tspan></text>
    <line x1="770" y1="12" x2="770" y2="48" stroke="#334155" stroke-width="1" />

    <!-- Filter: Language -->
    <text x="790" y="36" fill="#94A3B8" font-family="sans-serif" font-size="13">🌐 Language: <tspan fill="#FFFFFF" font-weight="700">English, Bengali</tspan></text>

    <!-- Search Button -->
    <rect x="960" y="10" width="105" height="40" rx="8" fill="#4F46E5" />
    <text x="1012" y="35" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="13" font-weight="700">Filter (14)</text>
  </g>

  <!-- LEFT COLUMN: FEATURED TUTOR PROFILE CARD -->
  <g transform="translate(60, 110)" filter="url(#shadowCard)">
    <rect width="480" height="550" rx="14" fill="url(#tutorCardGrad)" stroke="#334155" stroke-width="1.5" />
    
    <!-- Avatar & Badges -->
    <circle cx="80" cy="80" r="44" fill="#3B82F6" stroke="#60A5FA" stroke-width="3" />
    <text x="80" y="90" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="28" font-weight="800">AW</text>
    
    <!-- Verified Badge -->
    <circle cx="112" cy="112" r="14" fill="#10B981" stroke="#1E293B" stroke-width="2" />
    <text x="112" y="117" text-anchor="middle" fill="#FFFFFF" font-size="12">✓</text>

    <!-- Tutor Info -->
    <g transform="translate(145, 52)">
      <text x="0" y="16" fill="#F8FAFC" font-family="sans-serif" font-size="20" font-weight="800">Dr. Alexander Wright, Ph.D.</text>
      <text x="0" y="38" fill="#94A3B8" font-family="sans-serif" font-size="13">Senior Software Architect &amp; CS Professor</text>
      <g transform="translate(0, 52)">
        <text x="0" y="0" fill="#FBBF24" font-size="14">★★★★★</text>
        <text x="75" y="0" fill="#FFFFFF" font-family="sans-serif" font-size="13" font-weight="700">5.0</text>
        <text x="105" y="0" fill="#94A3B8" font-family="sans-serif" font-size="12">(214 verified reviews)</text>
      </g>
    </g>

    <!-- Key Stats Row -->
    <g transform="translate(30, 155)">
      <rect width="420" height="70" rx="8" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <!-- Stat 1 -->
      <text x="45" y="30" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">HOURS TAUGHT</text>
      <text x="45" y="52" text-anchor="middle" fill="#38BDF8" font-family="sans-serif" font-size="16" font-weight="800">1,940+</text>
      <line x1="90" y1="12" x2="90" y2="58" stroke="#334155" stroke-width="1" />
      <!-- Stat 2 -->
      <text x="160" y="30" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">ATTENDANCE</text>
      <text x="160" y="52" text-anchor="middle" fill="#34D399" font-family="sans-serif" font-size="16" font-weight="800">99.8%</text>
      <line x1="230" y1="12" x2="230" y2="58" stroke="#334155" stroke-width="1" />
      <!-- Stat 3 -->
      <text x="295" y="30" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">RESPONSE TIME</text>
      <text x="295" y="52" text-anchor="middle" fill="#FBBF24" font-family="sans-serif" font-size="16" font-weight="800">&lt; 8 mins</text>
      <line x1="360" y1="12" x2="360" y2="58" stroke="#334155" stroke-width="1" />
      <!-- Stat 4 -->
      <text x="390" y="30" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">RATE</text>
      <text x="390" y="52" text-anchor="middle" fill="#F43F5E" font-family="sans-serif" font-size="16" font-weight="800">$45<tspan font-size="10" font-weight="400">/hr</tspan></text>
    </g>

    <!-- Bio summary -->
    <g transform="translate(30, 245)">
      <text x="0" y="0" fill="#E2E8F0" font-family="sans-serif" font-size="13" font-weight="600">About Me</text>
      <text x="0" y="24" fill="#94A3B8" font-family="sans-serif" font-size="12" line-height="1.5">Specializing in Python algorithms, Laravel architectures, machine learning,</text>
      <text x="0" y="44" fill="#94A3B8" font-family="sans-serif" font-size="12">and technical coding interview preparation (FAANG/Tier 1 companies).</text>
    </g>

    <!-- Subject Badges -->
    <g transform="translate(30, 315)">
      <text x="0" y="0" fill="#E2E8F0" font-family="sans-serif" font-size="13" font-weight="600">Subjects &amp; Expertise</text>
      <g transform="translate(0, 14)">
        <rect x="0" y="0" width="85" height="24" rx="4" fill="#1E3A8A" />
        <text x="42" y="16" text-anchor="middle" fill="#93C5FD" font-family="sans-serif" font-size="11" font-weight="600">Python 3.12</text>
        <rect x="95" y="0" width="95" height="24" rx="4" fill="#312E81" />
        <text x="142" y="16" text-anchor="middle" fill="#C7D2FE" font-family="sans-serif" font-size="11" font-weight="600">Laravel 11 / PHP</text>
        <rect x="200" y="0" width="115" height="24" rx="4" fill="#065F46" />
        <text x="257" y="16" text-anchor="middle" fill="#A7F3D0" font-family="sans-serif" font-size="11" font-weight="600">Data Structures</text>
        <rect x="325" y="0" width="85" height="24" rx="4" fill="#78350F" />
        <text x="367" y="16" text-anchor="middle" fill="#FDE68A" font-family="sans-serif" font-size="11" font-weight="600">AI / PyTorch</text>
      </g>
    </g>

    <!-- Student Review Quote -->
    <g transform="translate(30, 385)">
      <rect width="420" height="85" rx="8" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="16" y="24" fill="#FBBF24" font-size="12">★★★★★</text>
      <text x="16" y="46" fill="#CBD5E1" font-family="sans-serif" font-size="11.5" font-style="italic">"Dr. Wright broke down complex graph algorithms in 45 minutes.</text>
      <text x="16" y="64" fill="#CBD5E1" font-family="sans-serif" font-size="11.5" font-style="italic"> I passed my Google technical interview thanks to him!"</text>
      <text x="404" y="72" text-anchor="end" fill="#64748B" font-family="sans-serif" font-size="11">— Tanvir L. (Verified Student)</text>
    </g>

    <!-- Bottom Tutor Action -->
    <g transform="translate(30, 490)">
      <rect width="420" height="42" rx="8" fill="#334155" />
      <text x="210" y="26" text-anchor="middle" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="600">💬 Message Tutor First (Free 10-Min Consult)</text>
    </g>
  </g>

  <!-- RIGHT COLUMN: INTERACTIVE AVAILABILITY CALENDAR & ESCROW CHECKOUT -->
  <g transform="translate(565, 110)" filter="url(#shadowCard)">
    <rect width="575" height="550" rx="14" fill="url(#tutorCardGrad)" stroke="#334155" stroke-width="1.5" />
    
    <!-- Timezone Selector Header -->
    <g transform="translate(30, 24)">
      <text x="0" y="20" fill="#FFFFFF" font-family="sans-serif" font-size="18" font-weight="700">Select Date &amp; Available Slot</text>
      <rect x="345" y="0" width="170" height="30" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="355" y="19" fill="#94A3B8" font-family="sans-serif" font-size="11">🌐 Asia/Dhaka (GMT+6) ▾</text>
    </g>

    <!-- Calendar Date Strip -->
    <g transform="translate(30, 75)">
      <!-- Day 1 -->
      <g transform="translate(0, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">MON</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">03</text>
      </g>
      <!-- Day 2 -->
      <g transform="translate(74, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">TUE</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">04</text>
      </g>
      <!-- Day 3 -->
      <g transform="translate(148, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">WED</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">05</text>
      </g>
      <!-- Day 4 (ACTIVE SELECTED) -->
      <g transform="translate(222, 0)">
        <rect width="66" height="60" rx="8" fill="#4F46E5" stroke="#818CF8" stroke-width="1.5" />
        <text x="33" y="22" text-anchor="middle" fill="#E0E7FF" font-family="sans-serif" font-size="11" font-weight="700">THU</text>
        <text x="33" y="44" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="16" font-weight="800">06</text>
      </g>
      <!-- Day 5 -->
      <g transform="translate(296, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">FRI</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">07</text>
      </g>
      <!-- Day 6 -->
      <g transform="translate(370, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">SAT</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">08</text>
      </g>
      <!-- Day 7 -->
      <g transform="translate(444, 0)">
        <rect width="66" height="60" rx="8" fill="#1E293B" stroke="#334155" stroke-width="1" />
        <text x="33" y="22" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="11">SUN</text>
        <text x="33" y="44" text-anchor="middle" fill="#CBD5E1" font-family="sans-serif" font-size="15" font-weight="700">09</text>
      </g>
    </g>

    <!-- Time Slots Grid -->
    <g transform="translate(30, 155)">
      <text x="0" y="0" fill="#94A3B8" font-family="sans-serif" font-size="12" font-weight="600">AVAILABLE TIME SLOTS (Thursday, Nov 6, 2026):</text>
      
      <!-- Slot 1 -->
      <g transform="translate(0, 14)">
        <rect width="160" height="40" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="80" y="24" text-anchor="middle" fill="#E2E8F0" font-family="sans-serif" font-size="12">09:00 AM - 10:00 AM</text>
      </g>
      <!-- Slot 2 -->
      <g transform="translate(175, 14)">
        <rect width="160" height="40" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="80" y="24" text-anchor="middle" fill="#E2E8F0" font-family="sans-serif" font-size="12">11:30 AM - 12:30 PM</text>
      </g>
      <!-- Slot 3 (SELECTED ACTIVE) -->
      <g transform="translate(350, 14)">
        <rect width="160" height="40" rx="6" fill="#065F46" stroke="#10B981" stroke-width="1.5" />
        <text x="80" y="24" text-anchor="middle" fill="#A7F3D0" font-family="sans-serif" font-size="12" font-weight="700">03:00 PM - 04:00 PM ✓</text>
      </g>
      <!-- Slot 4 -->
      <g transform="translate(0, 64)">
        <rect width="160" height="40" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="80" y="24" text-anchor="middle" fill="#E2E8F0" font-family="sans-serif" font-size="12">05:30 PM - 06:30 PM</text>
      </g>
      <!-- Slot 5 -->
      <g transform="translate(175, 64)">
        <rect width="160" height="40" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="80" y="24" text-anchor="middle" fill="#E2E8F0" font-family="sans-serif" font-size="12">07:00 PM - 08:00 PM</text>
      </g>
      <!-- Slot 6 -->
      <g transform="translate(350, 64)">
        <rect width="160" height="40" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="80" y="24" text-anchor="middle" fill="#E2E8F0" font-family="sans-serif" font-size="12">09:00 PM - 10:00 PM</text>
      </g>
    </g>

    <!-- ESCROW CHECKOUT SUMMARY BOX -->
    <g transform="translate(30, 290)">
      <rect width="515" height="150" rx="10" fill="#0F172A" stroke="#334155" stroke-width="1.2" />
      
      <text x="20" y="26" fill="#F8FAFC" font-family="sans-serif" font-size="14" font-weight="700">Booking Summary &amp; Escrow Guarantee</text>
      <text x="20" y="52" fill="#94A3B8" font-family="sans-serif" font-size="12">Lesson: 1x 60-Min 1-on-1 Live Class on WebRTC Canvas</text>
      <text x="495" y="52" text-anchor="end" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">$45.00</text>
      
      <text x="20" y="74" fill="#94A3B8" font-family="sans-serif" font-size="12">Platform Service Fee (0% Promotional)</text>
      <text x="495" y="74" text-anchor="end" fill="#34D399" font-family="sans-serif" font-size="12" font-weight="600">$0.00</text>
      <line x1="20" y1="88" x2="495" y2="88" stroke="#334155" stroke-width="1" />

      <!-- Escrow badge -->
      <g transform="translate(20, 102)">
        <rect width="260" height="32" rx="6" fill="#064E3B" />
        <text x="10" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="600">🛡️ 100% Escrow Protected: Funds released only after class</text>
      </g>
      <text x="495" y="122" text-anchor="end" fill="#FFFFFF" font-family="sans-serif" font-size="18" font-weight="800">Total: $45.00</text>
    </g>

    <!-- PAYMENT METHODS & INSTANT CONFIRM BUTTON -->
    <g transform="translate(30, 460)">
      <!-- Payment icon badges -->
      <g transform="translate(0, 0)">
        <text x="0" y="14" fill="#94A3B8" font-family="sans-serif" font-size="11">Accepted Methods: Stripe, PayPal, bKash, Apple Pay &amp; Student Wallet</text>
      </g>
      
      <!-- Big CTA Button -->
      <g transform="translate(0, 24)">
        <rect width="515" height="46" rx="8" fill="url(#primaryGrad2)" />
        <text x="257" y="29" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="14" font-weight="800">Confirm Booking &amp; Enter Classroom 🚀</text>
      </g>
    </g>
  </g>
</svg>'''

with open(os.path.join(images_dir, "tutor-booking.svg"), "w") as f:
    f.write(booking_svg)

print("Created tutor-booking.svg")

# 5. System Architecture SVG
arch_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 680" width="1200" height="680">
  <defs>
    <linearGradient id="archBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0B0F19" />
      <stop offset="100%" stop-color="#030712" />
    </linearGradient>
    <linearGradient id="tierGrad1" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#1E1B4B" />
    </linearGradient>
    <linearGradient id="tierGrad2" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#064E3B" />
    </linearGradient>
    <linearGradient id="tierGrad3" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#78350F" />
    </linearGradient>
    <linearGradient id="tierGrad4" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#831843" />
    </linearGradient>
    <filter id="shadowBox">
      <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#000000" flood-opacity="0.4" />
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1200" height="680" fill="url(#archBg)" />

  <!-- TITLE -->
  <text x="600" y="42" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="22" font-weight="800">EduFlow OS Modular Monolith Architecture Blueprint</text>
  <text x="600" y="64" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="13">High-Performance, Multi-Tenant &amp; Multi-Branch EdTech Infrastructure</text>

  <!-- TIER 1: CLIENT PRESENTATION & 11 FILAMENT PANELS -->
  <g transform="translate(60, 90)" filter="url(#shadowBox)">
    <rect width="1080" height="110" rx="10" fill="url(#tierGrad1)" stroke="#6366F1" stroke-width="1.5" />
    <rect x="20" y="12" width="220" height="24" rx="4" fill="#4338CA" />
    <text x="30" y="28" fill="#E0E7FF" font-family="sans-serif" font-size="11" font-weight="700">TIER 1: 11 DEDICATED FILAMENT PANELS</text>
    <text x="250" y="28" fill="#94A3B8" font-family="sans-serif" font-size="11">Role-isolated dashboards + Universal PWA + REST/GraphQL APIs</text>

    <!-- 11 Panel Badges -->
    <g transform="translate(20, 48)">
      <!-- Panel 1 -->
      <rect x="0" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="42" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Super Admin</text>
      <text x="42" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/super-admin</text>

      <!-- Panel 2 -->
      <rect x="95" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="137" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Business</text>
      <text x="137" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/admin</text>

      <!-- Panel 3 -->
      <rect x="190" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="232" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Branch Mgr</text>
      <text x="232" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/branch</text>

      <!-- Panel 4 -->
      <rect x="285" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="327" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Tutor</text>
      <text x="327" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/tutor</text>

      <!-- Panel 5 -->
      <rect x="380" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="422" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Student</text>
      <text x="422" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/student</text>

      <!-- Panel 6 -->
      <rect x="475" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="517" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Guardian</text>
      <text x="517" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/guardian</text>

      <!-- Panel 7 -->
      <rect x="570" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="612" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Support</text>
      <text x="612" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/support</text>

      <!-- Panel 8 -->
      <rect x="665" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="707" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Finance</text>
      <text x="707" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/finance</text>

      <!-- Panel 9 -->
      <rect x="760" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="802" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Content</text>
      <text x="802" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/content</text>

      <!-- Panel 10 -->
      <rect x="855" y="0" width="90" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="900" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Institution</text>
      <text x="900" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/institution</text>

      <!-- Panel 11 -->
      <rect x="955" y="0" width="85" height="44" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
      <text x="997" y="18" text-anchor="middle" fill="#A5B4FC" font-family="sans-serif" font-size="10.5" font-weight="700">Affiliate</text>
      <text x="997" y="34" text-anchor="middle" fill="#64748B" font-family="sans-serif" font-size="9.5">/affiliate</text>
    </g>
  </g>

  <!-- TIER 2: 50 PLUGGABLE BUSINESS MODULES MONOLITH -->
  <g transform="translate(60, 225)" filter="url(#shadowBox)">
    <rect width="1080" height="130" rx="10" fill="url(#tierGrad2)" stroke="#10B981" stroke-width="1.5" />
    <rect x="20" y="12" width="270" height="24" rx="4" fill="#065F46" />
    <text x="30" y="28" fill="#D1FAE5" font-family="sans-serif" font-size="11" font-weight="700">TIER 2: 50 MODULAR BUSINESS ENGINES</text>
    <text x="300" y="28" fill="#94A3B8" font-family="sans-serif" font-size="11">Toggleable via Module Center with strict dependency graphs</text>

    <!-- 5 Module Domain Columns -->
    <g transform="translate(20, 48)">
      <!-- Col 1: Scheduling & Live -->
      <g transform="translate(0, 0)">
        <rect width="195" height="66" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Live &amp; Scheduling</text>
        <text x="12" y="38" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Bookings, Calendar, Timetable</text>
        <text x="12" y="54" fill="#94A3B8" font-family="sans-serif" font-size="10.5">LiveClassroom, Whiteboard</text>
      </g>
      <!-- Col 2: LMS & Learning -->
      <g transform="translate(210, 0)">
        <rect width="195" height="66" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Curriculum &amp; LMS</text>
        <text x="12" y="38" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Courses, Packages, Catalog</text>
        <text x="12" y="54" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Quizzes, Assignments, Certs</text>
      </g>
      <!-- Col 3: Fintech & Wallets -->
      <g transform="translate(420, 0)">
        <rect width="195" height="66" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Fintech &amp; Wallets</text>
        <text x="12" y="38" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Payments, Wallet, Escrow</text>
        <text x="12" y="54" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Invoicing, Commissions, Saas</text>
      </g>
      <!-- Col 4: AI Suite -->
      <g transform="translate(630, 0)">
        <rect width="195" height="66" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Autonomous AI</text>
        <text x="12" y="38" fill="#94A3B8" font-family="sans-serif" font-size="10.5">AiAssistant, AiTutor Bot</text>
        <text x="12" y="54" fill="#94A3B8" font-family="sans-serif" font-size="10.5">AiCatalog Scraper, AiAdmin</text>
      </g>
      <!-- Col 5: Operations & Attendance -->
      <g transform="translate(840, 0)">
        <rect width="200" height="66" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#34D399" font-family="sans-serif" font-size="11" font-weight="700">Operations &amp; Campus</text>
        <text x="12" y="38" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Attendance Hub, StaffHr, CRM</text>
        <text x="12" y="54" fill="#94A3B8" font-family="sans-serif" font-size="10.5">Disputes, Gamification, Reports</text>
      </g>
    </g>
  </g>

  <!-- TIER 3: MANDATORY ECOSYSTEM SERVICE ADAPTERS -->
  <g transform="translate(60, 380)" filter="url(#shadowBox)">
    <rect width="1080" height="120" rx="10" fill="url(#tierGrad3)" stroke="#F59E0B" stroke-width="1.5" />
    <rect x="20" y="12" width="290" height="24" rx="4" fill="#78350F" />
    <text x="30" y="28" fill="#FEF3C7" font-family="sans-serif" font-size="11" font-weight="700">TIER 3: 7 MANDATORY SERVICE ADAPTERS</text>
    <text x="320" y="28" fill="#94A3B8" font-family="sans-serif" font-size="11">Clean interfaces isolating proprietary &amp; third-party engines</text>

    <!-- 7 Adapter Badges -->
    <g transform="translate(20, 48)">
      <!-- 1 -->
      <g transform="translate(0, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">⚡ Drutogoti APM</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">N+1 &amp; Query Profiler</text>
      </g>
      <!-- 2 -->
      <g transform="translate(150, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">🤖 AI Hub Gateway</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">Multi-LLM Failover</text>
      </g>
      <!-- 3 -->
      <g transform="translate(300, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">📶 Attendance Hub</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">Biometric &amp; RFID Devices</text>
      </g>
      <!-- 4 -->
      <g transform="translate(450, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">📄 Unicode PDF</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">Arabic, Bangla, CJK</text>
      </g>
      <!-- 5 -->
      <g transform="translate(600, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">🔗 Universal Slug</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">301 Tracking &amp; SEO</text>
      </g>
      <!-- 6 -->
      <g transform="translate(750, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">🎨 Admin Panel UI</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">Dynamic Theme Engine</text>
      </g>
      <!-- 7 -->
      <g transform="translate(900, 0)">
        <rect width="140" height="54" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="10" y="20" fill="#FBBF24" font-family="sans-serif" font-size="11" font-weight="700">📚 AI Catalog</text>
        <text x="10" y="38" fill="#94A3B8" font-family="sans-serif" font-size="9.5">Syllabus Scraper</text>
      </g>
    </g>
  </g>

  <!-- TIER 4: MULTI-TENANT PERSISTENCE & INFRASTRUCTURE -->
  <g transform="translate(60, 525)" filter="url(#shadowBox)">
    <rect width="1080" height="110" rx="10" fill="url(#tierGrad4)" stroke="#EC4899" stroke-width="1.5" />
    <rect x="20" y="12" width="280" height="24" rx="4" fill="#831843" />
    <text x="30" y="28" fill="#FCE7F3" font-family="sans-serif" font-size="11" font-weight="700">TIER 4: INFRASTRUCTURE &amp; DATA ENGINE</text>
    <text x="310" y="28" fill="#94A3B8" font-family="sans-serif" font-size="11">Multi-tenant scoping, asynchronous event bus &amp; real-time sockets</text>

    <!-- Infra items -->
    <g transform="translate(20, 48)">
      <!-- 1 -->
      <g transform="translate(0, 0)">
        <rect width="250" height="46" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#F472B6" font-family="sans-serif" font-size="11.5" font-weight="700">Multi-Tenant MySQL 8 / SQLite</text>
        <text x="12" y="36" fill="#94A3B8" font-family="sans-serif" font-size="10">TenantScope &amp; Branch Isolation</text>
      </g>
      <!-- 2 -->
      <g transform="translate(265, 0)">
        <rect width="250" height="46" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#F472B6" font-family="sans-serif" font-size="11.5" font-weight="700">Redis Cache &amp; Laravel Horizon</text>
        <text x="12" y="36" fill="#94A3B8" font-family="sans-serif" font-size="10">High-throughput queue execution</text>
      </g>
      <!-- 3 -->
      <g transform="translate(530, 0)">
        <rect width="250" height="46" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#F472B6" font-family="sans-serif" font-size="11.5" font-weight="700">WebRTC SFU Media Engine</text>
        <text x="12" y="36" fill="#94A3B8" font-family="sans-serif" font-size="10">Ultra-low latency audio/video/canvas</text>
      </g>
      <!-- 4 -->
      <g transform="translate(795, 0)">
        <rect width="245" height="46" rx="6" fill="#0F172A" stroke="#334155" stroke-width="1" />
        <text x="12" y="20" fill="#F472B6" font-family="sans-serif" font-size="11.5" font-weight="700">Biometric TCP/IP Gateway</text>
        <text x="12" y="36" fill="#94A3B8" font-family="sans-serif" font-size="10">Hardware machine event hooks</text>
      </g>
    </g>
  </g>
</svg>'''

with open(os.path.join(images_dir, "system-architecture.svg"), "w") as f:
    f.write(arch_svg)

print("Created system-architecture.svg")


# 6. Time Saver & ROI Infographic SVG
roi_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 620" width="1200" height="620">
  <defs>
    <linearGradient id="roiBg" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#090D16" />
      <stop offset="100%" stop-color="#050811" />
    </linearGradient>
    <linearGradient id="badCardGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#450A0A" />
    </linearGradient>
    <linearGradient id="goodCardGrad" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#1E293B" />
      <stop offset="100%" stop-color="#064E3B" />
    </linearGradient>
    <linearGradient id="bannerGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#4F46E5" />
      <stop offset="50%" stop-color="#059669" />
      <stop offset="100%" stop-color="#0284C7" />
    </linearGradient>
    <filter id="shadowLg">
      <feDropShadow dx="0" dy="8" stdDeviation="12" flood-color="#000000" flood-opacity="0.5" />
    </filter>
  </defs>

  <!-- Background -->
  <rect width="1200" height="620" fill="url(#roiBg)" />

  <!-- HEADER -->
  <text x="600" y="45" text-anchor="middle" fill="#FFFFFF" font-family="sans-serif" font-size="24" font-weight="800">Why Build From Scratch? The Quantified Business ROI</text>
  <text x="600" y="70" text-anchor="middle" fill="#94A3B8" font-family="sans-serif" font-size="14">Save 9-14 Months of Complex Engineering and $120,000+ in Upfront Development Waste</text>

  <!-- LEFT CARD: BUILDING FROM SCRATCH (TRADITIONAL) -->
  <g transform="translate(60, 100)" filter="url(#shadowLg)">
    <rect width="515" height="390" rx="14" fill="url(#badCardGrad)" stroke="#EF4444" stroke-width="1.5" />
    
    <!-- Header -->
    <rect x="24" y="20" width="160" height="26" rx="6" fill="#7F1D1D" />
    <text x="34" y="38" fill="#FCA5A5" font-family="sans-serif" font-size="11.5" font-weight="700">❌ TRADITIONAL APPROACH</text>
    <text x="24" y="78" fill="#FFFFFF" font-family="sans-serif" font-size="22" font-weight="800">Building In-House From Zero</text>

    <!-- Pain points list -->
    <g transform="translate(24, 105)">
      <!-- Item 1 -->
      <g transform="translate(0, 0)">
        <text x="0" y="16" fill="#EF4444" font-size="16">⏳</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Time-To-Market: 9 to 14 Months</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Endless sprints building calendars, auth, timezones &amp; payments.</text>
      </g>
      <!-- Item 2 -->
      <g transform="translate(0, 56)">
        <text x="0" y="16" fill="#EF4444" font-size="16">💸</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Engineering Cost: $110,000 – $180,000+</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Salary for 4 Senior Devs, 1 DevOps, 1 UI/UX, and QA engineers.</text>
      </g>
      <!-- Item 3 -->
      <g transform="translate(0, 112)">
        <text x="0" y="16" fill="#EF4444" font-size="16">🧩</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">SaaS Subscription Sprawl: $800 - $1,800 / mo</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Paying per-seat for Zoom ($250), Calendly ($80), Freshdesk ($120), etc.</text>
      </g>
      <!-- Item 4 -->
      <g transform="translate(0, 168)">
        <text x="0" y="16" fill="#EF4444" font-size="16">⚠️</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Fragile Webhooks &amp; Integration Friction</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Sync failures between Zapier, Stripe, Google Meet, and databases.</text>
      </g>
      <!-- Item 5 -->
      <g transform="translate(0, 224)">
        <text x="0" y="16" fill="#EF4444" font-size="16">🔥</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">High Risk of Project Abandonment (65%+)</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Competitors launch while you are still debugging video canvas sockets.</text>
      </g>
    </g>
  </g>

  <!-- RIGHT CARD: LAUNCHING WITH EDUFLOW OS -->
  <g transform="translate(625, 100)" filter="url(#shadowLg)">
    <rect width="515" height="390" rx="14" fill="url(#goodCardGrad)" stroke="#10B981" stroke-width="1.5" />
    
    <!-- Header -->
    <rect x="24" y="20" width="165" height="26" rx="6" fill="#065F46" />
    <text x="34" y="38" fill="#6EE7B7" font-family="sans-serif" font-size="11.5" font-weight="700">⚡ EDUFLOW OS ADVANTAGE</text>
    <text x="24" y="78" fill="#FFFFFF" font-family="sans-serif" font-size="22" font-weight="800">Turnkey Modular Monolith</text>

    <!-- Wins list -->
    <g transform="translate(24, 105)">
      <!-- Win 1 -->
      <g transform="translate(0, 0)">
        <text x="0" y="16" fill="#10B981" font-size="16">🚀</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Time-To-Market: 5 Minutes</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Instant Setup Wizard with 8 business presets ready to launch today.</text>
      </g>
      <!-- Win 2 -->
      <g transform="translate(0, 56)">
        <text x="0" y="16" fill="#10B981" font-size="16">💰</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Upfront Engineering Cost: $0 Waste</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">50 battle-tested modules and 11 Filament panels already fully built.</text>
      </g>
      <!-- Win 3 -->
      <g transform="translate(0, 112)">
        <text x="0" y="16" fill="#10B981" font-size="16">🎯</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Zero Recurring SaaS Per-Seat Tax</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Everything native: WebRTC classrooms, escrow wallets &amp; AI Bots.</text>
      </g>
      <!-- Win 4 -->
      <g transform="translate(0, 168)">
        <text x="0" y="16" fill="#10B981" font-size="16">📶</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">Integrated Biometric Hardware &amp; RTL Support</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Physical turnstiles, Arabic/Bangla Unicode PDFs &amp; 301 SEO slugs.</text>
      </g>
      <!-- Win 5 -->
      <g transform="translate(0, 224)">
        <text x="0" y="16" fill="#10B981" font-size="16">🛡️</text>
        <text x="28" y="14" fill="#F8FAFC" font-family="sans-serif" font-size="13" font-weight="700">100% Code Ownership &amp; Customizability</text>
        <text x="28" y="32" fill="#CBD5E1" font-family="sans-serif" font-size="11.5">Your servers, your database, your brand — zero platform lock-in.</text>
      </g>
    </g>
  </g>

  <!-- BOTTOM GRAND SUMMARY STRIP -->
  <g transform="translate(60, 515)" filter="url(#shadowLg)">
    <rect width="1080" height="75" rx="10" fill="url(#bannerGrad)" />
    
    <text x="40" y="34" fill="#FFFFFF" font-family="sans-serif" font-size="16" font-weight="800">NET BOTTOM-LINE SAVINGS:</text>
    <text x="40" y="56" fill="#E0E7FF" font-family="sans-serif" font-size="13">1,500+ Development Hours Saved • $120,000+ In R&amp;D Capital Preserved • 15-20 Hours/Week Admin Time Cut</text>

    <!-- Big Pill -->
    <rect x="880" y="16" width="170" height="42" rx="8" fill="#FFFFFF" />
    <text x="965" y="42" text-anchor="middle" fill="#1E1B4B" font-family="sans-serif" font-size="14" font-weight="900">ROI: 1,200%+</text>
  </g>
</svg>'''

with open(os.path.join(images_dir, "time-saver-roi.svg"), "w") as f:
    f.write(roi_svg)

print("Created time-saver-roi.svg")
