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
    <label for="percent" class="form-label">percent</label>
    {!! Form::number('percent', null,[
        'class'=> $errors->has('sub_title')?'form-control is-invalid':'form-control',
        'placeholder'=>'',
        ]) !!}
    @error('percent')
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
