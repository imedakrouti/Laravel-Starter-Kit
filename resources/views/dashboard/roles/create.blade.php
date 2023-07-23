@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.roles.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Role description') }}</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="email">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">@lang('Permissions')</label>
                            <div class="col-md-6">
                            <select class="js-example-basic-single form-control @error('permissions') is-invalid @enderror" name="permissions[]"multiple="multiple">
                                @foreach ($permissions as $permission)
                                <option value="{{$permission->id}}"
                                    {{ (collect(old('permissions'))->contains($permission->id)) ? 'selected':'' }}>
                                    {{$permission->name}}</option>
                                @endforeach
                              </select>
                              @error('permissions')
                              <span class="invalid-feedback d-block" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __(' Add') }}
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


@push('scripts')
 <script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
        placeholder: '@lang('site.choose')',
        allowClear: true,
        width:'100%'
});
  
    });
    
</script>
@endpush
