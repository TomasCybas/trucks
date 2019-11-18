@section('scripts')
    <script type="text/javascript">


        /**
         *
         * @param {selector} select2El select2 dropdown DOM element. ID or class selector.
         * @param {selector} modalEl   modal DOM element that contains the create form. ID or class selector.
         * @param {selector} formEl    new entry creation form DOM element. ID or class selector.
         * @param {selector} errorEl   DOM element used for displaying errors. ID or class selector.
         */

        function handleSelect2CreateNew(select2El, modalEl, formEl, errorEl){
            modalEl.on('show.bs.modal', function () {
                select2El.select2('close');
            })
                .on('hidden.bs.modal', function(){
                    $(this).find('form').trigger('reset');
                    errorEl.removeClass('d-block').addClass('d-none').html('');
                });
            formEl.on('submit', function(e){
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    type: 'post',
                    url: url,
                    data: formEl.serialize(),
                    error: function (data) {
                        var errors = data.responseJSON;
                        var errorsHtml = '';
                        if (!$.isEmptyObject(errors)) {
                            $.each(errors.errors, function (key, value) {
                                errorsHtml += "<p>" + value[0] + "</p>";
                            });
                            errorEl.addClass('d-block').html(errorsHtml);
                        }
                    },
                    success: function () {
                        errorEl.removeClass('d-block').addClass('d-none').html('');
                        modalEl.modal('hide');
                    }
                })
            })
        }


        $(document).ready(function () {
            //Handles select search for cities
            $(".city-select2").select2({
                ajax: {
                    url: '{{route('select.city')}}'
                },
                placeholder: "Pasirinkti miestą",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_city_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            handleSelect2CreateNew(
                $('.city-select2'),
                $('#create_city_form_modal'),
                $('#create_city_form'),
                $('#modal_city_form_errors')
            );

            //Handles select search for clients
            $(".client-select2").select2({
                ajax: {
                    url: '{{route('select.client')}}'
                },
                placeholder: "Pasirinkti klientą",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_client_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            handleSelect2CreateNew(
                $('#client_id'),
                $('#create_client_form_modal'),
                $('#create_client_form'),
                $('#modal_client_form_errors')
            );


            //Handles select search for drivers
            $(".driver-select2").select2({
                ajax: {
                    url: '{{route('select.driver')}}'
                },
                placeholder: "Pasirinkti vairuotoją",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_driver_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            handleSelect2CreateNew(
                $('#driver_id'),
                $('#create_driver_form_modal'),
                $('#create_driver_form'),
                $('#modal_driver_form_errors')
            );

            //Handles select search for trucks
            $(".truck-select2").select2({
                ajax: {
                    url: '{{route('select.truck')}}'
                },
                placeholder: "Pasirinkti sunkvežimį",
                language: {
                    "noResults": function () {
                        var modalButton =
                            '<button type="button" ' +
                            'class="btn btn-sm btn-success ml-5" ' +
                            'data-toggle="modal" data-target="#create_truck_form_modal">' +
                            'Pridėti naują' +
                            '</button>';
                        return 'Nėra atitikmenų.' + modalButton;
                    }
                },
                escapeMarkup: function (markup) {
                    return markup
                }
            });

            handleSelect2CreateNew(
                $('#truck_id'),
                $('#create_truck_form_modal'),
                $('#create_truck_form'),
                $('#modal_truck_form_errors')
            );
        });
    </script>
@endsection
