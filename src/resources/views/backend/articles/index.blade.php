@php
    use App\Models\Article;

    $sidebarConfig = [
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'analytics', 'href' => '#', 'fa' => 'fa-solid fa-chart-line'],
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'products', 'href' => '#', 'fa' => 'fa-solid fa-list'],
        ['name' => 'products FL', 'href' => '#', 'fa' => 'fa-solid fa-dot-circle'],
        ['name' => 'articles', 'href' => route('articles.index'), 'fa' => 'fa-solid fa-file-alt'],
        ['name' => 'product feeds', 'href' => '#', 'fa' => 'fa-solid fa-rss'],
        ['name' => 'specifications', 'href' => '#', 'fa' => 'fa-solid fa-columns'],
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'announcements', 'href' => '#', 'fa' => 'fa-solid fa-bullhorn'],
        ['name' => 'processes', 'href' => '#', 'fa' => 'fa-solid fa-cogs'],
        ['name' => 'support resources', 'href' => '#', 'fa' => 'fa-solid fa-link'],
        ['name' => 'troubleshooter', 'href' => '#', 'fa' => 'fa-solid fa-tree'],
        ['name' => 'distributor list', 'href' => '#', 'fa' => 'fa-solid fa-list'],
        ['name' => 'resources', 'href' => '#', 'fa' => 'fa-solid fa-database'],
        ['name' => 'feedbacks', 'href' => '#', 'fa' => 'fa-solid fa-comment'],
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'service requests', 'href' => '#', 'fa' => 'fa-solid fa-phone'],
        ['name' => 'machine', 'href' => '#', 'fa' => 'fa-solid fa-money-bill'],
        ['name' => 'coupon code', 'href' => '#', 'fa' => 'fa-solid fa-barcode'],
        ['name' => 'serial lookup', 'href' => '#', 'fa' => 'fa-solid fa-book-open'],
        ['name' => 'lms', 'href' => '#', 'fa' => 'fa-solid fa-book'],
        ['name' => '', 'href' => '#', 'fa' => 'fa-solid fa-ribbon'],
        ['name' => 'game', 'href' => '#', 'fa' => 'fa-solid fa-gamepad'],
        ['name' => 'badges', 'href' => '#', 'fa' => 'fa-solid fa-pencil'],
        ['name' => 'quiz', 'href' => '#', 'fa' => 'fa-solid fa-book'],
        ['name' => 'quiz results', 'href' => '#', 'fa' => 'fa-solid fa-book-open'],
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'profiles', 'href' => '#', 'fa' => 'fa-solid fa-user'],
        ['name' => 'roles', 'href' => '#', 'fa' => 'fa-solid fa-id-card'],
        ['name' => 'login as', 'href' => '#', 'fa' => 'fa-solid fa-sign-in'],
        ['name' => '', 'href' => '#', 'fa' => ''],
        ['name' => 'organizations', 'href' => '#', 'fa' => 'fa-solid fa-sitemap'],
        ['name' => 'languages', 'href' => '#', 'fa' => 'fa-solid fa-globe'],
        ['name' => 'enjoyhint', 'href' => '#', 'fa' => 'fa-solid fa-lightbulb'],
        ['name' => 'ratings', 'href' => '#', 'fa' => 'fa-solid fa-star'],
        ['name' => 'login announcements', 'href' => '#', 'fa' => 'fa-solid fa-sign'],
        ['name' => 'reports', 'href' => '#', 'fa' => 'fa-solid fa-database'],
        ['name' => 'logs', 'href' => '#', 'fa' => 'fa-solid fa-archive'],
    ];
@endphp

<!doctype html>
{{-- set html tag to 'dark', display: none as default --}}
{{-- the display: none aids in the FOUC issue, but may pose a challenge to using skeletons --}}
<html lang="en" class="dark" style="display: none;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
<div class="container mx-auto">
    <div class="grid grid-cols-12">
        <div class="col-span-2 p-5">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <i class="fa-solid fa-bars fa-fw h-4 w-4"></i>
            </button>

            <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto bg-zinc-100 dark:bg-slate-900">
                    <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name')  }}</span>
                    </a>
                    <ul class="space-y-2 font-medium pb-16">
                        @foreach ($sidebarConfig as $config)
                            @if ($config['name'] === '')
                                <hr>
                            @else
                            <li>
                                <a href="{{ $config['href'] }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                    <i class="{{ $config['fa'] }} fa-fw"></i>
                                    <span class="ms-3">{{ ucwords($config['name']) }}</span>
{{--                                    notice below, if implement as necessary --}}
{{--                                    <span class="flex-1 ms-3 whitespace-nowrap">{{ ucwords($config['name']) }}</span>--}}
{{--                                    <span class="inline-flex items-center justify-center px-2 ms-3 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>--}}
{{--                                    <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>--}}
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </aside>

        </div>

        <div class="col-span-10 bg-rose-50 dark:bg-slate-500 dark:text-white p-5 pb-16">
            <div class="flex flex-row-reverse items-center">
                <div id="headerUserDropdownMenuContainer">
                    <button data-dropdown-toggle="headerUserDropdownMenu" class="mx-5 flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white" type="button">
                        <img class="w-8 h-8 me-2 rounded-full" src="https://images.pexels.com/photos/2690323/pexels-photo-2690323.jpeg" alt="{{ auth()->user()->email }}">
                        {{ auth()->user()->email }}
                        <i class="fa-solid fa-chevron-down fa-fw"></i>
                    </button>

                    <div id="headerUserDropdownMenu" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium ">{{ auth()->user()->name }}</div>
                            <div class="truncate">{{ auth()->user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Notifications</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </div>
                    </div>
                </div>

                <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 inline-flex items-center justify-center dark:text-gray-400 hover:bg-gray-100 w-10 h-10 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <div id="theme-toggle-light-icon"><i class="fa-solid fa-sun fa-fw h-4 w-4 text-orange-400"></i></div>
                    <div id="theme-toggle-dark-icon"><i class="fa-solid fa-moon fa-fw h-4 w-4 text-amber-400"></i></div>

                    <span class="sr-only">Toggle dark mode</span>
                </button>
                <div id="tooltip-toggle" role="tooltip" class="absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm tooltip opacity-0 invisible" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(1228.8px, -60.8px, 0px);" data-popper-placement="top">
                    Toggle dark mode
                    <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(68.8px, 0px, 0px);"></div>
                </div>

                <a href="#" class="mx-5">Home</a>

            </div>

            <h1 class="text-black dark:text-white text-2xl border-gray-600 border-b-4 py-2 mb-4">
                <i class="{{ Article::$faIcon }} fa-fw"></i> {{ Article::$pageHeader }}
            </h1>

            <table class="table-auto border-collapse border border-slate-500">
                <thead>
                    <tr>
                        <th class="border border-slate-600 p-2">ID</th>
                        <th class="border border-slate-600 p-2">Title</th>
                        <th class="border border-slate-600 p-2">Head</th>
                        <th class="border border-slate-600 p-2">Body</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr class="hover:bg-lime-100 hover:text-black">
                            <td class="border border-slate-700 p-2">{{ Str::of($article->id)->padLeft(6, 0) }}</td>
                            <td class="border border-slate-700 p-2">{{ Str::of($article->title)->limit(32) }}</td>
                            <td class="border border-slate-700 p-2">{{ Str::of($article->head)->limit(128) }}</td>
                            <td class="border border-slate-700 p-2">{{ Str::of($article->body)->limit(128) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-4">
                {{ $articles->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>

@livewireScripts
</body>
</html>
