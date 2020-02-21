<!doctype html>
<html lang="en" class="h-100">

<head>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="dark-mode.css">
</head>

<body class="bg-white text-center d-flex h-100">
<div id="app">
    <div class="container d-flex p-3 mx-auto flex-column">
        <header class="mb-auto">
            <h3 class="float-left">Dark Mode Switch</h3>
            <nav class="nav justify-content-center float-right">
                <a class="nav-link active" href="https://coliff.github.io/dark-mode-switch/">Home</a>
                <a class="nav-link" href="https://github.com/coliff/dark-mode-switch" target="_blank">GitHub</a>
                <div class="nav-link">

                    <div class="custom-control custom-switch">
                        <input type="checkbox" v-model="darkSwitch" class="custom-control-input" id="darkSwitch">
                        <label class="custom-control-label"  for="darkSwitch">Dark Mode</label>
                    </div>

                </div>
            </nav>
        </header>

        <main role="main">
            <h1>🌓 Dark Mode Switch</h1>
            <p class="lead">Add a dark-mode theme switch with a Bootstrap Custom Switch</p>
            <ul class="list-unstyled">
                <li>&middot; Uses local storage to save preference</li>
                <li>&middot; Only 262 Bytes minified and gzipped!</li>
            </ul>
            <p>
                <a href="https://github.com/coliff/dark-mode-switch" target="_blank" rel="noopener"
                   class="btn btn-lg btn-secondary">
                    Learn more
                </a>
            </p>
        </main>

        <footer class="mt-auto">
            <p>&copy; 2019</p>
        </footer>

    </div>
</div>
</body>

</html>
