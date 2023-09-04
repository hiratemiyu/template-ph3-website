<!DOCTYPE html>
<html>
<head>
    @vite('resources/css/app.css')
    <script src="{{ asset('/scripts/common.js')}}" defer></script>
    <title>クイズ一覧</title>
</head>
<body>

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        {{-- sp用 --}}
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
        {{-- sp用 --}}

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-black bg-blue-700 rounded md:bg-transparent md:text-black md:p-0 dark:text-white md:dark:text-white" aria-current="page">クイズ一覧</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-[50px]">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    クイズ名
                </th>
                <th scope="col" class="px-6 py-3">
                    詳細
                </th>
                <th scope="col" class="px-6 py-3">
                    編集
                </th>
                <th scope="col" class="px-6 py-3">
                    削除
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <h3>{{ $quiz->name}}</h3>
                    </th>
                    <td class="px-6 py-4">
                            <a  href="http://localhost/quizzes/{{ $quiz->id }}">詳細</a>
                    </td>
                    <td class="px-6 py-4">
                        <a href="http://localhost/quizzes/{{ $quiz->id }}/edit">編集</a>
                    </td>
                    <td class="px-6 py-4">
                        {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-quiz-id="{{ $quiz->id }}" type="button"> --}}
                            {{-- data-quiz-id="{{ $quiz->id }}を消す → data-modal-target="popup-modal-{{ $quiz->id }}"に変更 --}}
                        <button data-modal-target="popup-modal-{{ $quiz->id }}" data-modal-toggle="popup-modal-{{ $quiz->id }}" type="button">
                            削除
                        </button>
                    </td>
                </tr>
        </tbody>

            {{-- モーダル --}}
            <div id="popup-modal-{{ $quiz->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 bottom-0 z-50 hidden flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full bg-black bg-opacity-50">
                <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $quiz->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">このクイズを削除しますか？</h3>
                            {{-- <div>{{ $quiz->id }}</div> --}}
                            <div class="flex justify-center">
                            {{-- <form action="{{route('quizzes.destroy',$quiz->id)}}" method="POST"> --}}
                                {{-- id="delete-form-{{ $quiz->id }} を追加 --}}
                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" id="delete-form-{{ $quiz->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        削除
                                    </button>
                                </form>
                                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- モーダル --}}
            @endforeach
            <!-- モーダルの後にこれを追加 -->
            @if (session('status'))
            <div id="status-modal" tabindex="-1" class="fixed top-0 left-0 right-0 bottom-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto max-h-full bg-black bg-opacity-50">
                <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow">
                    <div class="p-6 text-center">
                        <h3 class="mb-5 text-lg font-normal text-gray-500">{{ session('status') }}</h3>
                        <button onclick="document.getElementById('status-modal').style.display='none'" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            OK
                        </button>
                    </div>
                </div>
            </div>
            @endif

    </table>
</div>




    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

</body>
</html>