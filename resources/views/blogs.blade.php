{{-- resources/views/blogs.blade.php --}}
    <!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Feed – Twitter/Bluesky Style</title>

    <!-- Twitter/Bluesky-like fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1"></script>

    <style>
        :root {
            --bg: #000000;
            --surface: #0e0e0e;
            --card: #16181c;
            --border: #2f3336;
            --text-primary: #e7e9ea;
            --text-secondary: #71767b;
            --accent: #1d9bf0;
            --accent-hover: #1a8cd8;
        }

        [data-theme="light"] {
            --bg: #ffffff;
            --surface: #f7f9f9;
            --card: #ffffff;
            --border: #cfd9de;
            --text-primary: #0f1419;
            --text-secondary: #536471;
            --accent: #1d9bf0;
        }

        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            line-height: 1.5;
            padding: 20px 0;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 0 16px;
        }

        h1 {
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            margin: 20px 0 40px;
            color: var(--text-primary);
        }

        .post {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 12px 16px;
            margin-bottom: 12px;
            transition: background 0.2s;
        }

        .post:hover {
            background: rgba(255,255,255,0.03);
        }

        [data-theme="light"] .post:hover {
            background: #f7f9f9;
        }

        .post-header {
            display: flex;
            gap: 12px;
            margin-bottom: 8px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #333;
            flex-shrink: 0;
            object-fit: cover;
        }

        .header-info {
            flex: 1;
            min-width: 0;
        }

        .display-name {
            font-weight: 700;
            font-size: 15px;
            color: var(--text-primary);
        }

        .username {
            color: var(--text-secondary);
            font-size: 15px;
        }

        .post-time {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .post-content {
            margin: 8px 0 12px;
            font-size: 15px;
            word-wrap: break-word;
        }

        .post-title {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .post-actions {
            display: flex;
            justify-content: space-between;
            max-width: 425px;
            margin-top: 12px;
        }

        .action {
            display: flex;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
            font-size: 13px;
            cursor: pointer;
            padding: 8px;
            border-radius: 9999px;
            transition: all 0.2s;
        }

        .action:hover {
            background: rgba(29, 155, 240, 0.1);
            color: var(--accent);
        }

        .action.like:hover   { background: rgba(249, 24, 128, 0.1); color: #f918e9e; }
        .action.repost:hover { background: rgba(0, 186, 124, 0.1); color: #00ba7c; }
        .action.bookmark:hover { background: rgba(29, 155, 240, 0.1); color: var(--accent); }

        .action i { font-size: 18px; }

        .external-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        .external-link:hover {
            text-decoration: underline;
        }

        /* Simple theme toggle (optional) */
        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Dev Feed</h1>

    <!-- All feeds + blogs in one chronological timeline -->
    @foreach(array_merge(
        array_map(fn($f) => array_merge($f, ['type' => 'feed'] ), $feeds),
        array_map(fn($b) => array_merge($b, ['type' => 'blog'] ), $blogs)
    ) as $item)

        <div class="post">
            <div class="post-header">
                <img src="{{ $item['avatar'] ?? 'https://api.dicebear.com/7.x/identicon/svg?seed=' . urlencode($item['title']) }}"
                     alt="avatar" class="avatar">

                <div class="header-info">
                    <div class="display-name">{{ $item['title'] ?? 'Unknown' }}</div>
                    <div class="username">@{{ Str::slug($item['title'] ?? 'unknown') }}</div>
                </div>

                <div class="post-time">
                    {{ $item['updated'] ?? now()->diffForHumans() }}
                </div>
            </div>

            <div class="post-content">
                @if(($item['type'] ?? null) === 'feed')
                    <div class="post-title">New posts on this RSS feed</div>
                    <p>Follow the latest articles and updates.</p>
                @else
                    <div class="post-title">New blog post published</div>
                    <p>Check out the latest article on this dev blog.</p>
                @endif

                <a href="{{ $item['url'] }}" target="_blank" class="external-link">
                    {{ $item['url'] }}
                </a>
            </div>

            <div class="post-actions">
                <div class="action reply">
                    <i class="ph ph-chat-circle"></i>
                    <span>12</span>
                </div>
                <div class="action repost">
                    <i class="ph ph-repeat"></i>
                    <span>8</span>
                </div>
                <div class="action like">
                    <i class="ph ph-heart"></i>
                    <span>67</span>
                </div>
                <div class="action bookmark">
                    <i class="ph ph-bookmark-simple"></i>
                </div>
            </div>
        </div>
    @endforeach

</div>

<!-- Optional theme toggle -->
<div class="theme-toggle" onclick="document.documentElement.dataset.theme = document.documentElement.dataset.theme === 'light' ? 'dark' : 'light'">
    <i class="ph ph-moon"></i> / <i class="ph ph-sun"></i>
</div>

</body>
</html>
