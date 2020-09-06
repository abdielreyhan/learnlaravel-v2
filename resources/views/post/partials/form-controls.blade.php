<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title') ?? $post->title}}" class="form-control @error('title') is-invalid @enderror">
    @error('title')
        <div class="mt2 invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="title">Body</label>
    <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror">{{old('body') ?? $post->body}}</textarea>
    @error('body')
        <div class="mt2 invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{$submit ?? 'Update'}}</button>