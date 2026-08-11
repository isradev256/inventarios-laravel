<!-- ========================================
     🔥 SCRIPT CRÍTICO: Cargar tema ANTES de todo
     DEBE IR PRIMERO, antes de cualquier CSS
     ======================================== -->
<script>
    (function() {
        const savedTheme = localStorage.getItem('minible-theme');
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.documentElement.setAttribute('data-topbar', 'dark');
            document.documentElement.setAttribute('data-sidebar', 'dark');
        } else if (savedTheme === 'light') {
            document.documentElement.setAttribute('data-bs-theme', 'light');
            document.documentElement.setAttribute('data-topbar', 'light');
            document.documentElement.setAttribute('data-sidebar', 'light');
        }
    })();
</script>

<!-- ========================================
     🎨 CSS CRÍTICO: Prevenir flash blanco
     ======================================== -->
<style>
    html[data-bs-theme="dark"] {
        background-color: #222736 !important;
    }

    html[data-bs-theme="dark"] body {
        background-color: #222736 !important;
        color: #ced4da !important;
    }
</style>

@yield('css')
<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.css')}}" id="icons-style" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.css')}}" id="app-style" rel="stylesheet" type="text/css" />
