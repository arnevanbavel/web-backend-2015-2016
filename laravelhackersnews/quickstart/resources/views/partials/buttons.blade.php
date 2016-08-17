<div class="vote" data-post="{{ $artikel->id }}">
    @if(Auth::check() AND Auth::user()->id != $artikel->user_id )
    
                @if($artikel->votes->where('user_id', Auth::user()->id)->contains('algeklikt', 1 ))
    
                                @if( $artikel->votes->where('user_id', Auth::user()->id)->contains('up', 1 ))
                                    <form method="POST" action="{{ url('vote/up')}}/{{$artikel->id }}">
                                        {{ csrf_field() }}
                                        <button class="but"><i class="glyphicon glyphicon-triangle-top" title="upvote"></i></button>
                                    </form>
                                 @else
                                    <form>
                                        <button class="but disabled" disabled><i class="glyphicon glyphicon-triangle-top"></i></button>
                                    </form>
                                @endif   
                                <span class="count">{{ $artikel->value }}</span>
                                @if( $artikel->votes->where('user_id', Auth::user()->id)->contains('down', 1 ))
                                    <form method="POST" action="{{ url('vote/down')}}/{{$artikel->id }}">
                                       {{ csrf_field() }}
                                       <button class="but"><i class="glyphicon glyphicon-triangle-bottom" title="downvote"></i></button>
                                    </form>
                                @else
                                    <form>
                                        <button class="but disabled" disabled><i class="glyphicon glyphicon-triangle-bottom"></i></button>
                                    </form>
                                @endif 
    
                @else
                    <form method="POST" action="{{ url('vote/up')}}/{{$artikel->id }}">
                            {{ csrf_field() }}
                            <button class="but"><i class="glyphicon glyphicon-triangle-top" title="upvote"></i></button>
                    </form>
                    <span class="count">{{ $artikel->value }}</span>
                    <form method="POST" action="{{ url('vote/down')}}/{{$artikel->id }}">
                           {{ csrf_field() }}
                           <button class="but"><i class="glyphicon glyphicon-triangle-bottom" title="downvote"></i></button>
                    </form>
                @endif 
    
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