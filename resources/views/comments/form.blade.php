<div class="mb-2">
    @include('layout.errors')

    <form method="post" action="{{ route('comments.store', $contentResource->slug) }}">
        @csrf

        <div class="form-group mb-1">

            <label for="exampleFormControlTextarea1" class="h5">Написать комментарий</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" required rows="3"
                      name="text"
            ></textarea>
        </div>
        <div class="d-flex align-items-end flex-column">
            <button class="btn btn-primary" type="submit">Отправить</button>
        </div>
    </form>
</div>
