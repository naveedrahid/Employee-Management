@section('title', 'Dashboard')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12 mb-6">
                <div class="card h-100 bg-success">
                    <div class="card-body">
                        <div
                            class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/assets/img/icons/unicons/chart-success.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                        </div>
                        <p class="mb-1 text-white">Total employee</p>
                        <h4 class="card-title m-0 text-white">{{ totalEmployee()}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mb-6">
                <div class="card h-100 bg-primary">
                    <div class="card-body">
                        <div
                            class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/assets/img/icons/unicons/chart-success.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                        </div>
                        <p class="mb-1 text-white">Total Absent</p>
                        <h4 class="card-title m-0 text-white">{{totalAbsent()}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mb-6">
                <div class="card h-100 bg-warning">
                    <div class="card-body">
                        <div
                            class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/assets/img/icons/unicons/chart-success.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                        </div>
                        <p class="mb-1 text-white">Total Leave</p>
                        <h4 class="card-title m-0 text-white">{{totalLeave()}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mb-6">
                <div class="card h-100 bg-danger">
                    <div class="card-body">
                        <div
                            class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('admin/assets/img/icons/unicons/chart-success.png') }}"
                                    alt="chart success" class="rounded" />
                            </div>
                        </div>
                        <p class="mb-1 text-white">Today Expenses</p>
                        <h4 class="card-title m-0 text-white">{{expenses()}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-6">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="mb-1 me-2">Order Statistics</h5>
                            <p class="card-subtitle">42.82k Total Sales</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn text-body-secondary p-0" type="button"
                                id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-base bx bx-dots-vertical-rounded icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-6">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h3 class="mb-1">8,258</h3>
                                <small>Total Orders</small>
                            </div>
                            <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex align-items-center mb-5">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="icon-base bx bx-mobile-alt"></i></span>
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Electronic</h6>
                                        <small>Mobile, Earbuds, TV</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0">82.5k</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-5">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class="icon-base bx bx-closet"></i></span>
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Fashion</h6>
                                        <small>T-shirt, Jeans, Shoes</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0">23.8k</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-5">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class="icon-base bx bx-home-alt"></i></span>
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Decor</h6>
                                        <small>Fine Art, Dining</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0">849k</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                            class="icon-base bx bx-football"></i></span>
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Sports</h6>
                                        <small>Football, Cricket Kit</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0">99</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->

            <!-- Expense Overview -->
            <div class="col-md-6 col-lg-4 order-1 mb-6">
                <div class="card h-100">
                    <div class="card-header nav-align-top">
                        <ul class="nav nav-pills flex-wrap row-gap-2" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab"
                                    data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income"
                                    aria-controls="navs-tabs-line-card-income" aria-selected="true">
                                    Expenses
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-6">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('admin/assets/img/icons/unicons/wallet.png') }}"
                                    alt="User" />
                            </div>
                            <div>
                                <p class="mb-0">Total Balance</p>
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">{{expenses()}}</h6>
                                </div>
                            </div>
                        </div>
                        <div id="incomeChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Expense Overview -->

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Transactions</h5>
                    </div>
                    <div class="card-body pt-4">
                        <ul class="p-0 m-0">
                            @foreach(allExpenses() as $expense)
                            <li class="d-flex align-items-center mb-6">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('admin/assets/img/icons/unicons/wallet.png') }}"
                                        alt="User" class="rounded" />
                                </div>
                                <div
                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="fw-normal mb-0">{{ $expense->description ?? 'No Title' }}</h6>
                                        <small class="text-success fw-medium">{{ \Carbon\Carbon::parse($expense->approved_at)->format('d M Y') }}</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-2">
                                        <h6 class="fw-normal mb-0">{{ $expense->amount }}</h6>
                                        <span class="text-body-secondary">PKR</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
        </div>
    </div>
</x-app-layout>