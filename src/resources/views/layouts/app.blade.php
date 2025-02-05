<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', '')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @stack('css')
</head>

<body>
    <header class="header">
        <div class="header-wrapper">
            <h1 class="header-logo">
                <div class="toggle_btn">☰</div>
                <div id="mask">
                    <button id="close_btn" class="close_btn">×</button>
                    <nav id="navi" class="nav-wrapper">
                        @guest
                            <ul class="menu">
                                <li class="menu_item"><a href="">HOME</a></li>
                                <li class="menu_item"><a href="{{ route('register.show') }}">Registration</a></li>
                                <li class="menu_item"><a href="{{ route('auth.store') }}">Login</a></li>
                            </ul>
                        @endguest

                        @auth
                            <ul class="menu">
                                <li class="menu_item"><a href="">HOME</a></li>
                                <li class="menu_item">
                                    <form action="{{ route('auth.destroy') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="logout-button">Logout</button>
                                    </form>
                                </li>
                                <li class="menu_item"><a href="">MyPage</a></li>
                            </ul>
                        @endauth
                    </nav>
                </div>
                <a href=""><span class="site-name">Rese</span></a>
            </h1>
            @auth
                @if (request()->routeIs('shop.index'))
                    <form action="{{ route('shop.index') }}" method="GET">
                        @csrf
                        <div class="search-bar">
                            <select name="area_id">
                                <option>All area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}"
                                        {{ request('area_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            <select name="genre_id">
                                <option>All genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}"
                                        {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                @endforeach
                            </select>
                            <button class="fa-solid fa-search"></button>
                            <input type="text" name="keyword" placeholder="Search ..." value="{{ request('keyword') }}">
                        </div>
                    </form>
                @endif
            @endauth
        </div>
    </header>
    @yield('content')
    <footer class="footer"></footer>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtns = document.querySelectorAll('.toggle_btn'); // 全てのtoggle_btnを取得
        const mask = document.getElementById('mask');
        const closeBtn = document.getElementById('close_btn');
        const menuItems = document.querySelectorAll('.menu_item'); // メニューアイテムを選択

        // ハンバーガーメニューを開く
        toggleBtns.forEach(function(toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                mask.classList.add('open');
            });
        });

        // 閉じるボタンを押すと閉じる
        closeBtn.addEventListener('click', function() {
            mask.classList.remove('open');
        });

        // 背景をクリックしても閉じる
        mask.addEventListener('click', function(e) {
            if (e.target === mask) {
                mask.classList.remove('open');
            }
        });

        // メニューアイテムをクリックしても閉じる
        menuItems.forEach(function(item) {
            item.addEventListener('click', function() {
                mask.classList.remove('open');
            });
        });
    });
</script>

<script>
    // 各要素の取得
    const dateInput   = document.getElementById('dateInput');
    const timeSelect  = document.getElementById('timeSelect');
    const peopleSelect = document.getElementById('peopleSelect');

    const dateTd   = document.getElementById('dateTd');
    const timeTd   = document.getElementById('timeTd');
    const peopleTd = document.getElementById('peopleTd');

    // 選択/入力内容を<td>に表示する関数
    function updateDisplay() {
      dateTd.textContent   = dateInput.value;
      timeTd.textContent   = timeSelect.value;
      peopleTd.textContent = peopleSelect.value;
    }

    // 各要素の値が変わったタイミングでupdateDisplayを実行
    dateInput.addEventListener('change', updateDisplay);
    timeSelect.addEventListener('change', updateDisplay);
    peopleSelect.addEventListener('change', updateDisplay);

    // ページ読み込み時に初期表示も更新
    updateDisplay();
  </script>
