        @csrf
        <textarea name='body' cols="30" rows="10"> {{$comment->body ?? old('body')}} </textarea> <br>
        
        <label for="checkbox">
                 <input type='checkbox' id='visible' name='visible'
                 @if (isset($comment) && $comment->visible)
                        checked = "checked"
                 @endif
                 > 
                 Visivel?
        </label> <br>
        <input type="submit" value='enviar'>    