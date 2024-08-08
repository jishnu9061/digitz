<div class="comment mb-4" id="comment-{{ $comment->id }}">
    <strong>{{ $comment->user->name }}</strong>
    <span class="text-muted">on {{ $comment->created_at->format('M d, Y') }}</span>
    <p id="comment-content-{{ $comment->id }}">{{ $comment->content }}</p>
    <small>Total Replies: {{ $comment->children->count() }}</small>

    @auth
        @if (Auth::id() == $comment->user_id)
            <button class="btn btn-sm btn-warning edit-btn" data-comment-id="{{ $comment->id }}">Edit</button>
            <form action="{{ route('user.comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger delete-btn"
                    data-confirm="Are you sure you want to delete this comment?">Delete</button>
            </form>

            <div id="edit-comment-{{ $comment->id }}" class="edit-comment-form" style="display:none;">
                <form method="POST" action="{{ route('user.comments.update', $comment->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" required>{{ $comment->content }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    <button type="button" class="btn btn-sm btn-secondary cancel-edit-btn"
                        data-comment-id="{{ $comment->id }}">Cancel</button>
                </form>
            </div>
        @endif
        <button class="btn btn-sm btn-primary reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>
        <div id="reply-form-{{ $comment->id }}" class="reply-form" style="display:none;">
            <form method="POST" action="{{ route('user.comments.store') }}">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="2" required></textarea>
                    <input type="hidden" name="blog_id" value="{{ $comment->blog_id }}">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                <button type="button" class="btn btn-sm btn-secondary cancel-reply-btn"
                    data-comment-id="{{ $comment->id }}">Cancel</button>
            </form>
        </div>
    @endauth
    @if ($comment->children->count() > 0)
        <div class="ml-4 mt-3">
            @foreach ($comment->children as $child)
                @include('comments.partials.comment', ['comment' => $child])
            @endforeach
        </div>
    @endif
</div>
