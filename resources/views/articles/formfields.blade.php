<div class="form-group">
    <label for="exampleInputTitle">ЧПУ</label>
    <input type="text" class="form-control" id="exampleInputSlug" required placeholder="Введите ЧПУ"
           name="slug"
           value="{{ old('slug', isset($article) ? $article->slug : '') }}"
    >
</div>
<div class="form-group">
    <label for="exampleInputTitle">Название статьи</label>
    <input type="text"  class="form-control" id="exampleInputTitle" required placeholder="Введите название"
           name="title"
           value="{{ old('title', isset($article) ? $article->title : '') }}"
    >
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Краткое описание статьи</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3"
              name="preview"
    >{{ old('preview', isset($article) ? $article->preview : '') }}</textarea>
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea2">Детальное описание</label>
    <textarea name="body"
              class="form-control" id="exampleFormControlTextarea2" required rows="3"
    >{{ old('body', isset($article) ? $article->body : '') }}</textarea>
</div>
<div class="form-group">
    <label for="exampleInputTags">Теги</label>
    <input type="text"
           class="form-control"
           id="exampleInputTags"
           name="tags"
           value="{{ old('tags', isset($article->tags) ? $article->tags->pluck('name')->implode(',') : '') }}"
    >
</div>
<div class="form-group form-check">
    <input name="published" type="checkbox" class="form-check-input" id="exampleCheck1" value="1" @if(old('publiched', isset($article) ? $article->published : false)) checked @endif>
    <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
</div>


