<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($page->title) ? $page->title : ''}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($page->slug) ? $page->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control tinymce" rows="5" name="content" type="textarea" id="content" >{{ isset($page->content) ? $page->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('seo_title') ? 'has-error' : ''}}">
    <label for="seo_title" class="control-label">{{ 'Seo Title' }}</label>
    <input class="form-control" name="seo_title" type="text" id="seo_title" value="{{ isset($page->seo_title) ? $page->seo_title : ''}}" >
    {!! $errors->first('seo_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('seo_description') ? 'has-error' : ''}}">
    <label for="seo_description" class="control-label">{{ 'Seo Description' }}</label>
    <input class="form-control" name="seo_description" type="text" id="seo_description" value="{{ isset($page->seo_description) ? $page->seo_description : ''}}" >
    {!! $errors->first('seo_description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('in_nav') ? 'has-error' : ''}}">
    <label for="in_nav_group">Navbar</label>
    <div id="in_nav_group" class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary @if(isset($page) && $page->in_nav == 0) active @endif"> Yes
            <input type="radio" name="in_nav" id="in_nav" value="0" autocomplete="off" @if(isset($page) && $page->in_nav == 0) checked @endif>
        </label>
        <label class="btn btn-primary @if(isset($page) && $page->in_nav == 1) active @endif"> No
            <input type="radio" name="in_nav" id="in_nav" value="1" autocomplete="off" @if(isset($page) && $page->in_nav == 1) checked @endif>
        </label>
    </div>
    {!! $errors->first('in_nav', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('is_public') ? 'has-error' : ''}}">
    <label for="is_public_group">Status</label>
    <div id="is_public_group" class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary @if(isset($page) && $page->is_public == 0) active @endif"> Public
            <input type="radio" name="is_public" id="is_public" value="0" autocomplete="off" @if(isset($page) && $page->is_public == 0) checked @endif>
        </label>
        <label class="btn btn-primary @if(isset($page) && $page->is_public == 1) active @endif"> Private
            <input type="radio" name="is_public" id="is_public" value="1" autocomplete="off" @if(isset($page) && $page->is_public == 1) checked @endif>
        </label>
    </div>
    {!! $errors->first('is_public', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
