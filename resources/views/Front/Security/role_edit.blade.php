@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Roles</h4>
             @if(isset($roles))   
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('roles.update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <label class="col-form-label" for="basic-default-name">RoleName</label>
                            <input type="hidden" name="id" value="{{$roles->id}}">
                            <input type="text" name="name" value="{{$roles->name}}" class="form-control" id="basic-default-name" placeholder="Role Name" />
                          </div>
                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endif
@endsection
