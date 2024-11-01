<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Page Title' }}</title>

    @livewireStyles
</head>
<body>
<div class="container mx-auto">
    <div class="grid">
        <div class="grid-3">
            Sidebar
        </div>

        <div class="grid-9">
            <livewire:counter />
        </div>
    </div>

</div>

@livewireScripts
</body>
</html>
