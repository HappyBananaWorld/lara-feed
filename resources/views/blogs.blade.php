{{-- resources/views/blogs.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Feed</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        body {
            font-family: 'Fredoka', sans-serif;
            background: #f9f5ff; /* روشن و بنفش روشن */
            color: #4a148c; /* متن اصلی بنفش تیره */
            line-height: 1.6;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 3rem;
            color: #7e57c2; /* عنوان بنفش شفاف */
            background: linear-gradient(90deg, #b39ddb, #7e57c2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .blog-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .blog-card {
            background: #f3e5f5; /* پس‌زمینه روشن و بنفش پاستلی */
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 20px rgba(158, 0, 255, 0.2);
            transform: translateY(0);
            opacity: 0;
            animation: fadeInUp 0.8s forwards;
        }

        .blog-card h3 {
            color: #6a1b9a; /* بنفش تیره */
            margin-bottom: 1rem;
            font-size: 1.6rem;
        }

        .blog-card a {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #ba68c8; /* دکمه بنفش */
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(186, 104, 200, 0.3);
        }

        .blog-card a:hover {
            background: #9c27b0;
            transform: translateY(-2px);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Responsive tweaks */
        @media (max-width: 600px) {
            body {
                padding: 1rem;
            }

            h1 {
                font-size: 2.4rem;
            }

            .blog-card h3 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

<h1>Feeds</h1>
@foreach($feeds as $blog)
    <div class="blog-card" style="display: flex; justify-content: space-between; align-items: center;margin-top: 10px;">
        <h3>{!! $blog['title'] ?? null !!}</h3>
        <a href="{{$blog['url']}}" target="_blank">Follow</a>
    </div>
@endforeach

<hr />
<h1>Blogs</h1>
<div class="blog-container">
    @foreach($blogs as $blog)
        <div class="blog-card">
            <h3>{!! $blog['title'] ?? null !!}</h3>
            <a href="{{$blog['url']}}" target="_blank">Visit Blog</a>
        </div>
    @endforeach
</div>
</body>
</html>
