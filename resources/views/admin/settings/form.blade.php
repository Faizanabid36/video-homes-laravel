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
<div class="form-group {{ $errors->has('box_1["title"]') ? 'has-error' : ''}}">
    <label for='box_1["title"]' class="control-label">{{ 'First Card Title' }}</label>
    <input class="form-control" name="box_1[title]" type="text" id='box_1["title"]' value="{{ isset($settings->box_1['title']) ? $settings->box_1['title'] : ''}}" >
    {!! $errors->first('box_1["title"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_1') ? 'has-error' : ''}}">
    <label for="box_1" class="control-label">{{ 'First Card Icon' }}</label>
    <input class="form-control" name="box_1[file]" type="file" id="box_1_file" >
    {!! $errors->first('box_1[file]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_1["description"]') ? 'has-error' : ''}}">
    <label for='box_1["description"]' class="control-label">{{ 'First Card Description' }}</label>
    <input class="form-control" name="box_1[description]" type="text" id='box_1["description"]' value="{{ isset($settings->box_1['description']) ? $settings->box_1['description'] : ''}}" >
    {!! $errors->first('box_1["description"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_1["btn"]') ? 'has-error' : ''}}">
    <label for='box_1["btn"]' class="control-label">{{ 'First Card Button Text' }}</label>
    <input class="form-control" name="box_1[btn]" type="text" id='box_1["btn"]' value="{{ isset($settings->box_1["btn"]) ? $settings->box_1["btn"] : ''}}" >
    {!! $errors->first('box_1["btn"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_1["btn_link"]') ? 'has-error' : ''}}">
    <label for='box_1["btn_link"]' class="control-label">{{ 'First Card Button Link' }}</label>
    <input class="form-control" name="box_1[btn_link]" type="text" id='box_1["btn_link"]' value="{{ isset($settings->box_1["btn_link"]) ? $settings->box_1["btn_link"] : ''}}" >
    {!! $errors->first('box_1["btn_link"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2["title"]') ? 'has-error' : ''}}">
    <label for='box_2["title"]' class="control-label">{{ 'Second Card Title' }}</label>
    <input class="form-control" name="box_2[title]" type="text" id='box_2["title"]' value="{{ isset($settings->box_2['title']) ? $settings->box_2['title'] : ''}}" >
    {!! $errors->first('box_2["title"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2') ? 'has-error' : ''}}">
    <label for="box_2" class="control-label">{{ 'Second Card Icon' }}</label>
    <input class="form-control" name="box_2[file]" type="file" id="box_2_file" >
    {!! $errors->first('box_2[file]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2["description"]') ? 'has-error' : ''}}">
    <label for='box_2["description"]' class="control-label">{{ 'Second Card Description' }}</label>
    <input class="form-control" name="box_2[description]" type="text" id='box_2["description"]' value="{{ isset($settings->box_2['description']) ? $settings->box_2['description'] : ''}}" >
    {!! $errors->first('box_2["description"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2["btn"]') ? 'has-error' : ''}}">
    <label for='box_2["btn"]' class="control-label">{{ 'Second Card Button Text' }}</label>
    <input class="form-control" name="box_2[btn]" type="text" id='box_2["btn"]' value="{{ isset($settings->box_2["btn"]) ? $settings->box_2["btn"] : ''}}" >
    {!! $errors->first('box_2["btn"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_2["btn_link"]') ? 'has-error' : ''}}">
    <label for='box_2["btn_link"]' class="control-label">{{ 'Second Card Button Link' }}</label>
    <input class="form-control" name="box_2[btn_link]" type="text" id='box_2["btn_link"]' value="{{ isset($settings->box_2["btn_link"]) ? $settings->box_2["btn_link"] : ''}}" >
    {!! $errors->first('box_2["btn_link"]', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('box_3["title"]') ? 'has-error' : ''}}">
    <label for='box_3["title"]' class="control-label">{{ 'Third Card Title' }}</label>
    <input class="form-control" name="box_3[title]" type="text" id='box_3["title"]' value="{{ isset($settings->box_3['title']) ? $settings->box_3['title'] : ''}}" >
    {!! $errors->first('box_3["title"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_3') ? 'has-error' : ''}}">
    <label for="box_3" class="control-label">{{ 'Third Card Icon' }}</label>
    <input class="form-control" name="box_3[file]" type="file" id="box_3_file" >
    {!! $errors->first('box_3[file]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_3["description"]') ? 'has-error' : ''}}">
    <label for='box_3["description"]' class="control-label">{{ 'Third Card Description' }}</label>
    <input class="form-control" name="box_3[description]" type="text" id='box_3["description"]' value="{{ isset($settings->box_3['description']) ? $settings->box_3['description'] : ''}}" >
    {!! $errors->first('box_3["description"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_3["btn"]') ? 'has-error' : ''}}">
    <label for='box_3["btn"]' class="control-label">{{ 'Third Card Button Text' }}</label>
    <input class="form-control" name="box_3[btn]" type="text" id='box_3["btn"]' value="{{ isset($settings->box_3["btn"]) ? $settings->box_3["btn"] : ''}}" >
    {!! $errors->first('box_3["btn"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_3["btn_link"]') ? 'has-error' : ''}}">
    <label for='box_3["btn_link"]' class="control-label">{{ 'Third Card Button Link' }}</label>
    <input class="form-control" name="box_3[btn_link]" type="text" id='box_3["btn_link"]' value="{{ isset($settings->box_3["btn_link"]) ? $settings->box_3["btn_link"] : ''}}" >
    {!! $errors->first('box_3["btn_link"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4["title"]') ? 'has-error' : ''}}">
    <label for='box_4["title"]' class="control-label">{{ 'Forth Card Title' }}</label>
    <input class="form-control" name="box_4[title]" type="text" id='box_4["title"]' value="{{ isset($settings->box_4['title']) ? $settings->box_4['title'] : ''}}" >
    {!! $errors->first('box_4["title"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4') ? 'has-error' : ''}}">
    <label for="box_4" class="control-label">{{ 'Forth Card Icon' }}</label>
    <input class="form-control" name="box_4[file]" type="file" id="box_4_file" >
    {!! $errors->first('box_4[file]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4["description"]') ? 'has-error' : ''}}">
    <label for='box_4["description"]' class="control-label">{{ 'Forth Card Description' }}</label>
    <input class="form-control" name="box_4[description]" type="text" id='box_4["description"]' value="{{ isset($settings->box_4['description']) ? $settings->box_4['description'] : ''}}" >
    {!! $errors->first('box_4["description"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4["btn"]') ? 'has-error' : ''}}">
    <label for='box_4["btn"]' class="control-label">{{ 'Forth Card Button Text' }}</label>
    <input class="form-control" name="box_4[btn]" type="text" id='box_4["btn"]' value="{{ isset($settings->box_4["btn"]) ? $settings->box_4["btn"] : ''}}" >
    {!! $errors->first('box_4["btn"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('box_4["btn_link"]') ? 'has-error' : ''}}">
    <label for='box_4["btn_link"]' class="control-label">{{ 'Forth Card Button Link' }}</label>
    <input class="form-control" name="box_4[btn_link]" type="text" id='box_4["btn_link"]' value="{{ isset($settings->box_4["btn_link"]) ? $settings->box_4["btn_link"] : ''}}" >
    {!! $errors->first('box_4["btn_link"]', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parallax_video') ? 'has-error' : ''}}">
    <label for="parallax_video" class="control-label">{{ 'Parallax Video' }}</label>
    <input class="form-control" name="call_to_action_title" type="text" id="parallax_video" value="{{ isset($settings->parallax_video) ? $settings->parallax_video : ''}}" >
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
    <textarea class="form-control tinymce" name="footer" id="footer">{{ isset($settings->footer) ? $settings->footer : ''}}</textarea>
    {!! $errors->first('footer', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
