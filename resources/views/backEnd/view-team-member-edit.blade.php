@extends('layouts.backEnd.app')

@section('title')
{{ A_EDIT_TEAM_MEMBER }}
@endsection

@section('content')
  <div class="container">
  <div class="row">
    <div class="col-sm-6"></div>
    <div class="col-sm-6">
      <a href="{{route('team-members.index')}}" class="btn btn-primary float-right btn-sm"><i class="fa fa-eye"></i> {{ A_VIEW_ALL }}</a>
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
                  <h1 class="h4 text-gray-900 mb-4 page-home"><i class="fas fa-chevron-circle-right"></i> {{ A_EDIT_TEAM_MEMBER }}</h1>
                  <form class="user" method="POST" action="{{ route('team-members.update',$team_member->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_NAME }} <span class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ $team_member->name }}">
                        
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_SLUG }} <span class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" value="{{ $team_member->slug }}">
                        
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_DESIGNATION }} <span class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="text" name="designation" class="form-control" value="{{ $team_member->designation }}">
                        
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_PHOTO }} <span class="text-danger">*</span></label>
                      <div class="col-sm-10">
                        <input type="file" name="photo" id="image"><br>
                        <small>({{ A_ALLOWED_PHOTO_TYPES }})</small><br>
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <img src="{{ (!empty($team_member->photo))?url('upload/'.$team_member->photo):url('upload/no-image.png') }}" class="show-img" id="showImage">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_DETAIL }}</label>
                      <div class="col-sm-10">
                        <textarea name="detail" class="form-control summernote" rows="6">{{ $team_member->detail }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_FACEBOOK }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="facebook" class="form-control" value="{{ $team_member->facebook }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_TWITTER }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="twitter" class="form-control" value="{{ $team_member->twitter }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_LINKEDIN }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="linkedin" class="form-control" value="{{ $team_member->linkedin }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_YOUTUBE }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="youtube" class="form-control" value="{{ $team_member->youtube }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_GOOGLE_PLUS }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="google_plus" class="form-control" value="{{ $team_member->google_plus }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_INSTAGRAM }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="instagram" class="form-control" value="{{ $team_member->instagram }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_FLICKR }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="flickr" class="form-control" value="{{ $team_member->flickr }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_PHONE }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="phone" class="form-control" value="{{ $team_member->phone }}">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_EMAIL_ADDRESS }}</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" value="{{ $team_member->email }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_WEBSITE }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="website" class="form-control" value="{{ $team_member->website }}">
                      </div>
                    </div>

                    <div class="form-group row p-2 seo-section">
                      <span>{{ A_SEO_INFORMATION }}</span>
                    </div>


                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_META_TITLE }}</label>
                      <div class="col-sm-10">
                        <input type="text" name="meta_title" class="form-control" value="{{ $team_member->meta_title }}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_META_DESCRIPTION }}</label>
                      <div class="col-sm-10">
                        <textarea name="meta_description" class="form-control" rows="2">{{ $team_member->meta_description }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">{{ A_LANGUAGE }}</label>
                      <div class="col-sm-10">
                        <select name="lang_id" class="form-control select2">
                          @foreach($languages as $language)
                          <option value="{{ $language->id }}" {{ $language->id == $team_member->lang_id ? "selected" : "" }}>{{ $language->name }}</option>
                          @endforeach
                        </select>
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