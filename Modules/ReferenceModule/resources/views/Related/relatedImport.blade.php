@extends('main.app')
@section('title')
    Related | Mapping Tool
@endsection
@section('css')
@endsection
@section('content')
    <section class="table-sec pt-3">
        <label class="form-label text-1000 fs-0 ps-0 text-capitalize lh-sm mb-2" for="mainAdminLogo">Select the headers from
            the file you uploaded.</label>
        <form method="POST" action="{{ route('related-upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="tab-pane fade active show my-3" id="tab-tab1" role="tabpanel" aria-labelledby="Main-tab">
                <div class="row g-3 mb-5">
                    <div class="col-3">
                        <x-referencemodule::selector label="Name" selectName="name" :options="$headers" />
                    </div>
                    <div class="col-3">

                        <x-referencemodule::selector label="Code" selectName="code" :options="$headers" />
                    </div>
                    <div class="col-3">

                        <x-referencemodule::selector label="Reference Name" selectName="reference_code" :options="$headers" />
                    </div>

                </div>
                <div class="text-center col-1">

                    <x-referencemodule::form-button label="Import" />

                </div>

            </div>
        </form>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameSelect = document.getElementById('nameSelect');
            const codeSelect = document.getElementById('codeSelect');
            const referenceCodeSelect = document.getElementById('reference_codeSelect');

            const headers = @json($headers);

            function updateCodeOptions(selectedName) {
                codeSelect.innerHTML = '<option selected>Select Header</option>'; // Add default option
                headers.forEach(header => {
                    if (header !== selectedName) {
                        const option = document.createElement('option');
                        option.value = header;
                        option.textContent = header;
                        codeSelect.appendChild(option);
                    }
                });
            }

            function updateReferenceCodeOptions(selectedName, selectedCode) {
                referenceCodeSelect.innerHTML = '<option selected>Select Header</option>'; // Add default option
                headers.forEach(header => {
                    if (header !== selectedName && header !== selectedCode) {
                        const option = document.createElement('option');
                        option.value = header;
                        option.textContent = header;
                        referenceCodeSelect.appendChild(option);
                    }
                });
            }

            // Initialize the options for the first time
            updateCodeOptions(nameSelect.value);
            updateReferenceCodeOptions(nameSelect.value, codeSelect.value);

            // Add event listeners
            nameSelect.addEventListener('change', function() {
                updateCodeOptions(nameSelect.value);
                updateReferenceCodeOptions(nameSelect.value, codeSelect.value);
            });

            codeSelect.addEventListener('change', function() {
                updateReferenceCodeOptions(nameSelect.value, codeSelect.value);
            });
        });
    </script>
@endsection
