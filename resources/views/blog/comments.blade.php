<article class="post-comments" id="post-comments">

    <h3><i class="fas fa-comments"></i> {{ $post->commentsNumber() }}</h3>

    <div class="comment-body padding-10">
        <ul class="comments-list">

            @php
                /* @var App\Comment $comment */
            @endphp

            @foreach($postComments as $comment)

                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>{{ $comment->author_name }}
                                <small>{{ $comment->date }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        {!! $comment->body_html !!}
                    </div>
                </li>

            @endforeach
        </ul>

        <nav>
            {!! $postComments->links() !!}
        </nav>

    </div>

    <div class="comment-footer padding-10">
        <h3>Leave a comment</h3>
        {!! Form::open([
            'route' => ['blog.comments', $post->slug],
        ]) !!}
        <div class="form-group required">
            <label for="name">Name</label>
            {!! Form::text('author_name', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            <label for="email">Email</label>
            {!! Form::text('author_email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            {!! Form::text('author_url', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            <label for="comment">Comment</label>
            {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 6]) !!}
        </div>
        <div class="clearfix">
            <div class="float-left">
                {!! Form::submit('Submit', ['class' => 'btn  btn-success']) !!}
            </div>
            <div class="float-right">
                <p class="text-muted">
                    <span class="required">*</span>
                    <em>Indicates required fields</em>
                </p>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

</article>

