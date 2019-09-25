@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".city-select2").select2({
                ajax:{
                    url: '{{route('select.city')}}'
                },
                placeholder: "Pasirinkti miestą",
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('city.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
            $("#client_id").select2({
                ajax:{
                    url: '{{route('select.client')}}'
                },
                placeholder: "Pasirinkti klientą",
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('client.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }

            });
            $("#driver_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('driver.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
            $("#truck_id").select2({
                language: {
                    "noResults": function () {
                        return 'Nėra atitikmenų.  <a href="{{route('truck.create')}}" class="btn btn-success btn-sm ml-5">Pridėti naują</a>';
                    }
                },
                escapeMarkup: function(markup){
                    return markup
                }
            });
        });

    </script>
@endsection
