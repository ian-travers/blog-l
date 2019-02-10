@if(isset($categoryName))
    <div class="alert alert-info">
        Category: <strong>{{ $categoryName }}</strong>
    </div>
@endif

@if(isset($authorName))
    <div class="alert alert-info">
        Author: <strong>{{ $authorName }}</strong>
    </div>
@endif

@if($term = request('term'))
    <div class="alert alert-info">
        Search Results for: <strong>{{ $term }}</strong>
    </div>
@endif


