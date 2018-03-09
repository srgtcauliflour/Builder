<header role="header" class="header">
    <div class="container">
        <div class="nav-left">
            <a href="/dashboard" class="brand">
                <span class="icon is-medium">
                    <i class="fa fa-coffee"></i>
                </span>
                <span>
                    Builder
                </span>
            </a>
        </div>

        <nav class="nav-right">
            <? if (isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin']): ?>
            <ul>
                <li>
                    <a title="dashboard" href="/dashboard">
                        <span class="icon">
                            <i class="fa fa-th-list"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a title="create" href="/create">
                        <span class="icon">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    </a>
                </li>
                <li>
                    <a class="is-active" title="profile" href="/app">
                        <span class="icon">
                            <i class="fa fa-user-circle"></i>
                        </span>
                    </a>
                </li>
            </ul>
            <? else: ?>
            <ul>
                <li>
                    <a title="sign-in" href="/login">
                        Sign-in
                    </a>
                </li>
            </ul>
            <? endif; ?>
        </nav>
    </div>
</header>
