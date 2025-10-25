<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <title>تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Local CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
<div class="auth-container">
    <h3>تسجيل الدخول</h3>
    <form method="POST" action="{{ route('post_login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" />
            <label class="form-check-label" for="remember">تذكرني</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">دخول</button>
        <div class="text-center mt-3">
            <a href="{{ route('post_register') }}">ليس لديك حساب؟ سجل الآن</a>
        </div>
    </form>
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
