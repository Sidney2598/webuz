@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Kengash a'zolarini qo'shish</h4>
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('members.update')}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <label class="col-form-label" for="basic-default-name">F.I.O</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}" id="basic-default-name" placeholder="F.I.O" />
                          </div>
                          <div class="col-sm-6">
                                <label for="col-form-label" class="col-form-label">Darajasi</label>
                                <select name="degre_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                  <option value="1">A'zo</option>
                                  <option value="2">Kotib</option>
                                  <option value="3">Rais O'rinbosari</option>
                                  <option value="4">Rais</option>
                                </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <label for="col-form-label" class="col-form-label">Yo'nalishi nomi</label>
                            <select name="category_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                             @if (@isset($categories))
                                @foreach ($categories as $model )
                                <option value="{{$model->id}}">{{$model->shifr}}-{{$model->name}}</option>
                                @endforeach
                             @endif
                            </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                              <label class=" col-form-label" for="basic-default-name">Login</label>
                              <input type="text" name="login" value="{{$user->login}}" class="form-control" id="basic-default-name" placeholder="Login" />
                            </div>
                            <div class="col-sm-6">
                              <label class=" col-form-label" for="basic-default-name">Parol</label>
                              <input type="password" name="password" required  class="form-control" id="basic-default-name" placeholder="Parol" />
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
