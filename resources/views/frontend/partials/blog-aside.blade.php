                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __('Categories') }}</h4>
                            <ul>
                                <li><a href="{{ route('frontend.blog') }}" class="{{ Request::is('blog*') && !Request::is('blog/category/*') ? 'active' : '' }}">{{ __('All') }}</a></li>

                                @foreach ($blogCategories as $blogCategory)
                                    <li>
                                        <a href="{{ route('frontend.blogsByCategory', $blogCategory->slug) }}" class="{{ Request::is('blog/category/'.$blogCategory->slug) ? 'active' : '' }}">
                                           {{ $blogCategory->name }} ({{ $blogCategory->blogs->count() }})
                                        </a>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __('Recent News') }}</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($latestBlog as $blog)
                                    <a href="{{ url('blog/' . $blog->slug) }}" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{ $blog->thumbnail }}" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{ $blog->title }}</h6>
                                            <span>{{ $blog->created_at }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __('Search By') }}</h4>
                            <div class="blog__sidebar__item__tags">

                                @foreach ($tags as $tag)
                                    <a href="{{ route('frontend.blogsByTag', $tag->slug) }}"  class="{{ Request::is('blog/tag/'.$tag->slug) ? 'active' : '' }}">
                                        {{ $tag->name }} -- ({{ $tag->blogs->count() }})
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>
