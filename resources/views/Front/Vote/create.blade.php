@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Kengash a'zolarini qo'shish</h4>
              <div class="row">
                @if(session()->get('success'))
                    <div class="alert alert-success text-dark">
                        {{session()->get('success')}}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="{{route('vote.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <label class="col-form-label" for="basic-default-name">Mavzusi</label>
                            <input type="text" name="theme" class="form-control" id="basic-default-name" placeholder="Mavzusi" />
                          </div>
                          <div class="col-sm-6">
                            <label class="col-form-label" for="basic-default-name">F.I.O</label>
                            <input type="text" name="username" class="form-control" id="basic-default-name" placeholder="F.I.O" />
                          </div>
                          <div class="col-sm-6">
                            <label class="col-form-label" for="basic-default-name">Kengash shifri</label>
                            <input type="text" name="shifr" class="form-control" id="basic-default-name" placeholder="029020" />
                          </div>
                          <div class="col-sm-6">
                            <label class="col-form-label" for="basic-default-name">Sanasi</label>
                            <input type="date" name="date" class="form-control" id="basic-default-name"  />
                          </div>
                          <div class="col-sm-6">
                            <label class="col-form-label" for="basic-default-name">Bayonnoma soni</label>
                            <input type="text" name="number" class="form-control" id="basic-default-name" placeholder="Bayonnoma soni" />
                          </div>
                        </div>

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
                          <div class="col-12">
                            <label for="formFile" class="form-label">Malumot</label>
                            <input class="form-control" name="file" type="file" id="formFile">
                          </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-12 text-center mt-1">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
@endsection
