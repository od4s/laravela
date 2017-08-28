@foreach(['danger','warning','success','info'] as $msg)

    @if(session()->has($msg))
        <div class="flash-message">
            <p class="alert alert-{{$msg}}">
                {{session()->get($msg)}}
            </p>
        </div>



        @endif

    @endforeach


<!--

可以使用 session()->get('success') 通过键名来取出对应会话中的数据

session()->has($msg) 可用于判断会话中 $msg 键对应的值是否为空，若为空则在页面上不进行显示。
最后，我们通过 session()->get($msg) 来取出对应的值并在页面上进行显示。


-->