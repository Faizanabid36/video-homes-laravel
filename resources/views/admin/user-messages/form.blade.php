<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="control-label">{{ 'Industry' }}</label>
    <select name="parent_id" class="form-control" id="parent_id" >
        <option value="" disabled selected>Industry (Leave Blank if None)</option>
        @foreach ($user_categories as $optionKey => $optionValue)
            <option value="{{ $optionValue->id }}" {{ (isset($usercategory->parent_id) && $usercategory->parent_id == $optionValue->id) ? 'selected' : ''}}>{{$optionValue->name}}</option>
        @endforeach
    </select>
    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($usercategory->name) ? $usercategory->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($usercategory->description) ? $usercategory->description : ''}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('parent_id_2') ? 'has-error' : ''}}">
    <label for="parent_id_2" class="control-label">{{ 'Profession' }}</label>
    <select name="parent_id_2" class="form-control" id="parent_id_2" >
        <option value="" disabled selected>Profession (Leave Blank if None)</option>
        @foreach ($user_sub_categories as $optionKey => $optionValue)
            <option value="{{ $optionValue->id }}" {{ (isset($usercategory->parent_id) && $usercategory->parent_id == $optionValue->id) ? 'selected' : ''}}>{{$optionValue->name}}</option>
        @endforeach
    </select>
    {!! $errors->first('parent_id_2', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
