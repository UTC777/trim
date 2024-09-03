<div itemscope itemtype="http://schema.org/CollectionPage" class="col-12">
    <div class="col-lg-12">
        <div class="pagination-area">
            {{-- <span class="page-numbers current" aria-current="page">1</span>
            <a href="#" class="page-numbers">2</a>
            <a href="#" class="page-numbers">3</a>
            
            <a href="#" class="next page-numbers">
                <i class="flaticon-right-arrow"></i>
            </a> --}}
            {{ $articles->links('vendor.pagination.default') }}
        </div>
    </div>
</div>