@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12 mb-4 col-lg-12 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0 text-uppercase">
                            <span class="text-muted">Hello</span>
                            {{ \Illuminate\Support\Facades\Auth::user()->name }} !
                        </h5>
                        <small class="text-muted">
                            <script>
                                let date = new Date();
                                let options = {weekday: 'long', month: 'short', day: 'numeric', year: 'numeric'};
                                let formattedDate = date.toLocaleDateString('en-US', options);
                                document.write(formattedDate);
                            </script>
                        </small>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
@endsection
