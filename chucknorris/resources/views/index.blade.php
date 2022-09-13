<x-layout>
    <div class="container-fluid">
        @if (\Session::has('failed'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('failed') !!}</li>
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3"><input type="checkbox" id="checkAll"> Check Alles</div>
                    <div class="col-md-9 text-right"><a href="/" class="btn btn-sm btn-success">Zoek andere grappen</a></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6"><h3 style="margin-top: 0px">Mijn {{count($favorites)}} favorieten</h3></div>
                    <div class="col-md-6 text-right"><a href="/deleteall" class="btn btn-sm btn-danger">Verwijder alle favorieten</a></div>
                </div>
            </div>
        </div>

            <hr />

        <div class="row">
            <div class="col-md-6">
                <form action="/save" method="post">
                    @csrf
                    @foreach ($jokes->value as $joke)
                        <div class="row form-group ckeckbox-inline">
                            <label class="col-md-1" for="{{$joke->id}}"><input type="checkbox" name="joke[]" class="form-control" onclick="countTotalChecks()" value="{{$joke->id}}"></label>
                            <div id="{{$joke->id}}" class="col-md-11" class="form-control">{{$joke->joke}}</div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-sm btn-success" id="savebuttonid">Voeg toe aan favorieten</button>
                </form>
            </div>
            <div class="col-md-6">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
                @foreach ($favorites as $favorite)
                    <div class="row form-group inline-block">
                        <div class="col-md-2"><a href="/delete/{{$favorite->id}}" class="btn btn-sm btn-danger">Verwijder</a></div>
                        <div class="col-md-10" class="form-control">{{$favorite->joke}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
<script>

    $("#savebuttonid").attr("disabled", true);

    function countTotalChecks() {
        if ($(':checkbox:checked').length > 0){
            $("#savebuttonid").removeAttr("disabled");
        }else{
            $("#savebuttonid").attr("disabled", true);
        }
    }

    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
        if ($(':checkbox:checked').length > 0){
            $("#savebuttonid").removeAttr("disabled");
        }
    });
</script>
