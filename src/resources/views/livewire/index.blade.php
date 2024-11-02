<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="container mx-auto">
        <div class="grid grid-cols-12">
            <div class="col-span-2 bg-zinc-900 p-5">
                <ul class="list-none text-white">
                    <li class="title-main"><a href="javascript:void(0);">ANALYTICS</a></li>
                    <li class="item-side" style="border-color: #383838 !important;" id="analytics-page">
                        <span> <a href="https://razernexus.com/dashboard" class="text-brand"> <i
                                    class="fa-solid fa-chart-line fa-fw mx-2"></i>Analytics </a> </span></li>
                    <li class="title-main"><a href="javascript:void(0);">PRODUCT</a></li>
                    <li class="item-side" id="product-page"><span> <a href="https://razernexus.com/dashboard/products"
                                                                      class=""> <i
                                    class="fa-regular fa-list-alt fa-fw mx-2"></i>Pages </a> </span></li>
                    <li class="item-side" id="prod-fl-page"><span> <a
                                href="https://razernexus.com/dashboard/products-fl" class=""> <i
                                    class="fa-regular fa-dot-circle fa-fw mx-2"></i>Pages - FL </a> </span></li>
                    <li class="item-side" id="articles-page"><span> <a href="https://razernexus.com/dashboard/assets"
                                                                       class=""> <i
                                    class="fa-regular fa-file-alt fa-fw mx-2"></i>Articles </a> </span></li>
                    <li class="item-side" id="alerts-page"><span> <a href="https://razernexus.com/dashboard/alerts"
                                                                     class=""> <i
                                    class="fa-solid fa-exclamation-triangle mx-2 fa-fw"></i>Alerts </a> </span></li>
                    <li class="item-side" id="product-feeds-page"><span> <a
                                href="https://razernexus.com/dashboard/product-feeds" class=""> <i
                                    class="fa-solid fa-rss mx-2 fa-fw"></i>Product Feeds </a> </span></li>
                    <li class="item-side"><span> <a href="https://razernexus.com/dashboard/specification" class=""> <i
                                    class="fa-solid fa-columns mx-2 fa-fw"></i>Specifications </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">PUBLISH</a></span></li>
                    <li class="item-side" id="announcements-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/announcements" class=""> <i
                                    class="fa-solid fa-bullhorn mx-2 fa-fw"></i>Announcements </a> </span></li>
                    <li class="item-side" id="processes-page"><span> <a
                                href="https://razernexus.com/dashboard/processes" class=""> <i
                                    class="fa-solid fa-cogs mx-2 fa-fw"></i>Processes </a> </span></li>
                    <li class="item-side" id="support-resources-page"><span> <a
                                href="https://razernexus.com/dashboard/support-resources" class=""> <i
                                    class="fa-solid fa-link mx-2 fa-fw"></i>Support Resources </a> </span></li>
                    <li class="item-side"><span> <a href="https://razernexus.com/dashboard/tstree" class=""> <i
                                    class="fa-solid fa-tree mx-2 fa-fw"></i>Troubleshooter </a> </span></li>
                    <li class="item-side" id="dist-list-page"><span> <a
                                href="https://razernexus.com/dashboard/distributor-list" class=""> <i
                                    class="fa-solid fa-list-ul mx-2 fa-fw"></i>Distributor List </a> </span></li>
                    <li class="item-side" id="resources-page"><span> <a href="https://razernexus.com/resources"
                                                                        class=""> <i
                                    class="fa-solid fa-database fa-fw mx-2"></i>Resources </a> </span></li>
                    <li class="item-side" id="feedback-page"><span> <a href="https://razernexus.com/dashboard/feedbacks"
                                                                       class=""> <i
                                    class="fa-solid fa-comment-dots mx-2 fa-fw"></i>Feedbacks </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">SERVICE REQUEST</a></span></li>
                    <li class="item-side"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/tickets" class=""> <i
                                    class="fa-solid fa-phone-volume mx-2 my-2 fa-fw"></i>Service Requests <span
                                    class="badge badge-danger badge-pill counter">35</span> </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">MACHINE</a></span></li>
                    <li class="item-side" id="promo-code-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/promo-codes" class=""> <i
                                    class="fa-solid fa-money-bill mx-2 fa-fw"></i>Coupon Code </a> </span></li>
                    <li class="item-side" id="validation-tool-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/validation-tool" class=""> <i
                                    class="fa-solid fa-barcode mx-2 fa-fw"></i>Serial Lookup </a> </span></li>
                    <li class="item-side" id="lms-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/lms/courses" class=""> <i
                                    class="fa-solid fa-book-open mx-2 my-2 fa-fw"></i>LMS </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">GAMIFICATION</a></span></li>
                    <li class="item-side" id="game-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/game" class=""> <i
                                    class="fa-solid fa-gamepad mx-2 my-2 fa-fw"></i>Game </a> </span></li>
                    <li class="item-side" id="badge-page"><span style="text-align: center !important;"> <a
                                href="https://razernexus.com/dashboard/badges" class=""> <i
                                    class="fa-solid fa-ribbon mx-2 my-2 fa-fw"></i>Badges </a> </span></li>
                    <li class="item-side"><span> <a href="https://razernexus.com/dashboard/quiz" class=""> <i
                                    class="fa-solid fa-pencil-alt mx-2 fa-fw"></i>Quiz </a> </span></li>
                    <li class="item-side"><span> <a href="https://razernexus.com/dashboard/quiz-result" class=""> <i
                                    class="fa-solid fa-book-open mx-2 fa-fw"></i>Quiz Results </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">USER</a></span></li>
                    <li class="item-side" id="users-page"><span> <a href="https://razernexus.com/dashboard/users"
                                                                    class=""> <i
                                    class="fa-regular fa-user mx-2 my-2 fa-fw"></i>Profiles </a> </span></li>
                    <li class="item-side" id="roles-page"><span> <a href="https://razernexus.com/dashboard/roles"
                                                                    class=""> <i class="fa-solid fa-id-card mx-2 fa-fw"></i>Roles </a> </span>
                    </li>
                    <li class="item-side" id="login-as-page"><span> <a href="https://razernexus.com/dashboard/login-as"
                                                                       class=""> <i
                                    class="fa-solid fa-sign-in-alt mx-2 fa-fw"></i>Log in as </a> </span></li>
                    <li class="title-main"><span><a href="javascript:void(0);">ADMIN</a></span></li>
                    <li class="item-side"><span> <a href="https://razernexus.com/dashboard/organizations" class=""> <i
                                    class="fa-solid fa-sitemap mx-2 my-2 fa-fw"></i>Organizations </a> </span></li>
                    <li class="item-side" id="languages-page"><span> <a
                                href="https://razernexus.com/dashboard/languages" class=""> <i
                                    class="fa-solid fa-globe mx-2 fa-fw"></i>Languages </a> </span></li>
                    <li class="item-side" id="enjoyhint-page"><span> <a
                                href="https://razernexus.com/dashboard/enjoyhint" class=""> <i
                                    class="fa-solid fa-lightbulb mx-2 fa-fw"></i>Enjoyhint </a> </span></li>
                    <li class="item-side" id="ratings-page"><span> <a href="https://razernexus.com/dashboard/ratings"
                                                                      class=""> <i class="fa-solid fa-star mx-2 fa-fw"></i>Ratings </a> </span>
                    </li>
                    <li class="item-side" id="login-announcements-page"><span> <a
                                href="https://razernexus.com/dashboard/login-announcements" class=""> <i
                                    class="fa-solid fa-sign mx-2 fa-fw"></i>Login Announcements </a> </span></li>
                    <li class="item-side" id="reports-page"><span> <a href="https://razernexus.com/dashboard/reports"
                                                                      class=""> <i
                                    class="fa-solid fa-database mx-2 fa-fw"></i>Reports </a> </span></li>
                    <li class="item-side" id="logs-page"><span> <a href="https://razernexus.com/dashboard/logs"
                                                                   class=""> <i class="fa-solid fa-archive mx-2 fa-fw"></i>Logs </a> </span>
                    </li>
                </ul>
            </div>

            <div class="col-span-10 bg-rose-50 p-5">
                <div>QWE</div>
                <div>
                    <livewire:counter />
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
