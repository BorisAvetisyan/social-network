<form action="{{ route('auth.login') }}" method="post">
    {{ csrf_field() }}
    <input type="text" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">

    <button type="submit">Login</button>
</form>
