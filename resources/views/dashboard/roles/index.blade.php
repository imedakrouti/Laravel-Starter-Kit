@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>

                <div class="card-body">
                    <form action="">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="search" autofocus class="form-control" placeholder="search" value="{{ request()->search }}">
                                </div>
                            </div><!-- end of col -->

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div><!-- end of row -->

                    </form><!-- end of form -->
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Description</th>
                            <th scope="col">User Number</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $index=>$role)
                          <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role->users_count}}</td>
                            <td>
                                <form method="post" action="{{ route('dashboard.roles.destroy', $role->id) }}"style="display: inline-block">
                                    @csrf
                                  @method('delete')
                                   <button  type="submit"  class="btn btn-icon btn-light btn-hover-primary btn-sm delete" data-id={{$role->id}}>
                                    <i class="fa-solid fa-trash text-danger"></i>
                                   </button>
                               </form>
                                
                                </td>
                          </tr>
                         @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



