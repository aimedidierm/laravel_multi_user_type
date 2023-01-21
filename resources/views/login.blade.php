<form method="POST" action="/">
    @csrf
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="password"><br>
    <button type="submit">Submit</button>
</form>