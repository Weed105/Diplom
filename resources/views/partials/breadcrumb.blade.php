<section class="breadcrumb breadcrumb_bg"style="
height: 260px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ $breadcrumb }}</h2>
                        <p><a href="{{ route('home') }}">Главная</a><span>/</span><a
                                href="{{ url()->current() }}">{{ $breadcrumb }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
