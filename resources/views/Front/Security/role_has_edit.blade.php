@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Roles has Edit</h4>
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('rolehas.update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Users</label>
                              @if(isset($user))
                              <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                                  
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                  
                              </select>
                              <input type="hidden" name="has_id" value="{{$role_id}}">
                              @endif
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

