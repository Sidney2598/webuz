@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Perimission</h4>
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('permission.store')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <label class="col-form-label" for="basic-default-name">PermissionName</label>
                            <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Permission Name" />
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
@endsection
