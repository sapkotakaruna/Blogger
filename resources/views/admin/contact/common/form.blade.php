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
    <label for="subject" class="form-label">Subject</label>
    {!! Form::text('subject', null,[
        'class'=> $errors->has('subject')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('subject')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="mb-3">
    <label for="message" class="form-label">Message</label>
    {!! Form::text('message', null,[
        'class'=> $errors->has('message')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('message')
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
