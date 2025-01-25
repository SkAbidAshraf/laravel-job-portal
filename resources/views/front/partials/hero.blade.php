<section class="section-0 lazy d-flex bg-image-style dark align-items-center " class=""
    data-bg="assets/images/banner7.jpg">
    <div class="container">
        <div class="col-12 mx-auto text-center">
            <h1>Find your dream job</h1>
            <p>Thounsands of jobs available.</p>

            <div class="container col-12 col-xl-10 mt-5">
                <div class="card border-0 p-3 shadow">
                    <form action="{{ route('jobs') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control focus-ring" name="keyword" id="keyword"
                                placeholder="Keywords">

                            <input type="text" class="form-control focus-ring" name="location" id="location"
                                placeholder="Location">

                            <select name="category" id="category" class="form-select">
                                <option value="">Select a Category</option>
                                @if (count($popularCategories) > 0)
                                    @foreach ($popularCategories as $popularCategory)
                                        <option value="{{ $popularCategory->id }}">{{ $popularCategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>

                            <button type="submit" class="btn btn-primary">Find jobs</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section class="section-1 py-5">
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs') }}" method="get">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location"
                            placeholder="Location">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            @if (count($categories) > 0)
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section> --}}
