<div>
    <div class="flex flex-col">
        <div class="flex flex-row gap-5">
            <input
                class="p-2 rounded-2xl border-2 border-white w-48  focus:outline-0 focus:placeholder:text-sm @error('title') border-red-500/50 @enderror"
                type="text" wire:model="title" placeholder="Название статьи">
            <button
                class="transition ease-in-out duration-300 w-32 bg-blue-400 text-white rounded-2xl p-2 hover:bg-blue-300 active:bg-blue-200"
                wire:click="import">Скопировать
            </button>
        </div>
        <div>
            @forelse($errors->all() as $error)
                <p class="text-red-500">
                    {{ $error }}
                </p>
            @empty
            @endforelse
        </div>
    </div>

    @if($article)
        <div class="flex flex-col mt-5">
            <p class="font-bold">
                Импорт завершен
            </p>
            <p>
                Найдена статья по адресу: <a href="{{ $article->url }}">{{ urldecode($article->url) }}</a>
            </p>
            <p>
                Время обработки: {{ $time }} сек
            </p>
            <p>
                Размер статьи: {{ $article->size }} КБайт
            </p>
            <p>
                Количество слов: {{ $article->count }}
            </p>
        </div>
    @endif
</div>
