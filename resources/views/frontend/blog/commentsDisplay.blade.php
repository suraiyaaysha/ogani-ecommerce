@foreach($comments as $comment)
    <div class="display-comment mt-3" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <div class="comments">
            <div class="comments-owner">
                <div class="comments-owner-image">
                    <a href="#" class="d-block">
                        <img src="{{ asset($comment->user->profile_photo) }}" alt="Image">
                    </a>
                </div>
                <div class="comments-owner-text">
                    <p><a href="#">{{ $comment->user->name }}</a></p>
                    <span>{{ $comment->created_at->format('F j, Y') }}</span>
                </div>
            </div>
            <p>{{ $comment->body }}</p>
        </div>


        <a href="" id="reply"></a>
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control">
                <input type="hidden" name="blog_id" value="{{ $blog_id }}">
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            </div>
            <div class="form-group mb-3 mt-3">
                {{-- <input type="submit" class="btn-default btn-default-sm" value="Reply" /> --}}
                <button type="submit" class="site-btn filter-btn-sm">{{ __('Reply') }}</button>
            </div>
        </form>
        @include('frontend.blog.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach
