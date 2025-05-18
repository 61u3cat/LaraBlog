<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'LaraBlog')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
</head>

<body>

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">LaraBlog</h1>
            </a>

            {{-- <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li><a href="{{ url('/contact') }}"
                            class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                    <li class="dropdown">
                        <a href="#"><span>Categories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="{{ url('/category/1') }}">Category 1</a></li>
                            <li><a href="{{ url('/category/2') }}">Category 2</a></li>
                            <li><a href="{{ url('/category/3') }}">Category 3</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav> --}}
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('LaraBlog.index') }}" class="active">Home</a></li>
                    {{-- // <li><a href="single-post.html">Single Post</a></li> --}}
                    <li class="dropdown"><a href="#"><span>Categories</span> <i
                                class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            @foreach ($categorydropdown as $cat)
                                <li>
                                    <a
                                        href="{{ route('category.posts', $cat->category_slug) }}">{{ $cat->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('LaraBlog.contact') }}">Contact</a></li>
                    <li><a href="{{ route('administrator.LaraBlog.write') }}" class="">Write a Blog</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <div class="header-search-button">

                <form action="{{ route('blog.search') }}" method="GET" class="d-flex ms-3" style="max-width: 300px;">
                    <input type="text" name="q" id="search" class="form-control me-2"
                        placeholder="Search blogs or categories..." required>
                    <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>

        </div>
    </header>
