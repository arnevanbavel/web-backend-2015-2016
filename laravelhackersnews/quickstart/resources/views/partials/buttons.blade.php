                <div class="vote" data-post="{{ $artikel->id }}">
                    @if(Auth::check())
                    <form method="POST" action="{{ url('vote/up')}}/{{$artikel->id }}">
					   {{ csrf_field() }}
					   <button class="but"><i class="glyphicon glyphicon-triangle-top" title="upvote"></i></button>
				    </form>
                    <span class="count">{{ $artikel->value }}</span>
                    <form method="POST" action="{{ url('vote/down')}}/{{$artikel->id }}">
					   {{ csrf_field() }}
					   <button class="but"><i class="glyphicon glyphicon-triangle-bottom" title="downvote"></i></button>
				    </form>
                    @else
                    <form>
					   <button class="but disabled" disabled><i class="glyphicon glyphicon-triangle-top"></i></button>
				    </form>
                    <span class="count">{{ $artikel->value }}</span>
                    <form>
					   <button class="but disabled" disabled><i class="glyphicon glyphicon-triangle-bottom"></i></button>
				    </form>
                    @endif
                    
                </div>