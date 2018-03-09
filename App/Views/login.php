@extends('main.php', 'content');

<div class="page login">
    <form method="post" action="/login" class="login-form">
        <h3 class="title is-3 is-fullwidth">Sign in</h3>
        <div class="field has-addons">
            <div class="control has-icons-left token-input">
                <input placeholder="token" type="password" name="user[token]" id="token" class="input">
                <span class="icon is-left">
                    <i class="fa fa-key"></i>
                </span>
            </div>
            <div class="control">
                <button type="submit" class="button is-info">Sign-in</button>
            </div>
        </div>
    </form>
</div>
