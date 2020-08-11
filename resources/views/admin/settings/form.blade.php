<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Meta Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($settings->title) ? $settings->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Meta Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ isset($settings->description) ? $settings->description : ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('display_title') ? 'has-error' : ''}}">
    <label for="display_title" class="control-label">{{ 'Display Title' }}</label>
    <input class="form-control" name="display_title" type="text" id="display_title" value="{{ isset($settings->display_title) ? $settings->display_title : ''}}" >
    {!! $errors->first('display_title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('button_1') ? 'has-error' : ''}}">
    <label for="button_1" class="control-label">{{ 'First Button Text' }}</label>
    <input class="form-control" name="button_1" type="text" id="button_1" value="{{ isset($settings->button_1) ? $settings->button_1 : ''}}" >
    {!! $errors->first('button_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('button_1_link') ? 'has-error' : ''}}">
    <label for="button_1_link" class="control-label">{{ 'First Button Link' }}</label>
    <input class="form-control" name="button_1_link" type="text" id="button_1_link" value="{{ isset($settings->button_1_link) ? $settings->button_1_link : ''}}" >
    {!! $errors->first('button_1_link', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('button_2') ? 'has-error' : ''}}">
    <label for="button_2" class="control-label">{{ 'Second Button Text' }}</label>
    <input class="form-control" name="button_2" type="text" id="button_2" value="{{ isset($settings->button_2) ? $settings->button_2 : ''}}" >
    {!! $errors->first('button_2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('button_2_link') ? 'has-error' : ''}}">
    <label for="button_2_link" class="control-label">{{ 'Second Button Link' }}</label>
    <input class="form-control" name="button_2_link" type="text" id="button_2_link" value="{{ isset($settings->button_2_link) ? $settings->button_2_link : ''}}" >
    {!! $errors->first('button_2_link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_1') ? 'has-error' : ''}}">
    <label for="box_1" class="control-label">{{ 'First Card' }}</label>
    <input class="form-control" name="box_1" type="text" id="box_1" value="{{ isset($settings->box_1) ? $settings->box_1 : ''}}" >
    {!! $errors->first('box_1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2') ? 'has-error' : ''}}">
    <label for="box_2" class="control-label">{{ 'Second Card' }}</label>
    <input class="form-control" name="box_2" type="text" id="box_2" value="{{ isset($settings->box_2) ? $settings->box_2 : ''}}" >
    {!! $errors->first('box_2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_3') ? 'has-error' : ''}}">
    <label for="box_3" class="control-label">{{ 'Third Card' }}</label>
    <input class="form-control" name="box_3" type="text" id="box_3" value="{{ isset($settings->box_3) ? $settings->box_3 : ''}}" >
    {!! $errors->first('box_3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4') ? 'has-error' : ''}}">
    <label for="box_4" class="control-label">{{ 'Forth Card' }}</label>
    <input class="form-control" name="box_4" type="text" id="box_4" value="{{ isset($settings->box_4) ? $settings->box_4 : ''}}" >
    {!! $errors->first('box_4', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parallax_video') ? 'has-error' : ''}}">
    <label for="parallax_video" class="control-label">{{ 'Parallax Video' }}</label>
    <input class="form-control" name="parallax_video" type="text" id="parallax_video" value="{{ isset($settings->parallax_video) ? $settings->parallax_video : ''}}" >
    {!! $errors->first('parallax_video', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('call_to_action_title') ? 'has-error' : ''}}">
    <label for="call_to_action_title" class="control-label">{{ 'Call to Action Title' }}</label>
    <input class="form-control" name="call_to_action_title" type="text" id="call_to_action_title" value="{{ isset($settings->call_to_action_title) ? $settings->call_to_action_title : ''}}" >
    {!! $errors->first('call_to_action_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('call_to_action') ? 'has-error' : ''}}">
    <label for="call_to_action" class="control-label">{{ 'Call to Action Button Text' }}</label>
    <input class="form-control" name="call_to_action" type="text" id="call_to_action" value="{{ isset($settings->call_to_action) ? $settings->call_to_action : ''}}" >
    {!! $errors->first('call_to_action', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('call_to_action_link') ? 'has-error' : ''}}">
    <label for="call_to_action_link" class="control-label">{{ 'Call to Action Button Link' }}</label>
    <input class="form-control" name="call_to_action_link" type="text" id="call_to_action_link" value="{{ isset($settings->call_to_action_link) ? $settings->call_to_action_link : ''}}" >
    {!! $errors->first('call_to_action_link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('footer') ? 'has-error' : ''}}">
    <label for="footer" class="control-label">{{ 'Footer' }}</label>
    <input class="form-control" name="footer" type="text" id="footer" value="{{ isset($settings->footer) ? $settings->footer : ''}}" >
    {!! $errors->first('footer', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
