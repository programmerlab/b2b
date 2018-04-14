<div class="field">
	<label for="">Başlık</label>
	<input name="accessory[title]" value="{!! $row['title'] !!}" placeholder="Başlık" type="text">
</div>
<div class="field">
	<label for="">Logo Adı</label>
	<input name="accessory[logoName]" value="{!! $row['logoName'] !!}" placeholder="Logo Adı" type="text">
</div>
<div class="field">
	<label for="">Slogan</label>
	<input name="accessory[slogan]" value="{!! $row['slogan'] !!}" placeholder="Slogan" type="text">
</div>

<div class="ui grid six column">
	<div class="column">
		<div class="field">
			<label for="">Logo</label>
			@include('admin::_parts.image.one', $dataLogo)
		</div>
	</div>
	<div class="column">
		<div class="field">
			<label for="">Giriş Paneli Logo</label>
			@include('admin::_parts.image.one', $dataLogin)
		</div>
	</div>
	<div class="column">
		<div class="field">
			<label for="">Favicon</label>
			@include('admin::_parts.image.one', $dataFavIcon)
		</div>
	</div>
</div>