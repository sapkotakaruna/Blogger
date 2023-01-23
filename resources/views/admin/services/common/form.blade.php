<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    {!! Form::text('title', null,[
        'class'=> $errors->has('title')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. Joshef',
        ]) !!}
    {{--                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">--}}
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" name="main_photo" id="main_photo" aria-describedby="main_photolHelp">
@if(isset($services))
    <label for="">Existing Image</label>
    @if($services->photo)
        <img src="{{asset('images/services/'.$services->photo)}}"
             alt="{{$services->title}}" height="200" width="200">
    @else
        No Existing Image
    @endif
    @endif

    @error('main_photo')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    {!! Form::text('description', null,[
        'class'=> $errors->has('description')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="rank" class="form-label">Rank</label>
    {!! Form::number('rank', null,[
        'class'=> $errors->has('rank')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. 1',
        ]) !!}
    @error('rank')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Status</label>
    @error('status')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
