        <div class="row">
            <div class="col-md-1">
                @include('partials/buttons')
            </div>
            <div class="col-md-10">
                <p>
                        <a href="http://{{ $artikel->link }}" target="_blank">{{ $artikel->title }}</a> 
                </p>
                @foreach($artikel->votes as $artikelvotes)
                            @if($artikelvotes->user_id == Auth::user()->id)  
                                @foreach($artikelvotes-up as $up)
                                    {{$up->up}}
                                @endforeach
                            @endif
                @endforeach
                <p style="color: darkgrey; font-size: 12px;">
                    <i class="glyphicon glyphicon-user" style="padding-right: 5px;"></i>submitted by {{ $artikel->user->name}}
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
