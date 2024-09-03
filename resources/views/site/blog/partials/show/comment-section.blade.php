<!-- Comments Section -->
<div class="comments-area" itemscope itemtype="http://schema.org/Comment">
    <h3>Comments</h3>
    @foreach($article->comments as $comment)
    <div class="comment-list" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
        <div class="single-comment">
            <div class="comment-content" itemscope itemtype="http://schema.org/UserComments">
                <h4 itemprop="creator" itemscope itemtype="http://schema.org/Person">
                    <span itemprop="name">{{ $comment->name }}</span>
                </h4>
                <p itemprop="commentText">{{ $comment->comment }}</p>
                <meta itemprop="dateCreated" content="{{ $comment->created_at->toIso8601String() }}">
                <span>{{ $comment->created_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

