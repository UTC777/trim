<div class="leave-reply">
    <h3>Leave A Reply</h3>
    <form action="{{ route('blog.comments.store', $article->id) }}" method="POST">
        @csrf
        <p>Your email address will not be published. Required fields are marked*</p>
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="form-group">
                    <label>Name*</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6">
                <div class="form-group">
                    <label>Email*</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label>Your Website Link</label>
                    <input type="text" name="website" id="website" class="form-control">
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="message" class="form-control" id="message" rows="8" required></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <button type="submit" class="default-btn">
                    Post A Comment
                </button>
            </div>
        </div>
    </form>
</div>
