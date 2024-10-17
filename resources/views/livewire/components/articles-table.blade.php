<div>
    <table class="table-auto rounded-2xl bg-white">
        <thead class="bg-blue-400 text-white">
        <tr class="">
            <th class="rounded-l-2xl p-2">Название статьи</th>
            <th class="p-2">Ссылка</th>
            <th class="p-2">Размер статьи</th>
            <th class="p-2 rounded-r-2xl">Количество слов</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($articles as $article)
            <tr>
                <th class="font-normal">
                    {{ $article->title}}
                </th>
                <th class="font-normal">
                    <a href="{{ $article->url }}">
                        {{ urldecode($article->url) }}
                    </a>
                </th>
                <th class="font-normal">
                    {{ $article->size }} КБайт
                </th>
                <th class="font-normal">
                    {{ $article->count }}
                </th>
            </tr>
        @empty
            <tr>
                <th>Список статей пуст</th>
            </tr>

        @endforelse
        <tr>

        </tr>
        </tbody>
    </table>
</div>
