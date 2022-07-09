@php
    $pageTitle = empty(app()->view->getSections()['pageTitle']) ? 'Tasks Application' : app()->view->getSections()['pageTitle'];
    $pageDescription = (app()->view->getSections()['pageDescription']);
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$pageTitle}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/framework.css') }}">
</head>

<body>

    <section class="home-title">
        <div class="container">
            <h2>{!! $pageTitle !!}</h2>
            <p>{!! $pageDescription !!}</p>
        </div>
    </section>
    <section class="actions">
        <div class="container">
            <div class="text-center">
                <ul>
                    <li><a href="{{ route('site.home') }}"><i class="fas fa-home"></i></a></li>
                    <li><a href="{{ route('site.tasks.create') }}">Add Task</a></li>
                    <li><a href="{{ route('site.projects.create') }}">Add Project</a></li>
                    <li><a href="{{ route('site.tasks.list') }}">Task List</a></li>
                    <li><a href="{{ route('site.projects.list') }}">Project List</a></li>
                    <li><a href="{{ route('login.logout') }}"><i class="fas fa-sign-out-alt"></i></a></li>
                </ul>
            </div>
        </div>
    </section>

    @yield('content')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
