@extends('layouts.app')

@section('title')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Ordem de Pagamento</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Ordem de Pagamento</a></li>
                    <li class="breadcrumb-item active">Gestão</li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="auth-logo">
                        </div>
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Ordem de pagamento</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-3">
                            <h6>Dados do consultor</h6>
                            <address>
                                Nome: {{ $payment->consultant->user['name'] }}<br>
                                E-mail: {{ $payment->consultant->user['email'] }}<br>
                                Pix: {{ $payment->consultant->pix }}<br>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-2">
                        <div class="mt-3 float-end">
                            <p><strong>Data : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $payment->created_at->format('d/m/Y') }}</span></p>
                            <p><strong>Status : </strong> <span class="float-end">
                                @switch($payment->status)
                                    @case(0)
                                    <span class="badge bg-warning">Pendente</span></span>
                                        @break
                                    @case(1)
                                    <span class="badge bg-success">Pagamento realizado</span></span>
                                        @break
                                    @default
                                    <span class="badge bg-danger">Cancelado</span></span>
                                @endswitch
                            </p>
                            <p><strong>Núm. da ordem : </strong> <span class="float-end">{{ $payment->id }} </span></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mt-4 table-centered">
                                <thead>
                                <tr>
                                    <th>Cliente/Serviço</th>
                                    <th style="width: 10%">Horas</th>
                                    <th style="width: 10%">Valor hora</th>
                                </tr></thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <b>{{ $payment->customer }}</b> <br>
                                        @if ($payment->type_service == '0')
                                            Senior
                                        @else
                                            Particular
                                        @endif
                                    </td>
                                    <td>{{ $payment->hours }}</td>
                                    <td>R$ {{ $payment->value }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-5">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end">
                            <p><b>Sub-total:</b></p>
                            <h3>R$ {{ $payment->payment }} BRL</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                {{-- <div class="mt-4 mb-1">
                    <div class="text-end d-print-none">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
                        <a href="#" class="btn btn-info waves-effect waves-light">Submit</a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
