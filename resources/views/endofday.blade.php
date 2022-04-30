@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cash</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('endofdayadd') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">End of Day</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @if(isset($err)) is-invalid @endif" id="amount" name="amount" required autofocus>

                                @if(isset($err))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $err }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection