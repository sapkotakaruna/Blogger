<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    {!! Form::text('name', null,[
        'class'=> $errors->has('name')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. Joshef',
        ]) !!}
    {{--                                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">--}}
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    {!! Form::email('email', null,[
        'class'=> $errors->has('email')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    {!! Form::password('password',[
        'class'=> $errors->has('password')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('password')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label"> Confirm Password</label>
    {!! Form::password('password_confirmation',[
        'class'=> $errors->has('password_confirmation')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('password_confirmation')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" name="main_photo" id="main_photo" aria-describedby="main_photolHelp">
    @if(isset($work))
        <label for="">Existing Image</label>
        @if($work->photo)
            <img src="{{asset('images/work/'.$work->photo)}}"
                 alt="{{$work->title}}" height="200" width="200">
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
    {!! Form::textarea('description', null,[
        'class'=> $errors->has('description')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('description')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

