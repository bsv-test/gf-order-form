@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-11 col-md-8 col-lg-6">
            <order-form-component :priceplans='@json($pricePlans)' />
        </div>
    </div>
                                {{-- @dump($pricePlans) --}}
        {{-- <div class="card shadow-sm border-top border-primary"> --}}
            {{-- <div class="card-body p-4"> --}}
                {{-- <h1>{{ __('orders.order_now_title') }} &#x1F371;&#x1F957;&#x1F35C;</h1> --}}


                {{-- <form method="POST" action={{ route('orders.store') }}> --}}
                    {{-- @csrf --}}
                    {{-- <div class="form-group">
                        <label for="userPhone">{{ __('orders.user.phone') }}</label>
                        <input type="input" name="user[phone]" id="userPhone" class="form-control" placeholder="+7 123 123 12 12">
                    </div>
                    <div class="form-group">
                        <label for="userName">{{ __('orders.user.name') }}</label>
                        <input type="input" name="user[name]" id="userName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pricePlan">{{ __('orders.order.price_plan') }}</label> --}}
                        {{-- <select name="order[price_plan_id]" class="form-control" id="pricePlan">
                            @foreach ($pricePlans as $pricePlan)
                                <option value="{{ $pricePlan->id }}">{{ $pricePlan->name }} ({{ __('orders.delivery_days') }}: {{ implode(',', $pricePlan->delivery_days) }}) – {{ $pricePlan->getPrice() }} ₽</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deliveryDay">{{ __('orders.order.delivery_day') }}</label>
                        <select name="order[delivery_day]" class="form-control" id="deliveryDay">
                            <option value="2020-07-10">ПН 4.07.2020</option> --}}
                        {{-- </select> --}}
                        {{-- <small class="form-text text-muted">{{ __('orders.select_delivery_day') }}</small> --}}
                    {{-- </div> --}}
                    {{-- <button type="submit" class="btn btn-primary">{{ __('orders.make_order_button') }}</button> --}}
                {{-- </form> --}}
            {{-- </div> --}}
        {{-- </div> --}}
@endsection
