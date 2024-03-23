@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Roles has create</h4>
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('rolehas.store')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Users</label>
                              <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                                @if(isset($users))
                                  @foreach($users as $model )
                                    <option value="{{$model->id}}">{{$model->name}}</option>
                                  @endforeach
                                @endif
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Roles</label>
                              <select name="role_id" class="form-control" id="exampleFormControlSelect1">
                                @if(isset($roles))
                                  @foreach($roles as $model )
                                    <option value="{{$model->id}}">{{$model->name}}</option>
                                  @endforeach
                                @endif
                              </select>
                            </div>
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
