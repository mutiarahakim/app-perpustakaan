{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital Kampus')</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; margin: 0; color: #1f2937; }
        nav { background: #1e3a8a; padding: 14px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; }
        nav .brand { color: #fff; font-weight: bold; font-size: 18px; }
        nav ul { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        nav ul li a { color: #cbd5e1; text-decoration: none; padding: 6px 4px; }
        nav ul li a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #fff; }
        main { max-width: 900px; margin: 0 auto; padding: 30px 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px; }
        .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        form.inline { display: inline; }
        footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; border-top: 1px solid #e5e7eb; margin-top: 40px; }

        /* Badge status */
        .badge-success { background-color: #d1e7dd; color: #0f5132; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 0.85rem; }
        .badge-warning { background-color: #fff3cd; color: #664d03; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 0.85rem; }
        .badge-danger { background-color: #f8d7da; color: #842029; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 0.85rem; }

        /* Form */
        main form:not(.inline) { max-width: 520px; background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 10px; padding: 24px; margin-top: 16px; }
        main form:not(.inline) > div { margin-bottom: 16px; }
        main form:not(.inline) label { display: block; margin-bottom: 6px; font-weight: 600; color: #374151; font-size: 14px; }
        main form:not(.inline) input[type="text"],
        main form:not(.inline) input[type="number"],
        main form:not(.inline) input[type="email"],
        main form:not(.inline) input[type="password"],
        main form:not(.inline) select,
        main form:not(.inline) textarea {
            width: 100%; padding: 9px 12px; border: 1px solid #d1d5db; border-radius: 6px;
            font-size: 14px; background: #fff;
        }
        main form:not(.inline) input:focus,
        main form:not(.inline) select:focus,
        main form:not(.inline) textarea:focus {
            outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        main form:not(.inline) button[type="submit"] {
            background: #1e3a8a; color: #fff; border: none; padding: 10px 20px;
            border-radius: 6px; cursor: pointer; font-size: 14px;
        }
        main form:not(.inline) button[type="submit"]:hover { background: #1e40af; }
        main form:not(.inline) a { margin-left: 12px; color: #6b7280; text-decoration: none; font-size: 14px; }
        main form:not(.inline) a:hover { text-decoration: underline; }

        /* Dashboard (Langkah 2) */
        .stats-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .stat-card { flex: 1; min-width: 160px; background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; text-align: center; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #1e3a8a; }
        .stat-card .label { margin-top: 6px; color: #6b7280; font-size: 14px; }

        /* Pagination (Langkah 7) */
        .pagination { margin-top: 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .pagination a { color: #2563eb; text-decoration: none; }
        .pagination a:hover { text-decoration: underline; }
        .pagination .pagination-current { font-weight: bold; color: #1e3a8a; }
        .pagination .pagination-disabled { color: #9ca3af; }

        /* Navbar user & logout */
        .navbar-user { display: flex; align-items: center; gap: 12px; color: #cbd5e1; font-size: 14px; }
        .btn-logout { background: transparent; color: #fff; border: 1px solid #cbd5e1; padding: 5px 12px; border-radius: 4px; cursor: pointer; }
        .btn-logout:hover { background: rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main>
        @include('partials.alert')

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Perpustakaan Digital Kampus
    </footer>
</body>
</html>