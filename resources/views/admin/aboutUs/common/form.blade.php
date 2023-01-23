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
    <label for="profile" class="form-label">Profile</label>
    {!! Form::text('profile', null,[
        'class'=> $errors->has('profile')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. Developer',
        ]) !!}
    @error('profile')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    {!! Form::email('email', null,[
        'class'=> $errors->has('email')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. Joshef@gmail.com',
        ]) !!}
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Phone No.</label>
    {!! Form::text('phone', null,[
        'class'=> $errors->has('phone')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. 9800000000',
        ]) !!}
    @error('phone')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
<div class="mb-3">
    <label for="skill" class="form-label">Skill</label>
    {!! Form::text('skill', null,[
        'class'=> $errors->has('skill')?'form-control is-invalid':'form-control',
        'placeholder'=>'Eg. Programmer',
        ]) !!}
    @error('skill')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" name="main_photo" id="main_photo" aria-describedby="main_photolHelp">
@if(isset($aboutUs))
    <label for="">Existing Image</label>
    @if($aboutUs->photo)
        <img src="{{asset('images/aboutUs/'.$aboutUs->photo)}}"
             alt="{{$aboutUs->title}}" height="200" width="200">
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
