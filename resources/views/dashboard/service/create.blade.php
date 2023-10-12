@extends('dashboard.layouts.main')

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
                    <div class="card-body">
                        <h5 class="card-title">Create Request</h5>
                        <form action="{{ route('service.store') }}" method="post" class="php-email-form mt-3"
                            enctype="multipart/form-data">
                            @csrf

                            <label for="account" class="form-label fw-semibold">Account</label>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" readonly class="form-control" id="name"
                                        placeholder="Your Name" disabled value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6 form-group mt-md-0 mt-3">
                                    <input type="email" readonly class="form-control" id="email"
                                        placeholder="Your Email" disabled value="{{ auth()->user()->email }}" required>
                                </div>
                            </div>

                            <label for="request" class="form-label fw-semibold mt-4">Request</label>
                            <div class="form-group">
                                <select class="form-select" name="type" id="type" onchange="selectType(this)">
                                    <option selected disabled>Pilih Jenis Elektronik</option>
                                    <option value="tv">TV</option>
                                    <option value="kulkas">Kulkas</option>
                                    <option value="ac">AC</option>
                                    <option value="kamera">Kamera</option>
                                    <option value="speaker">Speaker</option>
                                    <option value="oven">Oven</option>
                                    <option value="mesin cuci">Mesin cuci</option>
                                    <option value="drone">Drone</option>
                                    <option value="radio">Radio</option>
                                    <option value="hp/tablet">Hp/Tablet</option>
                                    <option value="laptop">Laptop</option>
                                    <option value="komputer">Komputer</option>
                                    <option value="playstation">Playstation</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div id="typeOtherContainer"></div>
                            <div class="form-group mt-3">
                                <select class="form-select" name="work" id="work">
                                    <option selected disabled>Pilih Tempat Perbaikan</option>
                                    <option value="home">Rumah</option>
                                    <option value="office">Kantor</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="description" rows="5" placeholder="Description" required></textarea>
                            </div>
                            <div class="mt-3">
                                <label for="formFileMultiple" class="form-label">Image (optional)</label>
                                <input onchange="previewImageMultiple()" name="images[]" class="form-control" type="file"
                                    id="multipleFiles" multiple>
                            </div>
                            <div class="mt-3">
                                <div class="row" style="row-gap: 13px" id="image-container">
                                </div>
                            </div>
                            @if (auth()->check())
                                <div class="mt-3 text-center"><button class="btn btn-primary" type="submit">Send</button>
                                </div>
                            @else
                                <div class="mt-3 text-center"><button disabled class="btn btn-primary" type="button">Login
                                        Terlebih
                                        Dahulu!</button></div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const imageInput = document.querySelector("#multipleFiles");
        const imageContainer = document.querySelector("#image-container");

        function previewImageMultiple() {
            // Bersihkan semua elemen gambar yang ada sebelumnya
            imageContainer.innerHTML = "";

            const files = imageInput.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file) {
                    const blob = URL.createObjectURL(file);

                    // Buat div dan elemen gambar dengan template literal
                    const imageHTML = `
                   <div class="col-md-6 col-lg-3" id="image-${i + 1}">
                       <img src="${blob}" alt="image-${i + 1}" class="img-fluid w-100 border rounded" style="height: 200px; object-fit: cover">
                   </div>
               `;

                    // Tambahkan div dan elemen gambar ke dalam container
                    imageContainer.innerHTML += imageHTML;
                }
            }
        };

        function selectType(selectElement) {
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
    </script>
@endpush
