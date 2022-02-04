@extends('admin::layouts.main')
@section('content')
<ul class="page-breadcrumb breadcrumb">
    <li>
        <a href="{{route('admin-dashboard')}}">Home</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{Route('admin-project-index')}}">Project</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
    </li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-red-sunglo"></i>
                    <span class="caption-subject font-red-sunglo bold uppercase">Update Project of {{$data->name}}</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form method="post" action="{{route('admin-project-update',$data->id)}}" class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-body">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Name<span class="required">*</span></label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ (old('name')!="") ? old('name') : $data->name}}"/>
                                @if ($errors->has('name'))
                                <span class="help-block"> {{ $errors->first('name') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Category<span class="required">*</span></label>
                            <div class="col-md-10">
                                <select id="cat"  name="category_id" required="" class="form-control">
                                    <option value="" disabled="" selected>{{ __("Select Category") }}</option>
                                    @foreach($cats as $cat)
                                    <option value="{{ $cat->id }}"  {{ (old('category_id')!="") ? ($cat->id==old('category_id'))?'selected':'' : ($cat->id==$data->category_id)?'selected':''}}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                <span class="help-block"> {{ $errors->first('category_id') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('link') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Link</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" placeholder="Link" name="link" value="{{ (old('link')!="") ? old('link') : $data->link}}"/>
                                @if ($errors->has('link'))
                                <span class="help-block"> {{ $errors->first('link') }} </span>
                                @endif
                            </div>
                        </div>


                        
                        

                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Current Featured Image</label>
                            <div class="col-md-10">
                                <input type="file" class="form-control"  name="image" onchange="readURL(this);">
                                @if ($errors->has('image'))
                                <span class="help-block"> {{ $errors->first('image') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <img id="blah" src="{{isset($data->image)?URL::asset('public/uploads/project/'.$data->image):''}}" style="max-width: 400;max-height: 200px">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Short Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control" placeholder="Short Description" name="short_description"  id="body">{!! (old('short_description')!="") ? old('short_description') : $data->short_description !!}</textarea>
                                @if ($errors->has('short_description'))
                                <span class="help-block"> {{ $errors->first('short_description') }} </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Description<span class="required">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control ckeditor" placeholder="Description" name="description"  id="body">{!! (old('description')!="") ? old('description') : $data->description !!}</textarea>
                                @if ($errors->has('description'))
                                <span class="help-block"> {{ $errors->first('description') }} </span>
                                @endif
                            </div>
                        </div>
                        



                        <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3">Status <span class="required">*</span></label>
                            <div class="col-md-10">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ ($data->status == '1') ? 'checked' : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{ ($data->status == '0') ? 'checked' : '' }}> Inactive
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{Route('admin-project-index')}}" class="btn btn-primary">Cancel</a>
                                <button type="submit" class="btn green"> Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection