@extends('dashboard.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.css') }}">

    <style>
        .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #ccc;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
        }

        .delete-button:hover {
            background-color: rgb(223, 223, 223);
            color: #000;
        }
    </style>
@endpush

@section('content')
    <div class="pagetitle">
        <h1>Request Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Request</li>
            </ol>
        </nav>
    </div>

    <section class="section" id="service">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center my-0 py-0">
                        <h5 class="card-title">Edit Request</h5>

                        <div>
                            <a class="btn btn-primary text-primary border-0 bg-transparent"
                                href="{{ route('profile.edit', $service->user) }}">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('service.update', $service) }}" method="post" class="php-email-form mt-3"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <label for="account" class="form-label fw-semibold">Account</label>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" readonly class="form-control" id="name"
                                        placeholder="Your Name" disabled value="{{ $service->user->name }}" required>
                                </div>
                                <div class="col-md-6 form-group mt-md-0 mt-3">
                                    <input type="email" readonly class="form-control" id="email"
                                        placeholder="Your Email" disabled value="{{ $service->user->email }}" required>
                                </div>
                            </div>

                            <label for="request" class="form-label fw-semibold mt-4">Request</label>
                            <div class="form-group">
                                <select class="form-select @error('type') is-invalid @enderror" name="type"
                                    id="selectType" data-old-type="{{ old('type', $service->type) }}"
                                    onchange="selectTypeChange(this)">
                                    <option selected disabled>Pilih Jenis Elektronik</option>
                                    <option {{ old('type', $service->type) == 'tv' ? 'selected' : '' }} value="tv">TV
                                    </option>
                                    <option {{ old('type', $service->type) == 'kulkas' ? 'selected' : '' }} value="kulkas">
                                        Kulkas</option>
                                    <option {{ old('type', $service->type) == 'ac' ? 'selected' : '' }} value="ac">AC
                                    </option>
                                    <option {{ old('type', $service->type) == 'kamera' ? 'selected' : '' }} value="kamera">
                                        Kamera</option>
                                    <option {{ old('type', $service->type) == 'speaker' ? 'selected' : '' }}
                                        value="speaker">Speaker</option>
                                    <option {{ old('type', $service->type) == 'oven' ? 'selected' : '' }} value="oven">
                                        Oven</option>
                                    <option {{ old('type', $service->type) == 'mesin cuci' ? 'selected' : '' }}
                                        value="mesin cuci">Mesin cuci</option>
                                    <option {{ old('type', $service->type) == 'drone' ? 'selected' : '' }} value="drone">
                                        Drone</option>
                                    <option {{ old('type', $service->type) == 'radio' ? 'selected' : '' }} value="radio">
                                        Radio</option>
                                    <option {{ old('type', $service->type) == 'hp/tablet' ? 'selected' : '' }}
                                        value="hp/tablet">Hp/Tablet</option>
                                    <option {{ old('type', $service->type) == 'laptop' ? 'selected' : '' }} value="laptop">
                                        Laptop</option>
                                    <option {{ old('type', $service->type) == 'komputer' ? 'selected' : '' }}
                                        value="komputer">Komputer</option>
                                    <option {{ old('type', $service->type) == 'playstation' ? 'selected' : '' }}
                                        value="playstation">Playstation</option>
                                    <option {{ old('type', $service->type) == 'lainnya' ? 'selected' : '' }}
                                        value="lainnya">Lainnya</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="typeOtherContainer"></div>
                            <div class="form-group mt-3">
                                <select class="form-select @error('work') is-invalid @enderror" name="work"
                                    id="selectWork" data-old-work="{{ old('work', $service->work) }}"
                                    onchange="selectWorkChange(this)">
                                    <option selected disabled>Pilih Tempat Perbaikan</option>
                                    <option {{ old('work', $service->work) == 'home' ? 'selected' : null }} value="home">
                                        Rumah</option>
                                    <option {{ old('work', $service->work) == 'office' ? 'selected' : null }}
                                        value="office">Kantor
                                    </option>
                                </select>
                                @error('work')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="alamatWaktuContainer"></div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="description" rows="5" placeholder="Description" required>{{ old('description', $service->description) }}</textarea>
                            </div>
                            <div id="deleted-id-image" hidden></div>
                            <div class="mt-3">
                                <label for="formFileMultiple" class="form-label">Image (optional)</label>
                                <input onchange="previewImageMultiple()" name="images[]" class="form-control" type="file"
                                    id="multipleFiles" multiple>
                            </div>
                            <div class="mt-3">
                                <div class="row" style="row-gap: 13px" id="image-container">
                                    @foreach ($service->images as $image)
                                        <div class="col-md-6 col-lg-3" id="image-{{ $image->id }}">
                                            <div style="position: relative;">
                                                <img src="{{ asset('images/' . $image->path) }}"
                                                    alt="image-{{ $image->id }}"
                                                    class="img-fluid w-100 img-x rounded border"
                                                    style="height: 200px; object-fit: cover">
                                                <button type="button" class="delete-button"
                                                    onclick="deleteImage(this,{{ $image->id }})">
                                                    <i class='bx bx-x'></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-3 text-center"><button class="btn btn-primary" type="submit">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/datetime-picker/bootstrap-datetimepicker.id.js') }}"></script>

    <script>
        $(function() {
            const selectedOldType = $('#selectType').data('old-type');
            if (selectedOldType) {
                $('#selectType').trigger('change');
            }

            const selectedOldWork = $("#selectWork").data('old-work');
            if (selectedOldWork) {
                $("#selectWork").trigger('change');
            }

            dateTime('#schedule')
        });

        function deleteImage(el, imageId) {
            // Temukan elemen terdekat dengan ID yang sesuai
            const confirmDelete = confirm("Apakah Anda yakin ingin menghapus gambar ini?");

            if (confirmDelete) {
                const imageDiv = $(el).closest(`#image-${imageId}`);

                if (imageDiv) {
                    imageDiv.remove();

                    const deletedImageInput = `
                        <input type="text" name="img_deleted[]" value="${imageId}">
                    `;

                    // Tambahkan input teks ke dalam div "deleted-id-image"
                    $("#deleted-id-image").append(deletedImageInput);
                }
            }
        }

        const dt = new DataTransfer();

        function deleteImagePre(el, imageId) {
            // Temukan elemen preview terdekat dengan ID yang sesuai
            const imageDiv = $(el).closest(`#image-pre${imageId}`);

            if (imageDiv) {
                imageDiv.remove();
            }

            let name = imageDiv.find('img').data('name');
            for (let i = 0; i < dt.items.length; i++) {
                if (name === dt.items[i].getAsFile().name) {
                    dt.items.remove(i);
                }
            }
            document.getElementById('multipleFiles').files = dt.files;
        }

        function previewImageMultiple() {
            const imageInput = document.querySelector("#multipleFiles");
            const imageContainer = $("#image-container");

            const files = imageInput.files;

            for (let i = 0; i < files.length; i++) {
                let duplicate = false;
                const file = files[i];

                if (file) {

                    for (let i = 0; i < dt.items.length; i++) {
                        if (file.name === dt.items[i].getAsFile().name) {
                            duplicate = true;
                            break; // Keluar dari loop ketika ada file duplikat
                        } else {
                            duplicate = false
                        }
                    }

                    if (!duplicate) {
                        dt.items.add(file);

                        const blob = URL.createObjectURL(file);

                        // Buat elemen gambar dengan template literal dan jQuery
                        const imageHTML = `
                            <div class="col-md-6 col-lg-3" id="image-pre${i}">
                                <div style="position: relative;">
                                    <img src="${blob}"
                                        alt="image-pre${i}"
                                        data-name="${file.name}"
                                        class="img-fluid w-100 img-x rounded border"
                                        style="height: 200px; object-fit: cover">
                                    <button type="button" class="delete-button"
                                        onclick="deleteImagePre(this, ${i})">
                                        <i class='bx bx-x'></i>
                                    </button>
                                </div>
                            </div>
                        `;

                        // Tambahkan elemen gambar ke dalam container menggunakan jQuery
                        imageContainer.append(imageHTML);
                    } else {
                        alert('Tidak bisa upload image yang sama')
                    }
                }
            }

            imageInput.files = dt.files;
        }

        function dateTime(id) {
            $(id).datetimepicker({
                language: 'id',
                todayBtn: true,
                autoclose: true,
                format: 'yyyy-mm-dd hh:ii',
            });
        }

        function selectTypeChange(selectElement) {
            const selectedValue = $(selectElement).val();
            const typeOtherInput = $('#typeOtherContainer');

            if (selectedValue === 'lainnya') {
                // Jika yang dipilih adalah "lainnya", tambahkan input
                const inputHtml = `
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" id="typeOther" name="type" placeholder="Ketikkan jenis" required>
                    </div>
                `;
                typeOtherInput.html(inputHtml); // Tambahkan input ke dalam kontainer
            } else {
                // Jika yang dipilih bukan "lainnya", hapus input
                typeOtherInput.empty(); // Hapus konten dari kontainer
            }
        }

        function selectWorkChange(selectElement) {
            const selectedValue = $(selectElement).val();
            const alamatWaktuContainer = $('#alamatWaktuContainer');

            if (selectedValue === 'home') {
                const inputHtml = `
                    <div class="form-group mt-3">
                        <input type="text" readonly class="form-control" id="alamat" placeholder="Alamat Belum Diisi"
                            disabled value="{{ $service->user->client?->alamat }}" required>
                        <small>
                            <div id="alamatHelpBlock" class="form-text">
                                Update profil jika ingin mengubah
                            </div>
                        </small>
                    </div>
                    <div class="form-group mt-3">
                        <input name="schedule" type="datetime" step="60" min="{{ date('Y-m-d 00:00') }}" autocomplete="off"
                            value="{{ old('schedule', $service->appointment?->schedule) }}" class="form-control @error('schedule') is-invalid @enderror" id="schedule" placeholder="Waktu" />
                        @error('schedule')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                `;
                alamatWaktuContainer.html(inputHtml); // Tambahkan input ke dalam kontainer
                dateTime('#schedule')
            } else {
                // Jika yang dipilih bukan "lainnya", hapus input
                alamatWaktuContainer.empty(); // Hapus konten dari kontainer
            }
        }
    </script>
@endpush
