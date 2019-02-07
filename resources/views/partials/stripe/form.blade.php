<form action="{{ route('subscriptions.proccess_subscription') }}" method="POST">
	@csrf
	 <input type="text"
	class="form-control"
	name="coupon"
	placeholder="{{ __("¿Tienes un cupón?") }}"
	/>

	<input type="hidden" name="type" value="{{ $product['type'] }}">
	<hr/>
	{{-- Aqui formulario de stripe --}}

	<stripe-form
	stripe_key="{{ env("STRIPE_KEY") }}"
	name="{{ $product['name'] }}"
	amount="{{ $product['amount'] }}"
	description="{{ $product['description'] }}"
	></stripe-form>
</form>
