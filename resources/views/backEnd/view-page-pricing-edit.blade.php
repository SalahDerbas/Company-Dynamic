@extends('layouts.backEnd.app')

@section('title')
{{ A_EDIT_PRICING_PAGE }}
@endsection

@section('content')
  <div class="container">
  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6">
      <a href="{{ route('page-pricings.index') }}" class="btn btn-primary float-right btn-sm"><i class="fa fa-eye"></i> {{ A_VIEW_ALL }}</a>
    </div>
  </div><br>
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <h1 class="h4 text-gray-900 mb-4 page-home"><i class="fas fa-chevron-circle-right"></i> {{ A_EDIT_PRICING_PAGE }}</h1>
                  <form class="user" method="POST" action="{{ route('page-pricings.update',$page_pricing->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_HEADING }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="pricing_heading" class="form-control" value="{{ $page_pricing->pricing_heading }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_META_TITLE }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="mt_pricing" class="form-control" value="{{ $page_pricing->mt_pricing }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_META_DESCRIPTION }}</label>
                      <div class="col-sm-10">
                        <textarea name="md_pricing" class="form-control" rows="3">{{ $page_pricing->md_pricing }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_LANGUAGE }}</label>
                      <div class="col-sm-10">
                        <input type="text" readonly class="form-control" value="{{ $page_pricing['language']['name'] }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <input type="submit" name="btn" class="btn btn-primary btn-user btn-block" value="{{ A_UPDATE }}">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection