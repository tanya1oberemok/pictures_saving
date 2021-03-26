@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="justify-content-center d-flex">
            <div class="col-12">
                <div class="card-header">
                    <form method="GET" action="/">
                        {{ csrf_field() }}
                        <select class="form-select col-4" aria-label="Default select example" name="orderBy" onchange="this.form.submit()">
                            <option value="asc" id="sortAsc" @if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'asc') selected="selected" @endif >Sort by start date</option>
                            <option value="desc" id="sortDesc" @if(isset($_GET['orderBy']) && $_GET['orderBy'] == 'desc') selected="selected" @endif >Sort by end date</option>
                        </select>
                    </form>
                </div>

                <div class="card p-5">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="card mr-4 mb-5" style="width: 18rem;">
                                <img src="{{ asset('/posts/' . $post->image) }}" class="card-img-top" alt="{{$post->title}}">
                                <div class="card-body">
                                    <p class="card-text" style="width: 10rem;">{{$post->title}}</p>
                                    <p class="card-text" style="width: 10rem;">Created by {{$post->users->first_name}} {{$post->users->last_name}}</p>
                                </div>
                            </div>
                        @endforeach

                        @if ($posts->lastPage() > 1)
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item {{ ($posts->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $posts->url(1) }}">Previous</a>
                                    </li>

                                    @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                        <li class="page-item {{ ($posts->currentPage() == $i) ? ' active' : '' }}">
                                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item {{ ($posts->currentPage() == $posts->lastPage()) ? ' disabled' : '' }}">
                                        <a class="page-link" href="{{ $posts->url($posts->currentPage()+1) }}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
