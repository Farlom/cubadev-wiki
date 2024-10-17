<div>
    <table class="table-auto border-blue-500 border-2 border-collapse">
        <thead class="bg-white">
        <tr>
            <th class="border-blue-500 border-2">Название статьи</th>
            <th>Ссылка</th>
            <th>Размер статьи</th>
            <th>Количество слов</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($articles as $article)
            <tr>
                <th>{{ $article->title}}</th>
                <th><a href="{{ $article->url }}">{{ urldecode($article->url) }}</a></th>
                <th>{{ $article->size }} КБайт</th>
                <th>{{ $article->count }}</th>
            </tr>
        @empty
            <tr>
                <th>Список статей пуст</th>
            </tr>

        @endforelse
        <tr>

        </tr>
        </tbody>
    </table></div>
