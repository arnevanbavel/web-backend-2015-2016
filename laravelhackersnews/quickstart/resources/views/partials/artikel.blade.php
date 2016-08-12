<div class="row">
    <div class="span8">
        <div class="row">
            <div class="col-md-12">
                <h4><strong><a href="#"></a></strong></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="vote" data-post="{{ $artikel->id }}">
                    <form method="POST" action="{{ url('vote/up')}}/{{$artikel->id }}">
					{{ csrf_field() }}
					   <button name="id" value="2" class="btn"><i class="glyphicon glyphicon-triangle-top" title="upvote"></i></button>
				    </form>
                    <span class="count">{{ $artikel->value }}</span>
                    <form method="POST" action="{{ url('vote/down')}}/{{$artikel->id }}">
					{{ csrf_field() }}
					   <button name="id" value="2" class="btn"><i class="glyphicon glyphicon-triangle-bottom" title="downvote"></i></button>
				    </form>
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
            </div>
        </div>
    </div>
</div>
