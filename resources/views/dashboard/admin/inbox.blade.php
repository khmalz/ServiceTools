@extends('dashboard.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Inbox</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Inbox</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <form method="POST" action="{{ route('admin.inbox.read') }}">
                        @csrf
                        <button class="btn btn-primary btn-sm" type="submit">
                            Read all
                        </button>
                    </form>
                </div>
                <div class="card mb-2">
                    <div class="card-body d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h6 class="text-dark m-0">
                                <span>There's new appointment task for a <a href="#" class="text-info">order</a>
                                </span>
                            </h6>
                            <small>
                                <p class="m-0">22 Oct 2023,
                                    13:10 |
                                    23m ago</p>
                            </small>
                        </div>

                        <div>
                            @if (true)
                                <form method="POST" action="{{ route('admin.inbox.read', 1) }}">
                                    @csrf
                                    <button class="btn btn-sm text-primary m-0 border-0 bg-transparent" type="submit">
                                        Read
                                    </button>
                                </form>
                            @else
                                <p class="btn btn-sm text-secondary m-0 border-0 bg-transparent" style="cursor: default">
                                    Read</p>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- @forelse ($notifications as $notification)
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center py-3">
                            <div>
                                <h6 class="text-dark m-0">
                                    <span>Siswa mengirim permintaan untuk meninjau <a href="#"
                                            class="text-info">Laporan</a>
                                    </span>
                                </h6>
                                <small>
                                    <p class="m-0">22 Oct 2023,
                                        13:10 |
                                        23m ago</p>
                                </small>
                            </div>

                            <div>
                                @if (true)
                                    <form method="POST" action="{{ route('inbox.read', 1) }}">
                                        @csrf
                                        <button class="btn btn-sm text-primary m-0 border-0 bg-transparent" type="submit">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @else
                                    <p class="btn btn-sm text-secondary m-0 border-0 bg-transparent"
                                        style="cursor: default">Tandai Dibaca</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card mb-2">
                        <div class="card-body py-3">
                            <div>
                                <h6 class="text-dark m-0 text-center">
                                    Tidak ada Inbox untuk hari ini
                                </h6>
                            </div>
                        </div>
                    </div>
                @endforelse --}}
            </div>
        </div>
    </section>
@endsection
