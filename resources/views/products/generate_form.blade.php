@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('New product') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('product.generate_data') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="count">{{ __('Generate Count') }}</label>
                                <input type="numeric" name="count" id="count" value="{{ old('count', '1') }}"
                                       class="form-control" min="1" max="10000" step="1">
                                @if($errors->has('count'))
                                    <div class="alert alert-danger">{{ $errors->first('count') }}</div>
                                @endif
                            </div>



                            <input type="submit" class="btn btn-sm btn-success" value="{{ __('Generate') }}">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
