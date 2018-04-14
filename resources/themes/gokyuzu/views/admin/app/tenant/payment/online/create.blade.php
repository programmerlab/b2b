@extends('admin::layout.box')

@section('boxContent')
	<form id="{!! $appRouter['current']['as'] !!}" data-action="{!! route_action('add') !!}" class="ui form f1 large">
		<div class="ui button submit transition hidden"></div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">
		<p>Ödemenizi kredi kartınızla 3 adımda kolay ve güvenli bir şekilde yapabilirsiniz </p>

		<div class="f1-steps text center">
			<div class="f1-progress">
				<div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
			</div>
			<div class="f1-step active">
				<div class="f1-step-icon"><i class="fa fa-try"></i></div>
				<p>Ödeme Bilgileri</p>
			</div>
			<div class="f1-step">
				<div class="f1-step-icon"><i class="fa fa-list"></i></div>
				<p>Taksit Seçenekleri</p>
			</div>
			<div class="f1-step">
				<div class="f1-step-icon"><i class="fa fa-credit-card"></i></div>
				<p>Kart Bilgileri</p>
			</div>
		</div>
		<fieldset>
			<h3 class="ui header font400">Ödeme Bilgileri</h3>
			<div class="field">
				<label for="">Bayi Kodu/İsmi</label>
				<input type="text" name="dealer" placeholder="Bayi Kodu/İsmi">
			</div>
			<div class="field">
				<label for="">Ödeme Tutarı</label>
				<input name="amount" placeholder="Ödeme Tutarı" type="text">
			</div>
			<div class="field">
				<label for="">Ödeme Tipi</label>
				@include('admin::_parts.dropdown.icon', [
					'name' => 'currency_id',
					'value' => null,
					'key' => 'name',
					'icon' => 'icon_text',
					'items' => config('currencies')
				])
			</div>
			<div class="f1-buttons">
				<button type="button" class="ui button green btn-next">İleri</button>
			</div>
		</fieldset>
		<fieldset>
			<h3 class="ui header font400">Taksit Seçenekleri</h3>
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th>#</th>
						<th>Garanti Pay</th>
						<th>İş Bankası</th>
						<th>Yapı Kredi</th>
						<th>Akbank</th>
						<th>Finansbank</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th>TEK ÇEKİM</th>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox" checked="">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
					</tr>
					<tr>
						<th>2 TAKSİT</th>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox" checked="">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
					</tr>
					<tr>
						<th>4 TAKSİT</th>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox" checked="">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
					</tr>
					<tr>
						<th>6 TAKSİT</th>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
						<td>
							<div class="checkbox checkbox-info checkbox-circle">
								<input id="checkbox8" type="checkbox" checked="">
								<label for="checkbox8">0.00 TL</label>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div class="f1-buttons">
				<button type="button" class="ui button btn-previous">Geri</button>
				<button type="button" class="ui button green btn-next">İleri</button>
			</div>
		</fieldset>
		<fieldset>
			<h3 class="ui header font400">Kredi Kartı Bilgileriniz</h3>
			<div class="field">
				<div class="ui grid">

					<div class="ten wide column">
						<div class="card-area">
							<div class="field">
								<input placeholder="Kart Numaranız" type="tel" name="number"
										class="a1" required>
							</div>
							<div class="field">
								<input placeholder="Adınız Soyadınız" type="text" name="name"
										class="a2" required>
							</div>
							<div class="field">
								<input placeholder="Ay/Yıl" type="tel" name="expiry"
										class="a3" required>
							</div>
							<div class="field">
								<input placeholder="CVC" type="number" name="cvc"
										class="a4" required>
							</div>
						</div>
					</div>
					<div class="six wide column">
						<div class="card-wrapper"></div>
					</div>
				</div>
			</div>
			<div class="f1-buttons">
				<button type="button" class="ui button green">Kaydet</button>
			</div>
		</fieldset>
	</form>
@stop

@section('jsCode')
	@parent
	<script src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/jquery.card.min.js"></script>
	<script>
        $(document).ready(function () {
            App.form.validate('#{!! $appRouter['current']['as'] !!}', {
                /**/
            });

            new Card({
                form: document.querySelector('.card-area'),
                container: '.card-wrapper'
            });

            function scroll_to_class(element_class, removed_height) {
                var scroll_to = $(element_class).offset().top - removed_height;
                if ($(window).scrollTop() !== scroll_to) {
                    $('html, body').stop().animate({scrollTop: scroll_to}, 0);
                }
            }

            function bar_progress(progress_line_object, direction) {
                var number_of_steps = progress_line_object.data('number-of-steps');
                var now_value       = progress_line_object.data('now-value');
                var new_value       = 0;
                if (direction === 'right') {
                    new_value = now_value + (100 / number_of_steps);
                } else if (direction === 'left') {
                    new_value = now_value - (100 / number_of_steps);
                }
                progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
            }

            jQuery(document).ready(function () {

                // Form

                $('.f1 fieldset:first').fadeIn('slow');

                $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function () {
                    $(this).removeClass('input-error');
                });

                // next step
                $('.f1 .btn-next').on('click', function () {
                    var parent_fieldset     = $(this).parents('fieldset');
                    var next_step           = true;
                    // navigation steps / progress steps
                    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                    var progress_line       = $(this).parents('.f1').find('.f1-progress-line');

                    // fields validation
                    parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function () {
                        if ($(this).val() === "") {
                            $(this).addClass('input-error');
                            next_step = false;
                        } else {
                            $(this).removeClass('input-error');
                        }
                    });
                    // fields validation

                    if (next_step) {
                        parent_fieldset.fadeOut(400, function () {
                            // change icons
                            current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                            // progress bar
                            bar_progress(progress_line, 'right');
                            // show next step
                            $(this).next().fadeIn();
                            // scroll window to beginning of the form
                            scroll_to_class($('.f1'), 20);
                        });
                    }

                });

                // previous step
                $('.f1 .btn-previous').on('click', function () {
                    // navigation steps / progress steps
                    var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                    var progress_line       = $(this).parents('.f1').find('.f1-progress-line');

                    $(this).parents('fieldset').fadeOut(400, function () {
                        // change icons
                        current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'left');
                        // show previous step
                        $(this).prev().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class($('.f1'), 20);
                    });
                });

                // submit
                $('.f1').on('submit', function (e) {

                    // fields validation
                    $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                        if ($(this).val() === "") {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        } else {
                            $(this).removeClass('input-error');
                        }
                    });
                    // fields validation

                });


            });
        });
	</script>
@stop

@section('cssCode')
	@parent
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.css">
	<style>
		.jp-card-container {
			float : right !important;
		}

		.panel-heading .buttons {
			display : none;
		}

		fieldset {
			border     : none !important;
			margin-top : 40px;
		}
	</style>
@stop