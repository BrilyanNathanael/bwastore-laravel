@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product
@endsection

@section('content')
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('dashboard-product-store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Product Name</label>
                                    <input
                                        type="text"
                                        class="form-control text-dark"
                                        name="name"
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Price</label>
                                    <input
                                        type="number"
                                        class="form-control text-dark"
                                        name="price"
                                    />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="categories_id" id="" class="form-control text-dark">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="editor"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Thumbnails</label>
                                    <input
                                        type="file"
                                        class="form-control text-dark"
                                        name="photo"
                                    />
                                    <p class="text-muted">
                                        Kamu dapat memilih lebih dari satu file
                                    </p>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col text-right">
                                    <button
                                    type="submit"
                                    class="btn btn-success px-5"
                                    >
                                    Save Now
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
      CKEDITOR.replace("editor");
    </script>
@endpush