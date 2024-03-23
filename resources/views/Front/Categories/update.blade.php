@extends('Front.Layout.layout')
@section('content')
<h4 class="py-3 mb-4">Yo'nalishlar</h4>
              <div class="row">
                <div class="col-xxl">
                  <div class="card mb-4">
                    @if(isset($categories))
                        <div class="card-body">
                        <form action="{{route('categories.update')}}" method="post" >
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$categories->id}}">
                            <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Shifri</label>
                            <div class="col-sm-10">
                                <input type="text" name="shifr" value="{{$categories->shifr}}" class="form-control" id="basic-default-name" placeholder="0909" />
                            </div>
                            </div>
                            <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Nomi</label>
                            <div class="col-sm-10">
                                <input name="name" value="{{$categories->name}}" type="text" class="form-control" id="basic-default-company" placeholder="Yo'nalish nomi" />
                            </div>
                            </div>
                            <div class="row justify-content-end">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </div>
                        </form>
                        </div>
                    @endif
                  </div>
                </div>
              </div>
@endsection
