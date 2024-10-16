<!DOCTYPE html>
<html>
<head>
    <title>
        wiki
    </title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col">
<header class="text-white bg-blue-400 mx-20 my-5 rounded-2xl p-5 sticky">
    <nav class="mx-auto flex items-center">
        <div class="flex flex-1 w-full items-center">
            logo
        </div>
        <div class="flex flex-2 w-full justify-center gap-5">
            <div>
                <a href="#import">
                    Импорт статей
                </a>
            </div>
            <div>
                <a href="#search">
                    Поиск
                </a>
            </div>
        </div>
        <div class="flex flex-1">
            git
        </div>
    </nav>
</header>

<div id="import" class="bg-blue-100 mx-10 mb-3 h-auto p-10 rounded-2xl flex flex-col">
    <h1>Импорт статей</h1>
    <div class="flex flex-row gap-5">
        <div class="flex flex-1">
            <input type="text">
            @livewire('import-tab')
        </div>
        <div class="flex flex-1 bg-white rounded-2xl">
            123
        </div>
    </div>
    <div>
        123
    </div>
</div>
<div id="search" class="bg-blue-100 mx-10 h-auto p-10 rounded-2xl flex flex-col">
    <div>
        123
    </div>
</div>
</body>
</html>
