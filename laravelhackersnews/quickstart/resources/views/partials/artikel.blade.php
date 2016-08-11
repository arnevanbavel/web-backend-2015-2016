<div class="row">
    <div class="span8">
        <div class="row">
            <div class="col-md-12">
                <h4><strong><a href="#"></a></strong></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="upvote topic upvote-disabled" data-post="{{ $artikel->id }}">
                    <a id="up" class="upvote vote {{ $artikel->votes && $artikel->votes->contains('user_id', Auth::id()) ? ($artikel->votes->where('user_id', Auth::id())->first()->value > 0 ? 'upvote-on' : null) : null}}" data-value="1" data-post-id="{{ $artikel->id }}"></a>
                    <!-- Notice how we set the sum of the votes for this post here -->
                    <span class="count">{{ $artikel->votes->sum('value') }}</span>
                    <a id="down" class="downvote vote {{ $artikel->votes && $artikel->votes->contains('user_id', Auth::id()) ? ($artikel->votes->where('user_id', Auth::id())->first()->value < 0 ? 'downvote-on' : null) : null}}" data-value="-1" data-post-id="{{ $artikel->id }}"></a>
                </div>
            </div>
            <div class="col-md-10">
                <p>
                        <a href="http://{{ $artikel->link }}" target="_blank">{{ $artikel->title }}</a> 
                </p>
                <p style="color: darkgrey; font-size: 12px;">
                    <i class="glyphicon glyphicon-user" style="padding-right: 5px;"></i>submitted by {!!  link_to_route('profile_path', $artikel->user->name, $artikel->user->name) !!}
                    <i class="glyphicon glyphicon-calendar" style="padding-left: 15px;"></i> {{ $artikel->created_at->diffForHumans() }}
                    <i class="glyphicon glyphicon-comment" style="padding-left: 15px;"></i> <a href="{{ action('CommentController@show', [$artikel->id]) }}">{{ $artikel->comments->count() }} Comments</a>
                    @if(Auth::check())
                    @if ($artikel->user->name == Auth::user()->name )
                        <i class="glyphicon glyphicon-pencil" style="padding-left: 15px;"></i> <a href="{{ action('ArtikelsController@edit', $artikel->id) }}">Edit</a>
                    @endif
                    @endif
                    

                </p>
                @if(Request::is('artikels/*'))
                    <p>{!!  $artikel->text !!}</p>
                @endif
            </div>
        </div>
    </div>
</div>
