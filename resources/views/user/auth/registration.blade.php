<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <title>إنشاء حساب</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Local CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>
<body>
<div class="auth-container">
    <h3>إنشاء حساب جديد</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" required autofocus />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="email" name="email" required />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">تسجيل</button>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}">هل لديك حساب؟ تسجيل الدخول</a>
        </div>
    </form>
</div>

<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
