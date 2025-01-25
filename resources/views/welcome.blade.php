<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
        }

        .blog-header {
            background-color: #ffebcd;
            padding: 2rem 0;
            text-align: center;
            color: #8b0000;
        }

        .blog-title {
            font-size: 3rem;
            font-weight: bold;
        }

        .blog-subtitle {
            font-size: 1.5rem;
            color: #556b2f;
        }

        .blog-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            box-shadow: 6px 6px 12px #d1d1d1, -6px -6px 12px #ffffff;
        }

        .blog-card img {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            background-color: #fafad2;
            color: #4b0082;
        }

        .timestamp {
            font-size: 0.9rem;
            color: #6c757d;
        }

        footer {
            background-color: #556b2f;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="blog-header">
        <h1 class="blog-title">Welcome to Thoughts Store</h1>
        <p class="blog-subtitle">Sharing thoughts, ideas, and stories</p>
    </header>
    <div class="d-flex justify-content-end bg-dark text-light">
        <a class="ms-2 text-light" href="{{ route('login') }}">Login</a>
        <a class="ms-2 text-light" href="{{ route('register') }}">Register</a>
    </div>

    <main class="container my-4">
        <div class="row g-4">
            @if (count($posts) > 0)
            @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card blog-card">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->post_tittle}}</h5>
                        <p class="timestamp">Posted on: {{ \Carbon\Carbon::parse($post->created_at)->format('F j, Y') }}</p>
                        <p class="card-text">{{$post->post_description}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <h1>No Thoughts... Try adding yout thoughts</h1>
            @endif
        </div>
    </main>

    <footer>
        <p>&copy; 2025 My Blog. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
