<div class="three fields">
    <div class="field">
        <label>Resmi Adı</label>
        <input name="accessory[store_realname]" value="{!! $row['store_realname'] !!}" placeholder="Resmi Adı" type="text">
    </div>
    <div class="field">
        <label>Adı</label>
        <input name="accessory[store_name]" value="{!! $row['store_name'] !!}" placeholder="Adı" type="text">
    </div>
    <div class="field">
        <label>Firma Sahibi</label>
        <input name="accessory[store_owner]" value="{!! $row['store_owner'] !!}" placeholder="Firma Sahibi" type="text">
    </div>
</div>
<div class="three fields">
    <div class="field">
        <label>Eposta Adresi</label>
        <div class="ui left icon input">
            <i class="at icon"></i>
            <input name="accessory[store_email]" value="{!! $row['store_email'] !!}" placeholder="Eposta Adresi" type="email">
        </div>
    </div>
    <div class="field">
        <label>Sabit Telefon</label>
        <div class="ui left icon input">
            <i class="call icon"></i>
            <input name="accessory[store_phone]" value="{!! $row['store_owner'] !!}" class="telMask" placeholder="Sabit Telefon" type="text">
        </div>
    </div>
    <div class="field">
        <label>Fax</label>
        <div class="ui left icon input">
            <i class="fax icon"></i>
            <input name="accessory[store_fax]" value="{!! $row['store_fax'] !!}" class="telMask" placeholder="Fax" type="text">
        </div>
    </div>
</div>
<div class="field">
    <label>Adres</label>
    <div class="ui left icon input">
        <i class="map icon"></i>
        <input name="accessory[store_address]" value="{!! $row['store_address'] !!}" placeholder="Adres" type="text">
    </div>
</div>