<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BioRepository') | Dashboard</title>

    <!-- Bootstrap core CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">

    <link href="/libs/node-waves/waves.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <link href="/libs/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Iconify Web Component -->
    <script src="/js/iconify-icon.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="/css/multiform.css" rel="stylesheet">

    <!-- select2 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
   
    @livewireStyles
    @stack('css')

</head>

<body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">
        @include('dashboard.layouts.notification')
        @include('dashboard.layouts.header')
        @include('dashboard.layouts.sidebar2')
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">@yield('title', 'BioRepository')</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                @hasSection('breadcrumb')
                                    @yield('breadcrumb')
                                @else
                                    @php $segments = request()->segments(); @endphp
                                    @foreach($segments as $key => $segment)
                                        @php
                                            $isLast = $key === count($segments) - 1;
                                            $path = implode('/', array_slice($segments, 0, $key + 1));
                                            $url = url($path);
                                            $name = ucwords(str_replace(['-', '_'], ' ', $segment));
                                        @endphp
                                        <li class="breadcrumb-item {{ $isLast ? 'active' : '' }}" @if($isLast) aria-current="page" @endif>
                                            @if(!$isLast)
                                                <a href="{{ $url }}">{{ $name }}</a>
                                            @else
                                                {{ $name }}
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ol>
                        </div>
                    </div>
                    <div class="content">
                        @yield('container')
                    </div>

                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - <a href="https://brin.go.id/orei/pusat-riset-komputasi/page/kontak-pusat-riset-komputasi" class="text-reset fw-semibold">Research Center for Computing</a> 
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="bsConfirmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center">
                    <div class="spinner-grow text-secondary d-none mx-auto" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h6 class="modal-text"></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary bt-confirm">Continue</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="bsToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                Hello, world! This is a toast message.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Jquery UI -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script> -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
 
    <script src="/js/head.js"></script>
    <script src="/libs/simplebar/simplebar.min.js"></script>
    <!-- feather icons js -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <!-- Waves (click-effect) library required by app.js -->
    <script src="/libs/node-waves/waves.min.js"></script>
    <script src="/js/app.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="/js/dashboard.js"></script> --}}

    <!-- select2 js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <!-- Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script type='text/javascript'>

        const bsConfirmModal = new bootstrap.Modal(document.getElementById("bsConfirmModal"), {});
        const bsToast = new bootstrap.Toast(document.querySelector('#bsToast'), {})
        const bsConfirmModalTitle  = document.querySelector("#bsConfirmModal .modal-title")
        const bsConfirmModalText = document.querySelector("#bsConfirmModal .modal-text")
        const bsConfirmModalButton =  document.querySelector("#bsConfirmModal .bt-confirm")
        const bsConfirmModalSpinner = document.querySelector("#bsConfirmModal .spinner-grow")
        function showToast(text,cls="success") {
            document.querySelector('#bsToast .toast-body').textContent = text
            document.querySelector('#bsToast').classList.add(`text-bg-${cls}`)
            bsToast.show()
        }

        document.getElementById("bsConfirmModal").addEventListener('hidden.bs.modal', () => {
            bsConfirmModalTitle.textContent =""
            bsConfirmModalText.textContent =""
            bsConfirmModalSpinner.classList.add("d-none")
        })

        function markReadNotification(va){
            fetch('{{route('notif.mark.as.read')}}', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ "id": va.dataset.id, '_token': '{{ csrf_token() }}'})
            })
            .then(response => window.open(va.dataset.target,"_self"))
            return false;
        }
        function markAllAsRead(){
            const badges =document.querySelectorAll('span.rounded-circle')
            const unread = document.querySelectorAll('a.unread')
            fetch('{{route('notif.mark.as.read')}}', {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ "all": 'all', '_token': '{{ csrf_token() }}'})
            }).then(response => {
                badges.forEach(element => {
                    element.remove()
                });
                unread.forEach(element => {
                    element.classList.add('list-group-item-secondary')
                });
                new bootstrap.Offcanvas(document.getElementById('notificationOffCanvas')).hide()

            });
            // return false;
        }
    </script>

    <script>
        // global helper to show dismissable Bootstrap alerts from JS
        function showAjaxAlert(message, type = 'danger', options = {}) {
            // ensure container exists
            let container = document.getElementById('globalAjaxAlertContainer');
            if (!container) {
                container = document.createElement('div');
                container.id = 'globalAjaxAlertContainer';
                container.style.position = 'fixed';
                container.style.top = '1rem';
                container.style.right = '1rem';
                container.style.zIndex = 2100;
                container.style.width = '360px';
                container.style.maxWidth = 'calc(100% - 2rem)';
                document.body.appendChild(container);
            }

            const id = 'ajaxAlert' + Date.now();
            const wrapper = document.createElement('div');
            wrapper.innerHTML = `\
                <div id="${id}" class="alert alert-${type} alert-dismissible fade show shadow-sm" role="alert">\
                    ${message}\
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
                </div>`;

            const alertEl = wrapper.firstElementChild;
            container.appendChild(alertEl);

            // wire bootstrap's Alert instance so we can programmatically close it
            const bsAlert = new bootstrap.Alert(alertEl);

            // auto-dismiss non-danger alerts after a timeout (default 10s)
            if (type !== 'danger') {
                const timeout = options.timeout || 10000;
                setTimeout(() => {
                    try { bsAlert.close(); } catch (e) { alertEl.remove(); }
                }, timeout);
            }

            return alertEl;
        }
    </script>
    
    @livewireScripts
    @stack('js')
</body>

</html>
